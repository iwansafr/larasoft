@extends('dashboard')

@push('styles')
    @include('part.datatables_css')
@endpush
@section('content')
    @include('form.header',
    [
    'header'=>'Content',
    'link'=>[
        [
            'link'=>'admin/content',
            'title'=>'Content'
        ],
        [
        '',
        'title'=> 'List'
        ]
    ]
    ])
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <a href="/admin/content/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah Content</a>
                        </div>
                        <div class="card-body">
                            @include('form.alert',['title'=>'error','type'=>'danger'])
                            @include('form.alert',['title'=>'success','type'=>'success'])
                            <table class="table table-bordered" id="contents-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Title</th>
                                        <th>Image</th>
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
@if(session()->has('success'))
  <script>
    $(document).ready(function(){
      toastr.success("{{session()->get('success')}}")
    });
  </script>
@endif
<script>
$(function() {
    $('#contents-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/contentjson',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'title', name: 'title' },
            {
                data: 'image',
                name: 'image',
                render: function(data,type,full,meta){
                    if(data !== ''){
                        return '<img src="{{asset("storage/images/content/")}}/'+data+'" border="0" width="40" class="img-rounded" align="center" />';
                    }else{
                        return ' ';
                    }
                },
                orderable: false
            },
            { 
                data: 'id',
                name: 'action',
                render: function(data,type,full,meta){
                    return '<div class="form-inline"><a href="/admin/content/'+data+'/edit/" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></a> | <a href="/admin/content/'+data+'" class="btn btn-sm btn-warning"><i class="fa fa-search"></i></a> | <form action="/admin/content/'+data+'" method="post"> @csrf @method("DELETE") <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button></form></div>';
                },
                orderable: false
            }
        ],
        // dom: 'Bfrtip',
        // buttons: [
        //     'copyHtml5',
        //     'csvHtml5',
        //     'pdfHtml5'
        // ]
    });
});
</script>
@endpush