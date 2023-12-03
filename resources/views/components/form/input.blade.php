@props(
    [
        'name','type'=>'text','value'=>'' ,'label' =>"fales"
    ]
)
@if($label)
<label for="">{{$label}}</label>
@endif

<input type="{{$type }}"
 name="{{$name}}"
{{$attributes->class([
  'form-control',
  'is-invalid'=>$errors->has($name) //المربع الاحمر 

])}} 

value="{{old($name, $value)}}">
@error($name)
<div class="invalid-feedback">
    {{$message}}
</div>
    
@enderror