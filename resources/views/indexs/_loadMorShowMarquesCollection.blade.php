 <!-- Product -->
	<section class="bg0">
		<div class="container">
            <div class="row isotope-grid">
                 @foreach($marque->collectionies as $keys=>$collectiony)
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
		</div>
	</section>
