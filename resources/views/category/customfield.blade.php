@extends('dashboard')

@push('styles')
  @include('part.datatables_css')
@endpush
@section('content')
  @include('form.header',
  [
    'header'=>'Custom Field',
    'link'=>[
      [
        '',
        'title'=>'Custom Field'
      ]
    ]
  ])
  @php
      $title = !empty($data->title) ? $data->title : '';
  @endphp
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="card card-secondary">
            <form action="/admin/{{$action ?? ''}}" method="post" enctype="multipart/form-data">
              @csrf
              @if (!empty($method))
                  @method($method)
              @endif
              <a href="/admin/customfield" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> New Custom Field</a>
              <div class="card-header">
                <h3 class="card-title">{{__('Custom Field')}}</h3>
              </div>
              <div class="card-body">
                @include('form.alert',['title'=>'error','type'=>'danger'])
                @include('form.alert',['title'=>'success','type'=>'success'])
                <div class="form-group">
                  @include('form.text',['name'=>'title','value'=>$title])
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
                    {{__('Custom Field')}}
                </div>
                <div class="card-body">
                    @include('form.alert',['title'=>'error','type'=>'danger'])
                    @include('form.alert',['title'=>'success','type'=>'success'])
                    <table class="table table-bordered" id="contents-table">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Title</th>
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
  @include('part.datatables_js')
  <script src="/AdminLte/plugins/select2/js/select2.full.min.js"></script>
  <script>
    $('#contents-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/customfieldjson',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            { 
                data: 'id',
                name: 'action',
                render: function(data,type,full,meta){
                   return '<div class="form-inline"><a href="/admin/customfieldcustom/'+data+'" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i> Customize</a>|<a href="/admin/customfield/'+data+'/edit/" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> | <form action="/admin/customfield/'+data+'" method="post"> @csrf @method("DELETE") <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Delete</button></form></div>';
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
