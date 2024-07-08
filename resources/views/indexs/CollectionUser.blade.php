@extends('layoutUser')
@section('title', 'Accueil')
@section('content')
    <!-- Cart -->
	<div class="wrap-header-cart js-panel-cart">
		<div class="s-full js-hide-cart"></div>

		<div class="header-cart flex-col-l p-l-65 p-r-25">
			<div class="header-cart-title flex-w flex-sb-m p-b-8">
				<span class="mtext-103 cl2">
					Your Cart
				</span>

				<div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
					<i class="zmdi zmdi-close"></i>
				</div>
			</div>

			<div class="header-cart-content flex-w js-pscroll">
				<ul class="header-cart-wrapitem w-full">
					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="{{asset('images/item-cart-01.jpg')}}" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								White Shirt Pleat
							</a>

							<span class="header-cart-item-info">
								1 x $19.00
							</span>
						</div>
					</li>

					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="{{asset('images/item-cart-02.jpg')}}" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Converse All Star
							</a>

							<span class="header-cart-item-info">
								1 x $39.00
							</span>
						</div>
					</li>

					<li class="header-cart-item flex-w flex-t m-b-12">
						<div class="header-cart-item-img">
							<img src="{{asset('images/item-cart-03.jpg')}}" alt="IMG">
						</div>

						<div class="header-cart-item-txt p-t-8">
							<a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
								Nixon Porter Leather
							</a>

							<span class="header-cart-item-info">
								1 x $17.00
							</span>
						</div>
					</li>
				</ul>

				<div class="w-full">
					<div class="header-cart-total w-full p-tb-40">
						Total: $75.00
					</div>

					<div class="header-cart-buttons flex-w w-full">
						<a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
							View Cart
						</a>

						<a href="shoping-cart.html" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
							Check Out
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>
   @php
      $parameters = request()->route('user');
    @endphp
    <!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="text-info ltext-103 cl5">
                  Les collections de {{$user->entreprise}}
				</h3>
			</div>

			<div class="flex-w flex-sb-m p-b-10">
				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Rechercher...
					</div>
				</div>

				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>
						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" id="search" placeholder="Rechercher...">
					</div>
				</div>
			</div>
            <div id="model-all">
                <h2 class="mb-3">Les collections</h2>
                  <div class="row isotope-grid">
                      @foreach($collectionies as $keys=>$collectiony)
                         <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					          <a href="#" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 mb-3">
									{{$collectiony->name}}
					          </a>
                                <!-- Block2 -->
					          <div class="block2">
                                 @foreach(unserialize($collectiony->product) as $key => $prods)
                                     <div class="block2-txt-child1 flex-col-l ">
								          <span class="stext-105 cl3">
                                             @if(isset($prods["prices1"]))
                                                 <h2>{{number_format($prods["prices1"],thousands_separator:'')}} FCFA</h2>
                                             @endif
								         </span>
						          	 </div>
                                     <div class="block2-pic hov-img0">
                                          @if(isset($prods["images1"]))
                                              @foreach($prods["images1"] as $images)
                                                  @foreach($images as $key=> $image)
                                                     @if(isset($images["image0"]))
                                                         <img style="width:400px; height:200px;" src="{{ asset('storage/' . $images["image0"]) }}" alt="IMG-PRODUCT">
							                              <a href="{{route('index.show.collectiony.user',['user'=>$collectiony->user_id,'collectiony'=>$collectiony])}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
								                                Voire...
							                              </a>
                                                     @endif
                                                  @endforeach
                                               @endforeach
                                          @endif
						             </div>
                                @endforeach
					          </div>
				         </div>
                      @endforeach
			     </div>
          </div>
        <div id="collection-more"></div>
        <div id="search-collectionuser"></div>

			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<button id="load-more-button" data-skip="4" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Voire plus
				</button>
			</div>
		</div>
	</section>
    <script type="text/javascript">
       $('document').ready(function(){
         var userId = '{{ $user->id }}';// Assume you pass the user ID to the view
        $('#search').on('keyup',function(){
            let val = $(this).val();
            if(val == "")
            {
                $('.isotope-grid').show();
                $('#search-collectionuser').hide();
            }else{
                 $('.isotope-grid').hide();
                $('#search-collectionuser').show();
            }
            $.ajax({
                type:'GET',
                url:'/index/searchcollectionbyuser/'+userId,
                data:{
                    search:val,
                    user:userId
                },
                success:function(response){
                    $('#search-collectionuser').append(response);
                },
                error:function()
                {
                    alert('Erreur lors de la recherche...')
                }
            })
        })
        $('#load-more-button').click(function() {
        var button = $(this);
        var skip = button.data('skip');
        $.ajax({
            url: '/home/loadMoreCollection/'+userId,
            method: 'GET',
            data: {
                skip: skip,
                user_id: userId
            },
            success: function(data) {
                if(data.collectionies.trim() === '')
                {
                   button.hide()
                }else{
                    $('#collection-more').append(data.collectionies);
                    button.data('skip',skip + 4);
                    if(!data.hasMore)
                    {
                        button.hide()
                    }
                }
            },
            error: function() {
                alert('Erreur lors du chargement des données.');
            }
        });
      });
    });
    </script>
    <script src="https://cdn.kkiapay.me/k.js"></script>
@endsection
