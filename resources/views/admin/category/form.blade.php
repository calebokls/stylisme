@extends('admin.admin')
@section('title', $category->exists ? 'Modifier une categorie':'Créé une categorie')
@section('content')
  <h1>@yield('title')</h1>
@section('title', $category->exists ? 'Editer le Bien':'créé un bien')

@section('content')
   <h1>@yield('title')</h1>
   <form class="vstack gap-2" action="{{route($category->exists ? 'admin.category.update' :
   'admin.category.store',['category'=>$category])}}" method="post" enctype="multipart/form-data">
       @csrf
       @method($category->exists ? 'put' : 'post')
         <div class="card mb-4">
                    <div class="card-body demo-vertical-spacing demo-only-element">
                       <div class="form-password-toggle">
                          @include('shared.input',['class'=>'col','label'=>'Nom de la categorie','name'=>'name', 'value'=>$category->name])
                       <div>
                    </div>
                     <div class="card-body demo-vertical-spacing demo-only-element">
                       <div class="form-password-toggle">
                          @include('shared.select',['class'=>'col','label'=>'Sous catégorie','name'=>'primaries', 'value'=>$category->primaries()->pluck('id'),'multiple'=>true])
                       <div>
                    </div>
            <button class="btn btn-primary mt-2" type="submit">
                @if ($category->exists)
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
