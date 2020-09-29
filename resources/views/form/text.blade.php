@php
    $label = str_replace('_',' ',$name);
@endphp
<label for="{{$name}}">{{$label}}</label>
<input type="@if(!empty($type)){{$type}}@else{{'text'}}@endif" name="{{$name}}" placeholder="Masukkan {{$label}}" class="form-control @error($name) is-invalid @enderror" value="@if(!empty(old($name))){{old($name)}}@elseif(!empty($value)){{$value}}@endif">
@include('form.feedback',['name'=>$name])