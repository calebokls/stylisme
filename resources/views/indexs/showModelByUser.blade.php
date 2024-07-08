@extends('layoutUser')
@section('title', $modely->name)
@section('content')

   <!-- Shop Detail Start -->
    <div class="container-fluid pb-5">
     <div class="col-md-3">
       <a href="{{route('signalement.signaler',['modely'=>$modely])}}">
         <h3 class="text-end">Signaler</h3>
        </a>
     </div>
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                    @foreach($modely->pictures as $key => $picture)
                       <div class="carousel-item {{$key===0 ? 'active':''}}">
                            <img style="width:600px;height:360px;"  class="" src="{{$picture->getUrlForModelyImage()}}" alt="Image">
                        </div>
                    @endforeach
                    </div>
                    <a class="carousel-control-prev" href="#product-carousel" data-slide="prev">
                        <i class="fa fa-2x fa-angle-left text-dark"></i>
                    </a>
                    <a class="carousel-control-next" href="#product-carousel" data-slide="next">
                        <i class="fa fa-2x fa-angle-right text-dark"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-7 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3>{{$modely->name}}</h3>
                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(99 Reviews)</small>
                    </div>
                    <h3 class="font-weight-semi-bold mb-4">{{number_format($modely->price,thousands_separator:'')}} FCFA</h3>
                    <p class="mb-4">{{$modely->description}}</p>
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Taille(s) disponible:</strong>
                        <form>
                          @foreach($modely->tailles as $taille)
                             <div class="custom-control custom-radio custom-control-inline">
                                <input  type="checkbox" class="custom-control-input" id="size-1" name="{{$taille->name}}" checked>
                                <label class="custom-control-label" for="size-1">{{$taille->name}}</label>
                            </div>
                          @endforeach
                        </form>
                    </div>
                    <div class="d-flex align-items-center mb-4 pt-2">
                         <div class="d-flex align-items-center mb-4 pt-2">
                              <a href="{{route('user',['id'=>$modely->user_id])}}"><button style="font-size:20px;" class="btn btn-info px-3"><i class="bi bi-chat-left-text"></i></button></a>
                         </div>
                    </div>
                    <div class="d-flex pt-2">
                        <strong class="text-dark mr-2">Share on:</strong>
                        <div class="d-inline-flex">
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a class="text-dark px-2" href="">
                                <i class="fab fa-pinterest"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                       <h1>Autres article</h1>
                        {{-- <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a> --}}
                    </div>
                    <div class="tab-content">
                        <div class="row" id="tab-pane-1">
                           @foreach($modeliesUsers as  $modely)
                              <div class="col-md-3 mb-3">
                                <a href="{{route('index.show.modely.user',['user'=>$modely->user_id,'modely'=>$modely])}}">
                                   <img  class="w-100 h-100" src="{{$modely->getPicture()->getUrlForModelyImage()}}" alt="Image">
                                </a>
                             </div>
                           @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

