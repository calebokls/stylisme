<div class="row isotope-grid">
                     @forelse($modelies as $modely)
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
                     @empty
                      Aucun model ne correspond a votre recherche
                     @endforelse
</div>
