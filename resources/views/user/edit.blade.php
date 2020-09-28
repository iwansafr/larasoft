@extends('dashboard')

@section('content')
  @include('form.header',
  [
    'header'=>'Edit User',
    'link'=>[
      [
        'link'=>'admin/user/list',
        'title'=>'User'
      ],
      [
        'link'=>'',
        'title'=>'Edit'
      ]
    ]
  ])
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-secondary">
            <form action="" method="post" enctype="multipart/form-data">
              <div class="card-header">
                <h3 class="card-title">Update User Data</h3>
              </div>
              <div class="card-body">
                <div class="form-group">
                  @include('form.select',['name'=>'role','data'=>['1'=>'root','2'=>'admin','3'=>'member']])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'name'])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'email','type'=>'email'])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'password','type'=>'password'])
                </div>
              </div>
              <div class="card-footer">
                <button class="btn btn-sm btn-success"> <i class="fa fa-save"></i> Simpan</button>
                <button class="btn btn-sm btn-warning"> <i class="fa fa-undo"></i> Reset</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection