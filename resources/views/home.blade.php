@extends('layoutUser')
@section('title', 'Accueil')
@section('content')
 <header>

	</header>

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

    <!-- Slider -->
	<section class="section-slide">
		<div class="wrap-slick1">
			<div class="slick1">
				<div class="item-slick1" style="background-image: url({{asset('images/slide-01.jpg')}});">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Women Collection 2018
								</span>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									NEW SEASON
								</h2>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="zoomIn" data-delay="1600">
								<a href="product.html" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1" style="background-image: url({{asset('images/slide-02.jpg')}});">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rollIn" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Men New-Season
								</span>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="lightSpeedIn" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									Jackets & Coats
								</h2>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
								<a href="product.html" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="item-slick1" style="background-image: url({{asset('images/slide-03.jpg')}});">
					<div class="container h-full">
						<div class="flex-col-l-m h-full p-t-100 p-b-30 respon5">
							<div class="layer-slick1 animated visible-false" data-appear="rotateInDownLeft" data-delay="0">
								<span class="ltext-101 cl2 respon2">
									Men Collection 2018
								</span>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="rotateInUpRight" data-delay="800">
								<h2 class="ltext-201 cl2 p-t-19 p-b-43 respon1">
									New arrivals
								</h2>
							</div>

							<div class="layer-slick1 animated visible-false" data-appear="rotateIn" data-delay="1600">
								<a href="product.html" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									Shop Now
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

    <!-- Banner -->
	<div class="sec-banner bg0 p-t-80 p-b-50">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
                    @php
                        $parameters = request()->route('user');
                    @endphp
                    <div>
                       <input type="hidden" value="{{$parameters}}" id="user_id">
                    </div>
					<div class="block1 wrap-pic-w">
						<img src="{{asset('images/banner-01.jpg')}}" alt="IMG-BANNER">

						<a href="{{route('home.womens',['user'=>$parameters])}}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Femmes
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
                                    Voire...
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="{{asset('images/banner-02.jpg')}}" alt="IMG-BANNER">

						<a href="{{route('home.mens',['user'=>$parameters])}}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Hommes
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Voire...
								</div>
							</div>
						</a>
					</div>
				</div>

				<div class="col-md-6 col-xl-4 p-b-30 m-lr-auto">
					<!-- Block1 -->
					<div class="block1 wrap-pic-w">
						<img src="{{asset('images/banner-03.jpg')}}" alt="IMG-BANNER">

						<a href="{{route('home.mixt',['user'=>$parameters])}}" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
							<div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">
									Mixtes
								</span>
							</div>

							<div class="block1-txt-child2 p-b-4 trans-05">
								<div class="block1-link stext-101 cl0 trans-09">
									Voire...
								</div>
							</div>
						</a>
					</div>
				</div>
			</div>
		</div>
	</div>

    <!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="ltext-103 cl5">
                  Les articles
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
						<input class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="homesearch" id="homesearch" placeholder="Rechercher...">
					</div>
				</div>
			</div>
            <div id="model-all">
                <h2 class="mb-3">Les modèles </h2>
			     <div class="row isotope-grid">
                     @foreach($modelies as $modely)
                        <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					       <!-- Block2 -->
					            <div class="block2">
						            <div class="block2-pic hov-img0">
							             <img style="width:400px; height:200px;" src="{{$modely->getPicture()->getUrlForModelyImage()}}" alt="IMG-PRODUCT">
							              <a href="{{route('style.modely.show',['modely'=>$modely])}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
								                 Voire....
							               </a>
						            </div>
						            <div class="block2-txt flex-w flex-t p-t-14">
							            <div class="block2-txt-child1 flex-col-l ">
								            <a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									            {{$modely->name}}
								           </a>
								            <span class="stext-105 cl3">
									           <h2>{{number_format($modely->price,thousands_separator:'')}} FCFA</h2>
								            </span>
							            </div>
						          </div>
					         </div>
				         </div>
                     @endforeach
			     </div>
        </div>
        <div id="model-more"></div>
        <div id="model-vetement"></div>
        <div id="search-home"></div>

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
        var userId = '{{ $user->id }}';
        $('#homesearch').on('keyup',function(){
            let val = $(this).val();
            if(val == "")
            {
               $('.isotope-grid').show();
               $('#search-home').hide();
            }else{
               $('.isotope-grid').hide();
               $('#search-home').show();
            }
            $.ajax({
                type:'GET',
                url:'/searchhome/'+userId,
                data:{
                    homesearch:val,
                    user_id:userId
                },
                success:function(response){
                    $('#search-home').append(response)
                },
                error:function()
                {
                    alert('Erreur lors de la recherche')
                }
            })
        })
        $('#load-more-button').click(function() {
        var button = $(this);
        var skip = button.data('skip');
        $.ajax({
            url: '/home/loadMoreModel/'+userId,
            method: 'GET',
            data: {
                skip: skip,
                user_id: userId
            },
            success: function(data) {
                if(data.modelies.trim() === '')
                {
                   button.hide()
                }else{
                    $('#model-more').append(data.modelies);
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
