@extends('dashboard')

@push('styles')
  <link rel="stylesheet" href="/AdminLte/plugins/toastr/toastr.min.css">
  <link rel="stylesheet" href="/AdminLte/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="/AdminLte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="/AdminLte/plugins/summernote/summernote-bs4.css">
@endpush
@section('content')
  @include('form.header',
  [
    'header'=>$title,
    'link'=>[
      [
        'link'=>'/admin/content/',
        'title'=>'Content'
      ],
      [
        '',
        'title'=>$title
      ]
    ]
  ])
  @php
      $title = !empty($data->title) ? $data->title : '';
      $slug = !empty($data->slug) ? $data->slug : '';
      $image = !empty($data->image) ? $data->image : '';
      $gallery = !empty($data->gallery) ? $data->gallery : '';
      $keyword = !empty($data->keyword) ? $data->keyword : '';
      $description = !empty($data->description) ? $data->description : '';
      $content = !empty($data->content) ? $data->content : '';
      $publish = !empty($data->publish) ? $data->publish : '';
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
                <h3 class="card-title">{{__($title.' Content')}}</h3>
              </div>
              <div class="card-body">
                @include('form.alert',['title'=>'error','type'=>'danger'])
                @include('form.alert',['title'=>'success','type'=>'success'])
                @if (!empty($categories))
                  <div class="form-group">
                    @include('form.select',['name'=>'categories[]','data'=>$categories,'select2'=>true,'multiple'=>true])
                  </div>
                @endif
                <div class="form-group">
                  @include('form.text',['name'=>'title','value'=>$title])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'slug','value'=>$slug])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'image','value'=>$image,'type'=>'file','accept'=>'.jpg,.jpeg,.png'])
                  @if (!empty($image))
                    <img src="{{asset('storage/images/content/'.$image)}}" class="img img-fluid" alt="" width="200">
                  @endif
                </div>
                <div class="form-group">
                  @include('form.textarea',['name'=>'content','value'=>$content])
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
  <script src="/AdminLte/plugins/select2/js/select2.full.min.js"></script>
  <script src="/AdminLte/plugins/summernote/summernote-bs4.min.js"></script>
  <script>
    $('document').ready(function(){
      $('.select2').select2();
      $('textarea').summernote();
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
