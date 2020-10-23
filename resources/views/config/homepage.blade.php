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
        @include('form.alert',['title'=>'error','type'=>'danger'])
        @include('form.alert',['title'=>'success','type'=>'success'])
        <form action="/admin/config/homepage/" method="post" enctype="multipart/form-data">
            @csrf
          <div class="form-group">
            <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> Save</button>
          </div>
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
                @include('form.text',['name'=>'site_title','value'=>@$data['site_title']])
              </div>
              <div class="form-group">
                @include('form.text',['name'=>'site_description','value'=>@$data['site_description']])
              </div>
              <div class="form-group">
                @include('form.text',['name'=>'site_icon','type'=>'file','accept'=>'.png,.jpg','value'=>@$data['site_icon']])
                @if (!empty($data['site_icon']))
                  <img src="{{asset('storage/images/config/'.$data['site_icon'])}}" class="img img-fluid" alt="" width="200">
                @endif
              </div>
              <div class="form-group">
                @include('form.text',['name'=>'logo_image','type'=>'file','accept'=>'.png,.jpg','value'=>@$data['logo_image']])
                @if (!empty($data['logo_image']))
                  <img src="{{asset('storage/images/config/'.$data['logo_image'])}}" class="img img-fluid" alt="" width="200">
                @endif
              </div>
            </div>
          </div>
          <div class="card card-outline collapsed-card card-secondary">
            <div class="card-header">
              <h3 class="card-title">
                Slider config
              </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                @include('form.select',['name'=>'content_slider','data'=>$category,'selected'=>@$data['content_slider']])
              </div>
            </div>
          </div>
          <div class="card card-outline collapsed-card card-secondary">
            <div class="card-header">
              <h3 class="card-title">
                Product Display
              </h3>
              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                @include('form.select',['name'=>'product_top','data'=>$category,'selected'=>@$data['product_top']])
              </div>
            </div>
          </div>
          <div class="card card-secondary">
            <div class="card-header">
              home page
            </div>
            <div class="card-body">
              <div class="row">
                <div class="col-md-3">
                </div>
              </div>
              <div class="form-group">
                @include('form.text',['name'=>'title','value'=>$title])
              </div>
            </div>
          </div>
        </form>
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