@extends('Bases')
@section('title', 'Signalisation')
@section('content')
    <form method="POST" action="{{route('signalement.utilisateur.collection')}}">
       @csrf
       @method('POST')
       <div class="row">
          <div class="col-md-6 mx-auto">
                  <h1>@yield('title')</h1>

               <div class="card mb-4">
                  <div class="card-body demo-vertical-spacing demo-only-element">
                   <div class="form-password-toggle" style="display:none;">
                      @include('shared.input', ['class' => 'col','type'=>'hidden', 'label' => 'id collection', 'name' => 'collection_id','value'=>$collectiony->id])
                    </div>
                    <div class="form-password-toggle">
                      @include('shared.input', ['class' => 'col','type'=>'textarea', 'label' => 'Motif', 'name' => 'motif'])
                    </div>
                  </div>
                   <button class="btn btn-primary mt-2" type="submit">
                      Envoyer
                   </button>
              </div>
          </div>
       </div>

   </form>
@endsection
