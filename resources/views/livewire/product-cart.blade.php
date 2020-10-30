<div>
    <div class="card" style="box-shadow: none;">
        <div class="overlay d-none"><i class="fas fa-2x fa-sync-alt fa-spin"></i></div>
        <form wire:submit.prevent="save">
            @if (!empty($field))
                @foreach ($field as $key => $value)
                @php
                    $name = $value['text'];
                @endphp
                <div class="form-group">
                    @switch($value['type'])
                        @case(0)
                            <label for="{{$name}}">{{$name}}</label>
                            <input type="text" wire:model="data.{{$name}}" name="{{str_replace('_',' ',$name)}}" class="form-control">
                            @error('data.'.$name)
                            <span class="danger alert" role="alert">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                            @break;
    
                        @case(1)
                            <label for="{{$name}}">{{$name}}</label>
                            <select name="{{str_replace('_',' ',$name)}}" class="form-control">
                                @if (!empty($value['options']))
                                @php
                                    $options = explode(',',$value['options']);
                                @endphp
                                    @foreach ($options as $opkey => $opvalue)
                                        <option value="{{$opvalue}}">{{$opvalue}}</option>
                                    @endforeach
                                @endif
                            </select>
                                @break
                            @case(3)
                            <label for="{{$name}}">{{$name}}</label>
                            <input type="file" name="{{str_replace('_',' ',$name)}}" class="form-control">
                            @break
    
                        @default
                            
                    @endswitch
                </div>
                @endforeach
            @endif
            <hr>
            <h4>Available Colors</h4>
            
    
            <h4 class="mt-3">Size <small>Please select one</small></h4>
            
    
            <div class="bg-gray py-2 px-3 mt-4">
                <h2 class="mb-0">
                ${{number_format($price,'0',',','.')}}
                </h2>
                <h4 class="mt-0">
                <small>Ex Tax: - </small>
                </h4>
            </div>
            <div class="mt-4">
            <button class="btn btn-secondary btn-lg btn-flat" type="submit">Add to Card</button>
                <div class="btn btn-secondary btn-lg btn-flat" type="submit">
                <i class="fas fa-cart-plus fa-lg mr-2"></i> 
                Add to Cart
                </div>
    
                <div class="btn btn-default btn-lg btn-flat" type="submit">
                Buy It Now
                </div>
            </div>
        </form>
    </div>
</div>
