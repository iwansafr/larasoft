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