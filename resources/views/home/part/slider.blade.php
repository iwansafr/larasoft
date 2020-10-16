@if (!empty($data['slider']))
  <div class="container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        @foreach ($data['slider'] as $item)
          <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->iteration}}"></li>
        @endforeach
      </ol>
      <div class="carousel-inner">
        @foreach ($data['slider'] as $item)
          <div class="carousel-item @if($loop->iteration == 1) active @endif">
            <img class="d-block w-100" src="{{asset('storage/images/content/'.$item->image)}}" alt="{{$item->title}}">
            <h5 class="carousel-caption">{{$item->title}}</h5>
          </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
@endif