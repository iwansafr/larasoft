@php
    $label = str_replace('_',' ',$name);
    $value = !empty($value) ? $value : 1;
@endphp
<label for="{{$name}}">{{$label}}</label>
<div class="custom-control custom-checkbox">
  <input class="custom-control-input" type="checkbox" id="{{$name}}" value="{{$value}}" name="{{$name}}">
  <label for="{{$name}}" class="custom-control-label">{{$label}}</label>
</div>