@extends('styliste.layout')
@section('title',$marque->exists ? 'Modification d\'une marque':'Créé une marque')
@section('content')
<h1>@yield('title')</h1>
<div class="row">
<div class="col-md-4">
  <h2 class="btn btn-info">Logo de votre marque</h2>
    <img class="w-100" src="{{$marque->getImageForMarquesUrl()}}">
</div>
   <div class="col-md-8">
    <form class="vstack gap-2" action="{{ route($marque->exists ? 'style.marque.update' : 'style.marque.store', ['marque' => $marque]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method($marque->exists ? 'put' : 'post')
        <div class="card mb-4">
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    @include('shared.upload', ['class' => 'col', 'label' => 'Logo de la marque', 'name' => 'logo', 'multiple' => false])
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    @include('shared.input', ['class' => 'col', 'label' => 'Nom de la marque', 'name' => 'name', 'value' => $marque->name])
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    @include('shared.input', ['class' => 'col', 'label' => 'Slogan', 'name' => 'slogan', 'value' => $marque->slogan])
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    @include('shared.input', ['class' => 'col', 'type' => 'textarea', 'label' => 'Description (facultatif)', 'name' => 'description', 'value' => $marque->description])
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    @include('shared.select', ['class' => 'col', 'label' => 'Type de produit', 'name' => 'propertie', 'value' => $marque->propertie()->pluck('id'), 'multiple' => true])
                </div>
            </div>
            <button class="btn btn-primary mt-2" type="submit">
                @if ($marque->exists)
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
