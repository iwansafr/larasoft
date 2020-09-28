<label>{{$name}}</label>
<select class="custom-select" name="{{$name}}">
  @foreach ($data as $item => $value)
    <option value="{{$item}}">{{$value}}</option>
  @endforeach
</select>
@include('form.feedback',['name'=>$name])