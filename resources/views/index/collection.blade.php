@extends('Base')
@section('title', 'Accueil')
@section('content')
    <!-- Product -->
	<section class="bg0 p-t-23 p-b-140">
		<div class="container">
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
            <div class="row isotope-grid">
                 @foreach($collectionies as $keys=>$collectiony)
                      <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					       <a  class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6 mb-3">
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
        <div id="modelies-list"></div>
        <div id="collection-index-search"></div>
			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<div id="loading-message" style="display: none;">Chargement...</div>
			</div>
		</div>
	</section>
    <script type="text/javascript">
    $('document').ready(function(){
           $('#search').keyup(function(e){
             let val = $(this).val()
            if(val ==="")
            {
               $(".isotope-grid").show();
               $("#collection-index-search").hide();
            }else{
               $(".isotope-grid").hide();
               $("#collection-index-search").show();
            }
            $.ajax({
                 type: 'GET',
                 url: '/index/index-collection-index-search',
                 data: { 'search': val },
                 success: function(data) {
                   $("#collection-index-search").html(data);
                }
            })
        })
         let skip = 2;
    let take = 2;
    let loading = false;

    window.addEventListener('scroll', function() {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight && !loading && $("#search").val() == "") {
            loading = true;
            $('#loading-message').show();
            loadMoreModelies();
        }
    });

    function loadMoreModelies() {
        $.ajax({
            type: 'GET',
            url: '/index/scrollIndex-collection',
            data: { skip: skip, take: take },
            success: function(response) {
                document.getElementById('modelies-list').innerHTML += response;
                skip += take;
                $('#loading-message').hide();
                loading = false;
            },
            error: function() {
                alert('Erreur lors du chargement');
                $('#loading-message').hide();
                loading = false;
            }
        });
    }
       });
    </script>
@endsection
