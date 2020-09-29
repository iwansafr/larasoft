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
            <form action="/admin/user/save" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-header">
                <h3 class="card-title">Update User Data</h3>
              </div>
              <div class="card-body">
                @include('form.alert',['title'=>'error','type'=>'danger'])
                @include('form.alert',['title'=>'success','type'=>'success'])
                @if (!empty($data->id))
                  <input type="hidden" name="id" value="{{$data->id}}">
                @endif
                <div class="form-group">
                  @include('form.select',['name'=>'role','data'=>['1'=>'root','2'=>'admin','3'=>'member']])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'name','value'=>$data->name])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'email','type'=>'email','value'=>$data->email])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'password','type'=>'password'])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'password_confirmation','type'=>'password'])
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