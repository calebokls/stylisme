<div class="modal-body">
        <h4>Nom:<span style="margin-left:10px;">{{$validationy->nom}}</span></h4>
        <h4 id="prenom"> Prénoms:<span style="margin-left:10px;">{{$validationy->prenom}}</span></h4>
          <div class="row">
			 <div class="col-md-6">
                <h4>La photo:</h4>
                 <div  class="wrap-pic-w pos-relative">
	                <img class="w-100 h-100" id="model-img-photo" src="{{asset('storage/'.$validationy->photo)}}" alt="IMG-PRODUCT">
                 </div>
			</div>
              <div class="col-md-6">
                   <h4>La photo de la pièce</h4>
                        <div  class="wrap-pic-w pos-relative">
	                      <img class="w-100 h-100" id="model-img-piece" src="{{asset('storage/'.$validationy->piece)}}" alt="IMG-PRODUCT">
                        </div>
			 </div>
		  </div>
      </div>
      <div class="row">
         <div class="col-md-8">
            <h4>Photo de la personne + sa pièce d'identité</h4>
               <div  class="wrap-pic-w pos-relative">
	               <img class="w-100 h-100" id="model-img-complet" src="{{asset('storage/'.$validationy->image_data)}}" alt="IMG-PRODUCT">
               </div>
         </div>
      </div>
