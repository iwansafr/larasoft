@extends('dashboard')

@push('styles')
  <link rel="stylesheet" href="/AdminLte/plugins/toastr/toastr.min.css">
@endpush
@section('content')
  @include('form.header',
  [
    'header'=>$title.' Category',
    'link'=>[
      [
        '',
        'title'=>$title
      ]
    ]
  ])
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-3">
          <div class="card card-secondary">
            <form action="/admin/{{$action}}" method="post" enctype="multipart/form-data">
              @csrf
              @if (!empty($method))
                  @method($method)
              @endif
              <div class="card-header">
                <h3 class="card-title">{{__($title.' Category')}}</h3>
              </div>
              <div class="card-body">
                @include('form.alert',['title'=>'error','type'=>'danger'])
                @include('form.alert',['title'=>'success','type'=>'success'])
                @if (!empty($parent))
                  <div class="form-group">
                    @include('form.select',['name'=>'parent','data'=>$parent])
                  </div>
                @else
                  <div class="form-group">
                    @include('form.select',['name'=>'parent','data'=>['None']])
                  </div>
                @endif
                <div class="form-group">
                  @include('form.text',['name'=>'title'])
                </div>
                <div class="form-group">
                  @include('form.text',['name'=>'slug'])
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
