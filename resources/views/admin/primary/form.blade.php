@extends('admin.admin')
@section('title', $primary->exists ? 'Modifier une sous categorie':'Créé une sous categorie')
@section('content')
  <h1>@yield('title')</h1>
@section('title', $primary->exists ? 'Editer la sous categorie':'créé une sous categorie')

@section('content')
   <h1>@yield('title')</h1>
   <form class="vstack gap-2" action="{{route($primary->exists ? 'admin.primary.update' :
   'admin.primary.store',['primary'=>$primary])}}" method="post" enctype="multipart/form-data">
       @csrf
       @method($primary->exists ? 'put' : 'post')
         <div class="card mb-4">
                    <div class="card-body demo-vertical-spacing demo-only-element">
                       <div class="form-password-toggle">
                          @include('shared.input',['class'=>'col','label'=>'Nom de la categorie','name'=>'nom', 'value'=>$primary->nom])
                       <div>
                    </div>
            <button class="btn btn-primary mt-2" type="submit">
                @if ($primary->exists)
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

@endsection
