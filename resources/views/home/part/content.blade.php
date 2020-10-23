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