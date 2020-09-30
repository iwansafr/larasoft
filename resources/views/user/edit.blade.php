@extends('dashboard')

@push('styles')
  <link rel="stylesheet" href="/AdminLte/plugins/toastr/toastr.min.css">
@endpush
@section('content')
  @include('form.header',
  [
    'header'=>$title.' User',
    'link'=>[
      [
        'link'=>'/admin/user/',
        'title'=>'User'
      ],
      [
        '',
        'title'=>$title
      ]
    ]
  ])
  @php
      $name = !empty($data->name) ? $data->name : '';
      $email = !empty($data->email) ? $data->email : '';
      $photo = !empty($data->photo) ? $data->photo : '';
  @endphp
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <div class="card card-secondary">
            <form action="/admin/{{$action}}" method="post" enctype="multipart/form-data">
              @csrf
              @if (!empty($method))
                  @method($method)
              @endif
              <div class="card-header">
                <h3 class="card-title">{{__($title.' User Data')}}</h3>
              </div>
              <div class="card-body">
                @include('form.alert',['title'=>'error','type'=>'danger'])
                @include('form.alert',['title'=>'success','type'=>'success'])
                @if (!empty($role))
                  <div class="form-group">
                    @include('form.select',['name'=>'role','data'=>$role])
                  </div>
                @endif
                <div class="form-group">
                  @include('form.text',['name'=>'name','value'=>$name])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'email','type'=>'email','value'=>$email])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'photo','value'=>$photo,'type'=>'file','accept'=>'.jpg,.jpeg,.png'])
                  @if (!empty($photo))
                    <img src="{{asset('storage/images/user/'.$photo)}}" class="img img-fluid" alt="" width="200">
                  @endif
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
