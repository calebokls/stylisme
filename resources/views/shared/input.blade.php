@php
    $label ??=ucfirst($name) ;
    $type ??='text';
    $name ??='';
    $class ??='';
    $value ??='';
@endphp
<div @class(['form-group',$class])>
   <label style="color:blue;" for="{{$name}}">{{$label}}</label>
   @if($type == 'textarea')
     <textarea type="{{$type}}" class="form-control @error($name) is-invalid @enderror" name="{{$name}}">{{old($name,$value)}}</textarea>
      @else
     <input type="{{$type}}" class="form-control form-control-user @error($name) is-invalid @enderror" name="{{$name}}" id="{{$name}}" value="{{old($name,$value)}}">
  @endif

  @error($name)
     <div class="invalid-feedback">
        {{$message}}
     </div>
  @enderror
</div>
