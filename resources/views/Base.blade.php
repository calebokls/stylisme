<!DOCTYPE html>
<html lang="en">
<head>
	<title>MoDo</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{asset('images/icons/favicon.png')}}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/bootstrap/css/bootstrap.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome-4.7.0/css/font-awesome.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/iconic/css/material-design-iconic-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('fonts/linearicons-v1.0.0/icon-font.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animate/animate.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/css-hamburgers/hamburgers.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/animsition/css/animsition.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/select2/select2.min.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/daterangepicker/daterangepicker.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/slick/slick.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/MagnificPopup/magnific-popup.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.css')}}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
	<link rel="stylesheet" type="text/css" href="{{asset('css/main.css')}}">
<!--===============================================================================================-->
<!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Libraries Stylesheet -->
    <link href="{{asset('lib/animate/animate.min.css')}}" rel="stylesheet">
    <link href="{{asset('lib/owlcarousel/assets/owl.carousel.min.css')}}" rel="stylesheet">
     <!-- Customized Bootstrap Stylesheet -->
    <link href="{{asset('css/style.css')}}" rel="stylesheet">
       <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class="animsition">
	<!-- Header -->
	<header class="header-v4">
       <!-- Header desktop -->
		<div class="container-menu-desktop">
			<!-- Topbar -->
			<div class="top-bar">
				<div class="content-topbar flex-sb-m h-full container">
					<div class="left-top-bar">
						Decouvrez l'univers époustouflant des créateurs de mode
					</div>
				</div>
			</div>
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">

					<!-- Logo desktop -->
					<a href="{{route('index')}}" class="logo">
						<img src="{{asset('images/plan.PNG')}}" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li class="active-menu">
								<a href="{{route('index')}}">Accueil</a>
							</li>

							<li class="active-menu">
								<a href="#">Marques</a>
								<ul class="sub-menu">
									<li><a href="{{route('index.marque.index.model')}}">Modèle</a></li>
									<li><a href="{{route('index.marque.index.collection')}}">Collections</a></li>
								</ul>
							</li>

							<li class="label1" data-label1="hot">
								<a href="{{route('index.index.collection')}}">Collections</a>
							</li>

							<li>
								<a href="{{route(config('chatify.routes.prefix'))}}">Messagerie</a>
							</li>
                            <li>
								<a href="{{route('user.contact')}}">Contact</a>
							</li>
						</ul>
					</div>

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
                      @if(Auth::user() && Auth::user()->acteur == "styliste")
                         <a href="{{route('style.modely.index')}}" class="dis-block cl2 hov-cl1 trans-04">
                           <span class="btn btn-info">Dashboad</span>
                        </a>

                        <a href="{{route('modo.subscribe')}}" class="dis-block cl2 hov-cl1 trans-04 p-l-22 p-r-11">
                            {{-- <kkiapay-widget  amount="1500" key="171fb3e57ce862214a68db3a6e58235b6897cd30"
                            callback="https://kkiapay-redirect.com" /> --}}
                           <span class="btn btn-success">Premium</span>
                        </a>
                         <div class="bg-danger">
                             <form action="{{route('logout')}}" method="POST">
                                @csrf
                                 <button class="btn btn-danger">Deconnexion</button>
                             </form>
						</div>
                         @elseif(Auth::user() && Auth::user()->acteur === "user")
                          <div class="bg-danger">
                             <form action="{{route('logout')}}" method="POST">
                                @csrf
                                 <button class="btn btn-danger">Deconnexion</button>
                             </form>
						 </div>
                        @else
                            <div class="bg-danger mr-3">
							 <a href="{{route('register')}}"><button class="text-white btn">S'inscrire</button></a>
						   </div>
                           <div class="bg-success">
							  <a class="text-white" href="{{route('login')}}"><button class="text-white btn">Se conecter</button></a>
						   </div>
                      @endif
					</div>
				</nav>
			</div>
		</div>

		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->
			<div class="logo-mobile">
				<a href="{{route('index')}}"><img src="{{asset('images/plan.PNG')}}" alt="IMG-LOGO"></a>
			</div>
			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>


		<!-- Menu Mobile -->
		<div class="menu-mobile">
			<ul class="topbar-mobile">
				<li>
					<div class="left-top-bar">
						Decouvrez l'univers époustouflant des créateurs de mode
					</div>
				</li>
			</ul>

			<ul class="main-menu-m">
				<li>
					<a href="{{route('index')}}">Accueil</a>
				</li>

				<li>
					<a href="#">Marques</a>
					<ul class="sub-menu-m">
						<li><a href="{{route('index.marque.index.model')}}">Modèles</a></li>
						<li><a href="{{route('index.marque.index.collection')}}">Collections</a></li>
					</ul>
					<span class="arrow-main-menu-m">
						<i class="fa fa-angle-right" aria-hidden="true"></i>
					</span>
				</li>

				<li>
					<a href="{{route('index.index.collection')}}" class="label1 rs1" data-label1="hot">Collections</a>
				</li>

				<li>
					<a href="{{route(config('chatify.routes.prefix'))}}">Messagerie</a>
				</li>
                 <li>
					<a href="{{route('user.contact')}}">Contact</a>
				</li>

                <!-- Icon header -->
			<div class="wrap-icon-header">
                      @if(Auth::user() && Auth::user()->acteur === "styliste")
                        <a href="{{route('style.modely.index')}}" class="dis-block cl2 hov-cl1 trans-04 p-l-10 p-r-11">
                           <span class="btn btn-success">Administration</span>
                        </a>
                        <a href="#" class="dis-block cl2 hov-cl1 trans-04 p-l-10 p-r-11 mt-2">
                            {{-- <kkiapay-widget  amount="1500" key="171fb3e57ce862214a68db3a6e58235b6897cd30"
                            callback="https://kkiapay-redirect.com" /> --}}
                           <span class="btn btn-success">Premium</span>
                        </a>
                         <div class="mt-2 ml-3">
                             <form action="{{route('logout')}}" method="POST">
                                @csrf
                                 <button class="btn btn-danger">Deconnexion</button>
                             </form>

						</div>
                        @elseif(Auth::user() && Auth::user()->acteur === "user")
                         <div class="mt-2 ml-2">
                             <form action="{{route('logout')}}" method="POST">
                                @csrf
                                 <button class="btn btn-danger">Deconnexion</button>
                             </form>
                         </div>
                        @else
                            <div class="text-white  ml-4">
							 <a>S'inscrire</a>
						   </div>
                           <div class="ml-4">
							  <a class="text-white" href="{{route('login')}}">Se conecter</a>
						   </div>
                      @endif
					</div>
			</ul>
		</div>
	</header>
    <div class="content-wrapper">
            <!-- Content -->
            <div class="container-xxl flex-grow-1 container-p-y">
                     <div class="centered-content">
                           @include('shared.flash')
                     </div>
                      @yield('content')
            </div>
            <!-- / Content -->
            <div class="content-backdrop fade"></div>
          </div>
	<!-- Footer -->
	<footer class="bg3 p-t-75 p-b-32">
		<div class="container">
			<div class="row">
				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Categories
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Accueil
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Marques
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Collections
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Messagerie
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Aide?
					</h4>

					<ul>
						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Tableau de bord
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Premium
							</a>
						</li>

						<li class="p-b-10">
							<a href="#" class="stext-107 cl7 hov-cl1 trans-04">
								Deconnexion
							</a>
						</li>
					</ul>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						MoDo
					</h4>

					<p class="stext-107 cl7 size-201">
                     Donner une nouvelle dimension a vos création
					</p>

					<div class="p-t-27">
						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
                            <i class="bi bi-facebook"></i>
						</a>

						<a href="#" class="fs-18 cl7 hov-cl1 trans-04 m-r-16">
							<i class="bi bi-instagram"></i>
						</a>
					</div>
				</div>

				<div class="col-sm-6 col-lg-3 p-b-50">
					<h4 class="stext-301 cl0 p-b-30">
						Newsletter
					</h4>

					<form>
						<div class="wrap-input1 w-full p-b-4">
							<input class="input1 bg-none plh1 stext-107 cl7" type="text" name="email" placeholder="votre adresse e-mail">
							<div class="focus-input1 trans-04"></div>
						</div>

						<div class="p-t-18">
							<button class="flex-c-m stext-101 cl0 size-103 bg1 bor1 hov-btn2 p-lr-15 trans-04">
								Subscribe
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</footer>


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>



