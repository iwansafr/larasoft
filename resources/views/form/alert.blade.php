@if (session()->has($title))
  <div class="alert alert-{{$type}}">
    {{session()->get($title)}}
  </div>
@endif