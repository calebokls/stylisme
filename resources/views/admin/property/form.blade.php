@extends('admin.admin')
@section('title', 'Créé un type de produit')
@section('content')
<h1>@yield('title')</h1>

<form class="vstack gap-2" action="{{route($property->exists ? 'admin.property.update' :
   'admin.property.store',['property'=>$property])}}" method="post" enctype="multipart/form-data">
       @csrf
       @method($property->exists ? 'put' : 'post')
         <div class="card mb-4">
                    <div class="card-body demo-vertical-spacing demo-only-element">
                       <div class="form-password-toggle">
                          @include('shared.input',['class'=>'col','label'=>'Nom du type de produit','name'=>'name', 'value'=>$property->name])
                       <div>
                    </div>
            <button class="btn btn-primary mt-2" type="submit">
                @if ($property->exists)
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