<!--===============================================================================================-->
	<script src="{{asset('vendor/jquery/jquery-3.2.1.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/animsition/js/animsition.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/bootstrap/js/popper.js')}}"></script>
	<script src="{{asset('vendor/bootstrap/js/bootstrap.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/select2/select2.min.js')}}"></script>
	<script>
		$(".js-select2").each(function(){
			$(this).select2({
				minimumResultsForSearch: 20,
				dropdownParent: $(this).next('.dropDownSelect2')
			});
		})
	</script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/daterangepicker/moment.min.js')}}"></script>
	<script src="{{asset('vendor/daterangepicker/daterangepicker.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/slick/slick.min.js')}}"></script>
	<script src="{{asset('js/slick-custom.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/parallax100/parallax100.js')}}"></script>
	<script>
        $('.parallax100').parallax100();
	</script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/MagnificPopup/jquery.magnific-popup.min.js')}}"></script>
	<script>
		$('.gallery-lb').each(function() { // the containers for all your galleries
			$(this).magnificPopup({
		        delegate: 'a', // the selector for gallery item
		        type: 'image',
		        gallery: {
		        	enabled:true
		        },
		        mainClass: 'mfp-fade'
		    });
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/isotope/isotope.pkgd.min.js')}}"></script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/sweetalert/sweetalert.min.js')}}"></script>
	<script>
		$('.js-addwish-b2').on('click', function(e){
			e.preventDefault();
		});

		$('.js-addwish-b2').each(function(){
			var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-b2');
				$(this).off('click');
			});
		});

		$('.js-addwish-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();

			$(this).on('click', function(){
				swal(nameProduct, "is added to wishlist !", "success");

				$(this).addClass('js-addedwish-detail');
				$(this).off('click');
			});
		});

		/*---------------------------------------------*/

		$('.js-addcart-detail').each(function(){
			var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
			$(this).on('click', function(){
				swal(nameProduct, "is added to cart !", "success");
			});
		});

	</script>
<!--===============================================================================================-->
	<script src="{{asset('vendor/perfect-scrollbar/perfect-scrollbar.min.js')}}"></script>
	<script>
		$('.js-pscroll').each(function(){
			$(this).css('position','relative');
			$(this).css('overflow','hidden');
			var ps = new PerfectScrollbar(this, {
				wheelSpeed: 1,
				scrollingThreshold: 1000,
				wheelPropagation: false,
			});

			$(window).on('resize', function(){
				ps.update();
			})
		});
	</script>
<!--===============================================================================================-->
	<script src="{{asset('js/main.js')}}"></script>
</body>
</html>
