@extends('layoutUser')
@section('title', 'Accueil')
@section('content')
    <!-- Banner -->
	<div class="sec-banner bg0  p-b-50">
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
				</div>
			</div>
		</div>
	</div>

    <!-- Product -->
	<section class="bg0 p-b-140">
		<div class="container">
			<div class="p-b-10">
				<h3 class="text-info ltext-103 cl5">
                  Les articles disponible dans la marque {{$marque->name}}
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
			         <div class="row isotope-grid">
                         @foreach($marque->modelies as $key =>$modely)
                                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					            <!-- Block2 -->
					               <div class="block2">
						                <div class="block2-pic hov-img0">
                                           <img style="width:400px; height:200px;" src="{{$modely->getPicture()->getUrlForModelyImage()}}" alt="IMG-PRODUCT">
							                  <a href="{{route('index.show.modely.user',['user'=>$modely->user_id,'modely'=>$modely])}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
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
        <div id="loadMoreShowModely"></div>
        <div id="search-showMarqueModely"></div>

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
            user = '{{$marque->user_id}}'
            marque = '{{$marque->id}}'
          $('#search').on('keyup',function(){
            let val = $(this).val();
            if(val=="")
            {
                $('.isotope-grid').show();
                $('#search-showMarqueModely').hide();
            }else{
                 $('.isotope-grid').hide();
                $('#search-showMarqueModely').show();
            }
            $.ajax({
                type:'GET',
                url:'/index/searchShowMarqueModely/'+marque+'/'+user,
                data:{
                     'search':val,
                     'marque':marque,
                     'user_id':user
                     },
                success:function(response){
                  $('#search-showMarqueModely').append(response);
                },
                error:function()
                {
                    alert('Erreur lors de la recherche')
                }
            })
          });

        $('#load-more-button').click(function() {
        var button = $(this);
        var skip = button.data('skip');
        var marque = '{{$marque->id}}' ;
        var userId = '{{$marque->user_id}}'   // Assume you pass the user ID to the view
        $.ajax({
            url: '/home/loadMoreShowMarqueModely/'+marque+'/'+userId,
            method: 'GET',
            data: {
                skip: skip,
                marque: marque,
                user_id:userId
            },
            success: function(data) {
                if(data.marque.trim() === '')
                {
                   button.hide()
                }else{
                    $('#loadMoreShowModely').append(data.marque);
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
