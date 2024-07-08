@extends('admin.admin')
@section('title', $taille->exists ? 'Modification d\'une taille' : 'Créé une taille')
@section('content')
  <h1>@yield('title')</h1>


<form class="vstack gap-2" action="{{route($taille->exists ? 'admin.taille.update' :
   'admin.taille.store',['taille'=>$taille])}}" method="post" enctype="multipart/form-data">
       @csrf
       @method($taille->exists ? 'put' : 'post')
         <div class="card mb-4">
                    <div class="card-body demo-vertical-spacing demo-only-element">
                       <div class="form-password-toggle">
                          @include('shared.input',['class'=>'col','label'=>'Taille','name'=>'name', 'value'=>$taille->name])
                       <div>
                    </div>
            <button class="btn btn-primary mt-2" type="submit">
                @if ($taille->exists)
                    Modifier
                    @else
                    Ajouter
                @endif
            </button>
        </div>
                      </div>
                    </div>
                  </div>

  </form>
@endsection
