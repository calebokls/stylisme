@extends('styliste.collections.layoutCollection')
@section('title', 'Collection '.$collectiony->name)
@section('content')
<div class="container-fluid pb-5">
      @php
        $parameters = request()->route('user');
   @endphp
     <div class="col-md-3">
       <a href="{{route('signalement.signler.collection',['collectiony'=>$collectiony->user_id])}}">
         <h3 class="text-end">Signaler</h3>
        </a>
     </div>
        <div class="row px-xl-5">
            <div class="col-lg-5 mb-30">
                <div id="product-carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner bg-light">
                    @php
                        $i=0;
                      $active = true;
                    @endphp
                    @foreach(unserialize($collectiony->product) as $key => $prods)
                        @php
                            $i++;
                        @endphp
                        @if(isset($prods["images{$i}"]))
                            @foreach($prods["images{$i}"] as $images)
                                @foreach($images as $k => $image)
                                    <div class="carousel-item @if($active) active @endif">
                                       <img style="width:600px;height:360px;" src="{{ asset('storage/' . $image) }}" alt="Image">
                                    </div>
                                    <input type="hidden" value="{{$i}}" id="nbre">
                                    @php
                                      $active = false;
                                    @endphp
                                @endforeach
                            @endforeach
                        @endif
                        {{-- @if(isset($prods['prices1']))
                        <h3 class="font-weight-semi-bold mb-4" id="prices">{{$prods['prices1']}}</h3>
                        @endif --}}
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
                    <h3>{{$collectiony->name}}</h3>
                    <input type="hidden" value="{{$collectiony->id}}" id="nbrecollect">
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
                    <div class="d-flex">
                         <h3 class="font-weight-semi-bold mb-4" id="prices"></h3>
                          <h3 class="ml-3">FCFA</h3>
                    </div>
                    <p id="description" class="mb-4"></p>
                    <div class="d-flex mb-3">
                        <strong class="text-dark mr-3">Tailles disponible:</strong>
                        <form>
                            {{-- <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="size-1" name="size">
                                <label class="custom-control-label" for="size-1">XS</label>
                            </div> --}}
                            <div id="tailles"></div>
                        </form>
                    </div>
                    <div class="d-flex align-items-center mb-4 pt-2">
                       <a href="{{route('user',['id'=>$collectiony->user_id])}}"><button style="font-size:20px;" class="btn btn-info px-3"><i class="bi bi-chat-left-text"></i></button></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row px-xl-5">
            <div class="col">
                <div class="bg-light p-30">
                    <div class="nav nav-tabs mb-4">
                      <h1>Autre articles</h1>
                        {{-- <a class="nav-item nav-link text-dark active" data-toggle="tab" href="#tab-pane-1">Description</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-2">Information</a>
                        <a class="nav-item nav-link text-dark" data-toggle="tab" href="#tab-pane-3">Reviews (0)</a> --}}
                    </div>
                    <div class="tab-content">
                        <div class="row" id="tab-pane-1">
                            @foreach($collectionies as  $collectiony)
                                   @foreach(unserialize($collectiony->product) as $prods)
                                      @if(isset($prods["images1"]))
                                         @foreach($prods["images1"] as $images)
                                            @if(isset($images["image0"]))
                                               <div class="col-md-3">
                                                  <a href="{{route('style.collectiony.show',$collectiony)}}">
                                                   <img  class="w-100 h-100 mt-3" src="{{asset('storage/'.$images["image0"])}}" alt="Image">
                                                   </a>
                                              </div>
                                            @endif
                                         @endforeach
                                      @endif
                                   @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            let nbreCollect = parseInt($("#nbrecollect").val());
            $.ajax({
                type:'GET',
                url: '/style/collectiony/nbre/'+nbreCollect,
                data:{nbreCollect:nbreCollect},
                processData:false,
                contentType:false,
                success: function(response){
                let collectionies = Object.values(response.collectiony);
                let j=0;
                  collectionies.forEach(collectiony=>{
                      $('#prices').text((collectiony["prices1"]));
                      $('#description').text(collectiony["descriptions1"]);
                      if(collectiony["tailles1"]){
                        collectiony["tailles1"].forEach(collection=>{
                            j++;
                           let div = document.createElement('div');
                           div.classList.add('custom-control','custom-radio','custom-control-inline');
                           let input = document.createElement('input');
                           input.setAttribute('type','radio');
                           input.setAttribute('id','size-'+j);
                           input.setAttribute('name','size');
                           input.classList.add('custom-control-input');
                           let label = document.createElement('label');
                           label.setAttribute('class','custom-control-label');
                           label.setAttribute('for','size-'+j);
                           label.innerText = collection
                           div.appendChild(input)
                           div.appendChild(label)
                           $("#tailles").append(div)
                        })

                      }
                  })
                       $('#product-carousel').on('slid.bs.carousel', function()
                        {
                            let i=0;
                          let iValue = $('.carousel-item.active').next('input[type="hidden"]').val();
                            collectionies.forEach(collectiony=>
                            {
                              $('#prices').text(collectiony["prices"+iValue]);
                               $('#description').text(collectiony["descriptions"+iValue]);
                               if(collectiony["tailles"+iValue]){
                                  $('#tailles').empty();
                              collectiony["tailles"+iValue].forEach(collection=>{
                                i++;
                               let div = document.createElement('div');
                             div.classList.add('custom-control','custom-radio','custom-control-inline');
                               let input = document.createElement('input');
                               input.setAttribute('type','radio');
                               input.setAttribute('id','size-'+i);
                               input.setAttribute('name','size');
                              input.classList.add('custom-control-input');
                              let label = document.createElement('label');
                               label.setAttribute('class','custom-control-label');
                              label.setAttribute('for','size-'+i);
                             label.innerText = collection
                              div.appendChild(input)
                              div.appendChild(label)
                              $("#tailles").append(div)
                           })
                       }
                         })
                       });
                },
                error: function()
                {
                    console.log("erreur...")
                }

            });
        })
    </script>
@endsection
