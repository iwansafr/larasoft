@extends('dashboard')
@section('content')
  @include('form.header',['header'=>'Detail User','link'=>[['link'=>'/admin/user','title'=>'User List'],['link'=>'','title'=>'Detail']]])
  <section class="content">
    <div class="card">
      <div class="card-header">
        <label>{{__('User Detail')}}</label>
      </div>
      <div class="card-body">
        <table class="table">
          <tr>
            <td>{{__('Nama')}}</td>
            <td>{{$data->name}}</td>
          </tr>
          <tr>
            <td>{{__('Photo')}}</td>
            <td><img src="{{asset('storage/images/user/'.$data->photo)}}" class="img img-fluid"></td>
          </tr>
          <tr>
            <td>{{__('Email')}}</td>
            <td>{{$data->email}}</td>
          </tr>
          <tr>
            <td>{{__('Role')}}</td>
            <td>{{$role[$data->role]}}</td>
          </tr>
        </table>
      </div>
      <div class="card-footer">
        @if (empty($_GET['print']))
          <a href="?print=1" class="btn btn-sm btn-default" target="_blank"><i class="fa fa-print"></i> Print</a>
        @endif
      </div>
    </div>
  </section>
@endsection
@push('scripts')
  @if (!empty($_GET['print']))
    <script>
      window.print();
    </script>
  @endif
@endpush