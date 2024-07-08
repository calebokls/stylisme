@if (session('success'))
<div class="text-center alert alert-success">
    {{session('success')}}
</div>
@endif

@if(session('danger'))
  <div class="text-center alert alert-danger">
    {{session('danger')}}
  </div>
@endif

@if ($errors->any())
<div class="text-center alert alert-danger">
    <ul class="my-0">
    @foreach ($errors->all() as $erro)
      <li>{{$erro}}</li>
    @endforeach
    </ul>
</div>
@endif
