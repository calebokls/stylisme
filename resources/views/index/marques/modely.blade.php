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
						   Rechercher...
					</div>
				</div>

				<!-- Search product -->
				<div class="dis-none panel-search w-full p-t-10 p-b-15">
					<div class="bor8 dis-flex p-l-15">
						<button class="size-113 flex-c-m fs-16 cl2 hov-cl1 trans-04">
							<i class="zmdi zmdi-search"></i>
						</button>
                          <input id="search" class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search" placeholder="Rechercher...">
					</div>
				</div>
			</div>

			<div id="modely"  class="row isotope-grid">
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
             <div id="modelies-list"></div>
            <div id="model-search"></div>
            <div id="load-more-trigger" style="height: 1px;"></div>
		</div>
	</div>
    <script type="text/javascript">
      $('document').ready(function(){
        $('#search').keyup(function(e){
            let val = $(this).val()
            if(val ==="")
            {
               $(".isotope-grid").show();
               $("#model-search").hide();
            }else{
               $(".isotope-grid").hide();
               $("#model-search").show();
            }
            $.ajax({
                 type: 'GET',
                 url: '/index/index-model-search',
                 data: { 'search': val },
                 success: function(data) {
                       console.log(data);
                   $("#model-search").html(data);
                }
            })
        })
             // Variables pour le chargement infini
           let skip = 2; // Valeur initiale de skip en supposant que les 2 premiers éléments sont déjà chargés
           let take = 2; // Nombre d'éléments à charger à chaque demande
           let loading = false;

     // Fonction de chargement infini
         function loadMore(entries, observer) {
            entries.forEach(entry => {
            if (entry.isIntersecting && !loading) {
                loading = true;
                observer.unobserve(entry.target); // Arrêter l'observation lors du chargement
               loadMoreMarqueModel().then(() => {
                    loading = false;
                    observer.observe(entry.target); // Re-observer après chargement
                }).catch(() => {
                    loading = false; // Réinitialiser loading en cas d'erreur
                });
            }
        });
    }

    // Configuration de l'IntersectionObserver
    const observer = new IntersectionObserver(loadMore, {
        root: null,
        rootMargin: '0px',
        threshold: 1.0 // Déclenchement lorsque la cible est entièrement visible
    });

    // Élément de déclenchement
    const trigger = document.getElementById('load-more-trigger');
    observer.observe(trigger);

    // Fonction pour charger plus de contenus
    function loadMoreMarqueModel() {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'GET',
                url: '/index/scrollindexmodel',
                data: { skip: skip, take: take },
                success: function(response) {
                     $('#modelies-list').append(response);
                    skip += take;
                    resolve();
                },
                error: function() {
                    alert('Erreur lors du chargement');
                    reject();
                }
            });
        });
    }
});
</script>
@endsection
