@extends('dashboard')

@push('styles')
  <link rel="stylesheet" href="/AdminLte/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="/AdminLte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/AdminLte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="/AdminLte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="/AdminLte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
@endpush
@section('content')
  @include('form.header',
  [
    'header'=>'Category',
    'link'=>[
      [
        '',
        'title'=>'Category'
      ]
    ]
  ])
  @php
      $title = !empty($data->title) ? $data->title : '';
      $slug = !empty($data->slug) ? $data->slug : '';
      $selected_parent = !empty($data->parent) ? $data->parent : '';
  @endphp
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="card card-secondary">
            <form action="/admin/{{$action}}" method="post" enctype="multipart/form-data">
              @csrf
              @if (!empty($method))
                  @method($method)
              @endif
              <a href="/admin/category" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New Category</a>
              <div class="card-header">
                <h3 class="card-title">{{__('Category')}}</h3>
              </div>
              <div class="card-body">
                @include('form.alert',['title'=>'error','type'=>'danger'])
                @include('form.alert',['title'=>'success','type'=>'success'])
                @if (!empty($parent))
                  <div class="form-group">
                    @include('form.select',['name'=>'parent','data'=>$parent,'select2'=>true,'selected'=>$selected_parent])
                  </div>
                @else
                  <div class="form-group">
                    @include('form.select',['name'=>'parent','data'=>['None']])
                  </div>
                @endif
                <div class="form-group">
                  @include('form.text',['name'=>'title','value'=>$title])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'slug','value'=>$slug])
                </div>
              </div>
              <div class="card-footer">
                <button class="btn btn-sm btn-success"> <i class="fa fa-save"></i> {{__('Simpan')}}</button>
                <button class="btn btn-sm btn-warning"> <i class="fa fa-undo"></i> {{__('Reset')}}</button>
              </div>
            </form>
          </div>
        </div>
        <div class="col-md-9">
            <div class="card">
                <div class="card-header">
                    {{__('Category')}}
                </div>
                <div class="card-body">
                    @include('form.alert',['title'=>'error','type'=>'danger'])
                    @include('form.alert',['title'=>'success','type'=>'success'])
                    <table class="table table-bordered" id="contents-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Parent</th>
                                <th>Title</th>
                                <th>Slug</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script src="/AdminLte/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="/AdminLte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="/AdminLte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="/AdminLte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="/AdminLte/plugins/toastr/toastr.min.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/dataTables.buttons.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/buttons/1.6.4/js/buttons.html5.min.js"></script>
  <script src="/AdminLte/plugins/select2/js/select2.full.min.js"></script>
  <script>
    var parent = JSON.parse('<?php echo json_encode($data_parent);?>');
    $('#contents-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/categoryjson',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'parent', name: 'parent',
              render: function(data,type,full,meta){
                return parent[data];
              }
             },
            { data: 'title', name: 'title' },
            { data: 'slug', name: 'slug' },
            { 
                data: 'id',
                name: 'action',
                render: function(data,type,full,meta){
                   return '<div class="form-inline"><a href="/admin/category/'+data+'/edit/" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> | <form action="/admin/category/'+data+'" method="post"> @csrf @method("DELETE") <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button></form></div>';
                },
                orderable: false
            }
        ],
        dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    });
    $(document).ready(function(){
      $('.select2').select2();
    });
  </script>
  @if (session()->has('success'))
  <script>
    $(document).ready(function(){
      toastr.success("{{session()->get('success')}}")
    });
  </script>
  @endif
@endpush
