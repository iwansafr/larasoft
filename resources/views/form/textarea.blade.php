@php
    $label = str_replace('_',' ',$name);
@endphp
<label for="{{$name}}">{{$label}}</label>
<textarea class="form-control @error($name) is-invalid @enderror" name="{{$name}}" value="@if(!empty(old($name))){{old($name)}}@elseif(!empty($value)){{$value}}@endif"></textarea>

@include('form.feedback',['name'=>$name])
