@php
    $label = str_replace('_',' ',$name);
    $value = (!empty(old($name)) ? old($name) : !empty($value)) ? $value : '';
@endphp
<label for="{{$name}}">{{$label}}</label>
<textarea class="form-control @error($name) is-invalid @enderror" name="{{$name}}" value="{{$value}}">{{$value}}</textarea>

@include('form.feedback',['name'=>$name])
