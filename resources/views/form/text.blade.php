@php
    $label = str_replace('_',' ',$name);
    $type = !empty($type) ? $type : 'text';
@endphp
<label for="{{$name}}">{{$label}}</label>
<input type="{{$type}}" name="{{$name}}" placeholder="Masukkan {{$label}}" class="form-control @error($name) is-invalid @enderror" value="@if(!empty(old($name))){{old($name)}}@elseif(!empty($value)){{$value}}@endif" @if(!empty($accept)) accept="{{$accept}}" @endif>
@include('form.feedback',['name'=>$name])
