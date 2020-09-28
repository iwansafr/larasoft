<label for="{{$name}}">{{$name}}</label>
<input type="@if(!empty($type)){{$type}}@else{{'text'}}@endif" name="{{$name}}" placeholder="Masukkan {{$name}}" class="form-control @error($name) is-invalid @enderror" value="{{old($name)}}">
@include('form.feedback',['name'=>$name])