@extends('dashboard')
@section('content')
<?php 
$header = ['header'=>'Config Home Page','link'=>[['link'=>'','title'=>'Home Page']]];
$title = !empty($data['title']) ? $data['title'] : '';
?>
@include('form.header',$header)

<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card card-outline collapsed-card card-secondary">
          <div class="card-header">
            <h3 class="card-title">
              site config
            </h3>
            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <div class="form-group">
              @include('form.text',['name'=>'logo_title'])
            </div>
          </div>
        </div>
        <div class="card card-secondary">
          <form action="/admin/config/homepage/" method="post">
            @csrf
            <div class="card-header">
              home page
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                </div>
              </div>
              @include('form.alert',['title'=>'error','type'=>'danger'])
              @include('form.alert',['title'=>'success','type'=>'success'])
              <div class="form-group">
                @include('form.text',['name'=>'title','value'=>$title])
              </div>
            </div>
            <div class="card-footer">
              <button class="btn btn-success" type="submit">save</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>
    
@endsection
@push('scripts')
  @if (session()->has('success'))
  <script>
    $(document).ready(function(){
      toastr.success("{{session()->get('success')}}")
    });
  </script>
  @endif
@endpush