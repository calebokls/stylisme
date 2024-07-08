@php
  $label ??= ucfirst($name);
  $class ??= null;
  $name ??= ' ';
  $value ??= '';
@endphp
<div @class(['form-group',$class])>
   <label for="{{$name}}" style="color:blue;">{{$label}}</label>
   <select name="{{$name}}[]" id="{{$name}}" multiple>
    @foreach ($primaries as $k => $v)
        <option @selected($value->contains($k)) value="{{$k}}">{{$v}}</option>
    @endforeach
   </select>
     @error($name)
         <div class="invalid-feedback">
            {{$message}}
         </div>
     @enderror
 </div>
