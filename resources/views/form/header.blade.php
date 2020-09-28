<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>{{$header}}</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><i class="fas fa-tachometer-alt"></i> <a href="/admin">Dashboard</a></li>
          @foreach ($link as $item => $value)
            @if (!empty($value['link']))
              <li class="breadcrumb-item"><a href="{{$value['link']}}">{{$value['title']}}</a></li>
            @else
              <li class="breadcrumb-item active">{{$value['title']}}</li>
            @endif
          @endforeach
        </ol>
      </div>
    </div>
  </div>
</section>