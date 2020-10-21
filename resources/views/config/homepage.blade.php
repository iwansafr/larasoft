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
        <div class="card card-secondary">
          <form action="/admin/config/homepage/" method="post">
            @csrf
            <div class="card-header">
              home page
            </div>
            <div class="card-body">
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