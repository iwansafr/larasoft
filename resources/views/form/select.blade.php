<label>{{$name}}</label>
@php
    $selected = !empty($selected) ? $selected : 0;
@endphp
<select class="@if(!empty($select2)){{'form-control select2'}}@else{{'custom-select'}}@endif" style="width:100%;" name="{{$name}}">
  @foreach ($data as $item => $value)
    <option value="{{$item}}" @if($item==$selected){{'selected'}}@endif>{{$value}}</option>
  @endforeach
</select>
@include('form.feedback',['name'=>$name])