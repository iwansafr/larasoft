@php
  $selected = !empty($selected) ? $selected : 0;
  $multiple = !empty($multiple) ? $multiple : 0;
  $label = str_replace('_','',$name);
  $label = str_replace('[]','',$label);
@endphp
<label>{{$label}}</label>
<select class="@if(!empty($select2)){{'form-control select2'}}@else{{'custom-select'}}@endif" @if(!empty($multiple)){{'multiple'}}@endif style="width:100%;" name="{{$name}}">
  @if (is_array($data))
    @foreach ($data as $item => $value)
      <option value="{{$item}}" @if($item==$selected){{'selected'}}@endif>{{$value}}</option>
    @endforeach
  @elseif(is_object($data))
    @foreach ($data as $item)
      <option value="{{$item->id}}" @if($item->id==$selected){{'selected'}}@endif>{{$item->title}}</option>
    @endforeach
  @endif

</select>
@include('form.feedback',['name'=>$name])