<style>
  .box-title::before{
    position: absolute;
    content: "";
    height: 1px;
    background-color: #e0e0e0;
    top: -moz-calc(50% - 0.5px);
    top: -webkit-calc(50% - 0.5px);
    top: -ms-calc(50% - 0.5px);
    top: calc(50% - 0.5px);
    left: 0;
    right: 0;
    width: 100%;
  }
  .title{
    z-index: 1;
    background-color: #fff;
    padding: 0 24px;
    position: relative;
  }
</style>
<div class="col-md-12">
  <h3 class="box-title text-center">
    <span class="title">
      {{$data['product_slide_category']->title}}
    </span>
  </h3>
</div>
@if (!empty($data['product_slide']))
  <div class="container">
    <div id="carouselProductSlide" class="carousel slide" data-ride="carousel">
      <ol class="carousel-indicators">
        @foreach ($data['product_slide']->chunk(4) as $item)
          <li data-target="#carouselProductSlide" data-slide-to="{{$loop->iteration}}"></li>
        @endforeach
      </ol>
      <div class="carousel-inner">
        @foreach ($data['product_slide']->chunk(4) as $item)
          <div class="carousel-item @if($loop->iteration == 1) active @endif">
            <div class="row">
              @foreach ($item as $product)
                <div class="col-md-3">
                  <div class="card-body">
                    <img src="{{asset('storage/images/product/'.$product->image)}}" class="w-100 img img-fluid" alt="">
                    <p class="text-center">
                      {{$product->title}}
                      <br>
                      <b>${{number_format($product->price,'2','.','')}}</b>
                    </p>
                  </div>
                </div>
              @endforeach
            </div>
          </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#carouselProductSlide" role="button" data-slide="prev" style="left: -100px;">
        <i class="fa fa-arrow-alt-circle-left" style="color: black;font-size: 24px;"></i>
        {{-- <span class="carousel-control-prev-icon" aria-hidden="true"></span> --}}
        <span class="sr-only">Previous</span>
      </a>
      <a class="carousel-control-next" href="#carouselProductSlide" role="button" data-slide="next" style="right: -100px;">
        <i class="fa fa-arrow-alt-circle-right" style="color: black;font-size: 24px;"></i>
        {{-- <span class="carousel-control-next-icon" aria-hidden="true"></span> --}}
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>
@endif

<div class="col-md-12">
  <h3 class="box-title text-center">
    <span class="title">
      {{$data['product_top_category']->title}}
    </span>
  </h3>
</div>
@if (!empty($data['product_top']))
    @foreach ($data['product_top'] as $item)
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
    @endforeach
@endif