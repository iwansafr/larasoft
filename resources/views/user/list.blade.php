@extends('dashboard')

@push('styles')
    <link rel="stylesheet" href="/AdminLte/plugins/toastr/toastr.min.css">
    <link rel="stylesheet" href="/AdminLte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="/AdminLte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
@endpush
@section('content')
    @include('form.header',
    [
    'header'=>'Data User',
    'link'=>[
        [
        'admin/user/list',
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
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered" id="contents-table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>Name</th>
                                        <th>Email</th>
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
<script>
$(function() {
    $('#contents-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/admin/userjson',
        columns: [
            { data: 'id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'email', name: 'email' },
            { data: 'photo', name: 'photo' },
            { data: 'action', name: 'action' }
        ]
    });
});
</script>
@endpush