@extends('dashboard')
@section('content')
  @include('form.header',['header'=>'Detail Content','link'=>[['link'=>'/admin/content','title'=>'Content List'],['link'=>'','title'=>'Detail']]])
  <section class="content">
    <div class="card">
      <div class="card-header">
        <label>{{__('Content Detail')}}</label>
      </div>
      <div class="card-body">
        <table class="table">
          <tr>
            <td>{{__('Title')}}</td>
            <td>{{$data->title}}</td>
          </tr>
          <tr>
            <td>Category</td>
            <td>
              @foreach ($data->categories as $item)
                  <span class="badge badge-primary">{{$item->title}}</span>
              @endforeach
            </td>
          </tr>
          <tr>
            <td>{{__('Image')}}</td>
            <td><img src="{{asset('storage/images/content/'.$data->image)}}" class="img img-fluid"></td>
          </tr>
          <tr>
            <td>{{__('Content')}}</td>
            <td><?php echo $data->content;?></td>
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