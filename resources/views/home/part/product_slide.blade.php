@if (!empty($data['product_slide']))
<div class="container">
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      @foreach ($data['product_slide'] as $item)
      <li data-target="#carouselExampleIndicators" data-slide-to="{{$loop->iteration}}"></li>
      @endforeach
    </ol>
    <div class="carousel-inner">
      @foreach ($data['product_slide'] as $item)
      <div class="carousel-item @if($loop->iteration == 1) active @endif">
        <div class="col-md-3">
          <div class="card-body">
            <img src="{{asset('storage/images/product/'.$item->image)}}" class="w-100 img img-fluid" alt="">
            <p class="text-center">
              {{$item->title}}
              <br>
              <b>${{number_format($item->price,'2','.','')}}</b>
            </p>
          </div>
        </div>
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