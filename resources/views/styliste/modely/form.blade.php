@extends('styliste.layout')
@section('title',$modely->exists? 'Modifier un modele':'Ajouter un modele')
@section('content')
<div class="row">
   <div class="col-md-6">
     <div class="row">
        @foreach($modely->pictures as  $picture)
        <div class="col-md-3">
             <img style="width:100px;heigth:100px;" src="{{$picture->getUrlForModelyImage()}}">
               <form action="{{route('style.',$picture)}}" method="POST">
                       @csrf
                       @method('delete')
                      <button class="btn btn-danger">
                         Supprimer
             </button>
         </form>
        </div>

      @endforeach
     </div>
   </div>
    <div class="col-md-6">
    <h1>@yield('title')</h1>
    <form class="vstack gap-2" action="{{ route($modely->exists ? 'style.modely.update' : 'style.modely.store', ['modely' => $modely]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method($modely->exists ? 'put' : 'post')
        <div class="card mb-4">
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    <label for="marque">Marques</label>
                    <select name="marque" class="form-select form-select-md">
                        @foreach($marques as $key => $marque)
                          <option @selected(in_array($marque,$selectedPrimaries)) value="{{$key}}">{{$marque}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    @include('shared.upload', ['class' => 'col', 'label' => 'Images (Vous pouvez sélectionner plusieurs images)', 'name' => 'pictures', 'multiple' => true])
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    @include('shared.input', ['class' => 'col', 'label' => 'Nom du modèle', 'name' => 'name', 'value' => $modely->name])
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    @include('shared.input', ['class' => 'col', 'label' => 'Prix', 'name' => 'price', 'value' => $modely->price])
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                 @include('shared.select', ['class' => 'col','name'=>'taille', 'label' => 'Tailles', 'value' => $modely->tailles()->pluck('id'),'primaries'=>$primaries,'multiple'=>true])
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                @include('shared.input', ['class' => 'col', 'type' => 'textarea', 'label' => 'Description', 'name' => 'description', 'value' => $modely->description])
            </div>
            <div class="form-check form-check-inline mt-3">
                <input type="radio" id="homme" name="genre" value="homme" @if ($modely->genre === 'homme') checked @endif>
                <label for="homme">Homme</label>
         </div>
           <div class="form-check form-check-inline">
                 <input type="radio" id="femme" name="genre" value="femme" @if ($modely->genre === 'femme') checked @endif>
                 <label for="femme">Femme</label>
          </div>
          <div class="form-check form-check-inline">
                <input type="radio" id="mixte" name="genre" value="mixte" @if ($modely->genre === 'mixte') checked @endif>
               <label for="mixte">Mixte</label>
         </div>
            <button class="btn btn-primary mt-2" type="submit">
                @if ($modely->exists)
                    Modifier
                @else
                    Ajouter
                @endif
            </button>
        </div>
    </form>
</div>

</div>

@endsection
