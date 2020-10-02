@extends('dashboard')

@push('styles')
    <link rel="stylesheet" href="/AdminLte/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="/AdminLte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/AdminLte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.4/css/buttons.dataTables.min.css">
@endpush
@section('content')
    @include('form.header',
    [
    'header'=>'Data User',
    'link'=>[
        [
            'link'=>'admin/user/list',
            'title'=>'User'
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
                            <a href="/admin/user/create" class="btn btn-sm btn-primary"><i class="fa fa-plus"></i> Tambah User</a>
                        </div>
                        <div class="card-body">
                            @include('form.alert',['title'=>'error','type'=>'danger'])
                            @include('form.alert',['title'=>'success','type'=>'success'])
                            <table class="table table-bordered" id="contents-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Role</th>
                                        <th>Photo</th>
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
@if(session()->has('success'))
  <script>
    $(document).ready(function(){
      toastr.success("{{session()->get('success')}}")
    });
  </script>
@endif
<script>
$(function() {
    role = JSON.parse('<?php echo $_data_role;?>');
    $('#contents-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/userjson',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            {
                data: 'role',
                name: 'role',
                render: function(data,type,full,meta){
                    if(data != null){
                        return role[data];
                    }else{
                        return ' ';
                    }
                },
                orderable: false
            },
            {
                data: 'photo',
                name: 'photo',
                render: function(data,type,full,meta){
                    if(data != null){
                        return '<img src="{{asset("storage/images/user/")}}/'+data+'" border="0" width="40" class="img-rounded" align="center" />';
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
                    return '<div class="form-inline"><a href="/admin/user/'+data+'/edit/" class="btn btn-sm btn-primary"><i class="fa fa-edit"></i> Edit</a> | <a href="/admin/user/'+data+'" class="btn btn-sm btn-warning"><i class="fa fa-search"></i> Detail</a> | <form action="/admin/user/'+data+'" method="post"> @csrf @method("DELETE") <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</button></form></div>';
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
});
</script>
@endpush