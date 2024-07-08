<div  class="row isotope-grid">
              @forelse($marques as $marque)
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
              @empty
                Aucune marque ne correspond a votre Recherche
              @endforelse()
			</div>
