@extends('layoutUser')
@section('content')
 <!-- Product -->
	<div class="bg0 m-t-23 p-b-140">
		<div class="container">
			<div class="flex-w flex-sb-m p-b-52">
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

						<input id="search" class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" placeholder="rechercher une marque de {{$user->entreprise}}">
					</div>
				</div>
			</div>

			<div class="row isotope-grid">
              @foreach($marques as $marque)
                 <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
					<!-- Block2 -->
					<div class="block2">
						<div style="width:220px;height:220px;border-radius:50%;" class="bg-info block2-pic hov-img0 text-center d-flex align-items-center justify-content-center mt-3">
                            <img class="overflow-hidden" style="width:200px; height:200px;border-radius:50%;" src="{{$marque->getImageForMarquesUrl()}}" alt="IMG-PRODUCT">
                            <a href="{{route('index.show.marque.modely',['marque'=>$marque->id,'user'=>$marque->user_id])}}" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 d-inline-block mt-3 pt-2">
                               {{$marque->name}}
                             </a>
                        </div>
					</div>
				</div>
              @endforeach
			</div>
            <div id="search-marquemodely"></div>
            <div id="marquemodely-more"></div>

			<!-- Load more -->
			<div class="flex-c-m flex-w w-full p-t-45">
				<button id="load-more-button" data-skip="4" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
					Voire plus
				</button>
			</div>
		</div>
	</div>
    <script type="text/javascript">
        $('document').ready(function(){
           $('#search').on('keyup',function(){
            let val = $(this).val();
            if(val =="")
            {
                $('.isotope-grid').show();
                $('#search-marquemodely').hide();
            }else{
                $('.isotope-grid').hide();
                $('#search-marquemodely').show();
            }
            $.ajax({
                type:'GET',
                url:'/index/searchMarqueModely',
                data:{'search':val},
                success:function(response){
                    $('#search-marquemodely').append(response)
                },
                error:function(){
                    alert('Erreur');
                }
            })
           })

        $('#load-more-button').click(function() {
        var button = $(this);
        var skip = button.data('skip');
        var userId = '{{ $user->id }}';// Assume you pass the user ID to the view
        $.ajax({
            url: '/home/loadMoreMarqueModely/'+userId,
            method: 'GET',
            data: {
                skip: skip,
                user_id: userId
            },
            success: function(data) {
                if(data.marques.trim() === '')
                {
                   button.hide()
                }else{
                    $('#marquemodely-more').append(data.marques);
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
@endsection
