<div class="row isotope-grid">
               @forelse($users as  $user)
                  <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item user">
					<!-- Block2 -->
					<div class="block2">
						<div  style="width:220px;height:220px;border-radius:50%;" class="bg-danger block2-pic hov-img0 text-center d-flex align-items-center justify-content-center mt-3">
							<img class="overflow-hidden" style="width:200px; height:200px;border-radius:50%;" src="{{$user->getUrlForLogo()}}" alt="IMG-PRODUCT">
							<a href="#" class="quick-view-button block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 js-show-modal1" id="{{$user->id}}">
								{{$user->entreprise}}
							</a>
						</div>
					</div>
				</div>
               @empty
                     Aucun article ne correspond a votre recherche
               @endforelse
</div>
