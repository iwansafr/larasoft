@extends('dashboard')

@push('styles')
  <link rel="stylesheet" href="/AdminLte/plugins/toastr/toastr.min.css">
@endpush
@section('content')
  @include('form.header',
  [
    'header'=>'Edit User',
    'link'=>[
      [
        'admin/user/list',
        'title'=>'User'
      ],
      [
        '',
        'title'=>'Edit'
      ]
    ]
  ])
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-secondary">
            <form action="/admin/profile/edit" method="post" enctype="multipart/form-data">
              @csrf
              <div class="card-header">
                <h3 class="card-title">{{__('Update User Data')}}</h3>
              </div>
              <div class="card-body">
                @include('form.alert',['title'=>'error','type'=>'danger'])
                @include('form.alert',['title'=>'success','type'=>'success'])
                <div class="form-group">
                  @include('form.text',['name'=>'name','value'=>$user->name])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'email','type'=>'email','value'=>$user->email])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'password','type'=>'password'])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'password_confirmation','type'=>'password'])
                </div>
              </div>
              <div class="card-footer">
                <button class="btn btn-sm btn-success"> <i class="fa fa-save"></i> {{__('Simpan')}}</button>
                <button class="btn btn-sm btn-warning"> <i class="fa fa-undo"></i> {{__('Reset')}}</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection

@push('scripts')
  <script src="/AdminLte/plugins/toastr/toastr.min.js"></script>
  @if (session()->has('success'))
  <script>
    $(document).ready(function(){
      toastr.success("{{session()->get('success')}}")
    });
  </script>
  @endif
@endpush
