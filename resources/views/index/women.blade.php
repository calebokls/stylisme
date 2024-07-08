@extends('Base')
@section('content')
 <!-- Product -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
				<div class="flex-w flex-c-m m-tb-10">
					<div class="flex-c-m stext-106 cl6 size-105 bor4 pointer hov-btn3 trans-04 m-tb-4 js-show-search">
						<i class="icon-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-search"></i>
						<i class="icon-close-search cl2 m-r-6 fs-15 trans-04 zmdi zmdi-close dis-none"></i>
						Recherche...
					</div>
				</div>

				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>

						<input id="search" class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" placeholder="Search">
					</div>
				</div>
			</div>

			<div class="row isotope-grid">
              @foreach($womens as $women)
                 <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div class="block2-pic hov-img0">
							<img style="width:300px; height:200px;" src="{{$women->getPicture()->getUrlForModelyImage()}}" alt="IMG-PRODUCT">

							<a href="{{route('style.modely.show',['modely'=>$women])}}" class="quick-view-button block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
								Voire...
							</a>
						</div>

						<div class="block2-txt flex-w flex-t p-t-14">
							<div class="block2-txt-child1 flex-col-l ">
								<a href="product-detail.html" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
									{{$women->name}}
								</a>

								<span class="stext-105 cl3">
									{{$women->price}}
								</span>
							</div>

							<div class="block2-txt-child2 flex-r p-t-3">
								<a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
									<img class="icon-heart1 dis-block trans-04" src="{{asset('images/icons/icon-heart-01.png')}}" alt="ICON">
									<img class="icon-heart2 dis-block trans-04 ab-t-l" src="{{asset('images/icons/icon-heart-02.png')}}" alt="ICON">
								</a>
							</div>
						</div>
					</div>
				</div>
              @endforeach
			</div>
            <div id="modelies-list"> </div>
            <div id="search-women"></div>

			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<div id="loading-message" style="display: none;">Chargement...</div>
			</div>
		</div>
	</div>
    <script type="text/javascript">
     $(document).ready(function() {
    $("#search").keyup(function() {
        $value = $(this).val();
        console.log($value);
        if ($value == "") {
            $(".isotope-grid").show();
            $("#search-women").hide();
        } else {
            $(".isotope-grid").hide();
            $("#search-women").show();
        }
        $.ajax({
            type: 'GET',
            url: '/home/womens-search',
            data: { 'search': $value },
            success: function(data) {
                console.log(data);
                $("#search-women").html(data);
            }
        });
    });

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
            url: '/home/scrollIndex-women',
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
