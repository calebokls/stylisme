@extends('manequins.layout')
@section('title',$manequin->exists?'Modifier un media':'Créé un nouveau media')
@section('content')
<div class="row">
   <div class="col-md-6">
      <div class="row">
          @foreach($manequin->medias as $media)
             <div class="col-md-4 mb-3">
                  @if(in_array(pathInfo($media->getUrlForManequinaImage(),PATHINFO_EXTENSION),['mp4','WebM','Ogg']))
                     <video style="width:200px;heigth:200px;" src="{{$media->getUrlForManequinaImage()}}" controls></video>
                      @else
                      <img style="width:100px;heigth:100px;" src="{{$media->getUrlForManequinaImage()}}">
                  @endif
                   <form action="{{route('manequina.',$media)}}" method="POST">
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
    <form class="vstack gap-2" action="{{ $manequin->exists ? route('manequina.manequin.update', ['manequin' => $manequin]) : route('manequina.manequin.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        @if($manequin->exists)
            @method('put')
        @endif
        <div class="card mb-4">
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    @include('shared.input', ['class' => 'col', 'label' => 'Nom du media', 'name' => 'name', 'value' => $manequin->name])
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    @include('shared.upload', ['class' => 'col', 'label' => 'Media(s)', 'name' => 'files', 'multiple' => true, 'value' => 'mmmdmd'])
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    @include('shared.input', ['class' => 'col', 'type' => 'textarea', 'label' => 'Description', 'name' => 'description', 'value' => $manequin->description])
                </div>
            </div>
            <button class="btn btn-primary mt-2" type="submit">
                {{ $manequin->exists ? 'Modifier' : 'Ajouter' }}
            </button>
        </div>
    </form>
</div>

</div>

@endsection
