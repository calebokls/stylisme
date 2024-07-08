@extends('styliste.layoutsEditCollections')
@section('title', 'Créé une collection')
@section('content')
<div class="row">
  <div class="col-md-4">
  <div class="row">

     @foreach(unserialize($collectiony->product) as  $produts)
         @if(is_array($produts))
            @foreach($produts as $kay=> $prods)
               @if(is_array($prods))
                 @foreach($prods as  $values)
                    @if(is_array($values))
                      @foreach($values as $key => $value)
                      <div class="col-md-4">
                           <img class="mt-3" style="width:100px;height:100px; overflow:hidden;" src="{{asset('storage/'.$value)}}">
                           {{-- <div id="product-data" data-product="{{$key}}"></div> --}}
                            <form action="{{route('style.deleteImageCollections',['collectiony'=>$collectiony])}}" method="POST">
                               @csrf
                                @method('delete')
                                <input type="hidden" name="tableau" value="{{$kay}}">
                                <input type="hidden" name="image" value="{{$key}}">
                               <button  style="font-size:10px;" class="btn btn-danger delete-button">
                                 <span ><i class="bi bi-x"></i></span>
                               </button>
                           </form>
                      </div>
                      @endforeach
                    @endif
                 @endforeach
               @endif
            @endforeach
         @endif
      @endforeach

  </div>
  </div>
 <div class="col-md-8">
    <h1>@yield('title')</h1>
    <form class="vstack gap-2" action="{{ route('style.collectiony.update', ['collectiony' => $collectiony]) }}" method="post" enctype="multipart/form-data" id="js-form-edit">
       @csrf
        @method('PUT')
        <input type="hidden" name="collectionId" value="{{$collectiony->id}}" id="collectionId">
        <input type="hidden" name="collectionNbre" value="{{count(unserialize($collectiony->product))}}" id="collectionNbre">
        <input type="hidden" name="nbre_click"  id="nbre_click" value="0">
        <div class="card mb-4">
             <div class="card-body demo-vertical-spacing demo-only-element">
                 <div class="card-body demo-vertical-spacing demo-only-element">
                  <div class="form-password-toggle">
                    <label for="marque">Marques</label>
                    <select name="marque" class="form-select form-select-md" id="marqueSelect">
                        @foreach($primaries as $key => $primary)
                         <option {{ in_array($primary, $primaries->toArray()) ? 'selected' : '' }} value="{{ $key }}">{{ $primary }}</option>                        @endforeach
                    </select>
                </div>
            </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    @include('shared.input', ['class' => 'col', 'label' => 'Nom de la collection', 'name' => 'nom', 'value' => $collectiony->name])
                </div>
            </div>

            <div id="collections">
                @foreach (unserialize($collectiony->product) as $key => $values)
                    <div style="background-color:#E8E8FD; border:1px solid black;">
                            <a class="btn btn-danger" href="{{route('collection.input.destroy',['collectiony'=>$collectiony,'id'=>$key])}}"><button type="button" class="btn-close"></button></a>
                       @for ($i = 1; $i <= count(unserialize($collectiony->product)); $i++)
                        @foreach ($values as $k => $value)
                            @if ($k == 'images'.$i)
                                <div class="card-body demo-vertical-spacing demo-only-element">
                                    <div class="form-password-toggle">
                                        @include('shared.upload', ['class' => 'col', 'label' => 'Image '.$i, 'name' =>'images'.$i, 'multiple' => true])
                                    </div>
                                </div>
                              @endif
                               @if ($k == 'prices'.$i)
                                <div class="card-body demo-vertical-spacing demo-only-element">
                                    <div class="form-password-toggle">
                                        @include('shared.input', ['class' => 'col', 'label' => 'Prix '.$i, 'name' => 'prices'.$i, 'value' => $value])
                                    </div>
                                </div>
                            @endif
                             @if ($k == 'descriptions'.$i)
                                <div class="card-body demo-vertical-spacing demo-only-element">
                                    <div class="form-password-toggle">
                                        @include('shared.input', ['class' => 'col', 'type' => 'textarea', 'label' => 'Description '.$i, 'name' => 'descriptions'.$i, 'value' => $value])
                                    </div>
                                </div>
                            @endif
                             @if ($k == 'tailles'.$i)
                                <div class="card-body demo-vertical-spacing demo-only-element">
                                    <div class="form-password-toggle">
                                        <label for="{{ $k }}" style="color:blue;">Taille{{ $i }}</label>
                                        <select name="tailles{{$i}}[]" id="tailles{{$i}}[]" class="select-element" multiple="multiple">
                                            @foreach ($tailles as $v)
                                                <option {{ in_array($v->name, $value) ? 'selected' : '' }} value="{{ $v->name }}">{{ $v->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    @endfor
                    </div>

                @endforeach
            </div>
                <div class="mt-2 d-felx text-end">
                <p id="supprimer" class="btn btn-danger">Supprimer</p>
                <p id="completer" class="btn btn-info">Completer</p>
                </div>

            <button class="btn btn-primary mt-2" type="submit">
                Modifier
            </button>
        </div>
    </form>
</div>

</div>

  <script type="text/javascript">
  document.addEventListener('DOMContentLoaded', function() {
    //Complement
    $i = parseInt($("#collectionNbre").val());
    document.getElementById("nbre_click").value= $i;
    let collectionId = $("#collectionId").val();
    console.log(collectionId)
    let $properties=[];
    $('#completer').on('click',function(){
        $i++;
        console.log($i)
       document.getElementById("nbre_click").value= $i;
       $.ajax({
           type: 'GET',
           url: '/style/collectiony-tailles',
           dataType: "json",
           success: function(response){
             $properties = Object.values(response.properties);
             console.log($properties)

             //Création des div et label
         let div = document.createElement('div');
         let div1 = document.createElement('div');
         let div2 = document.createElement('div');
         let div3 = document.createElement('div');
         let div4 = document.createElement('div');
         let div5 = document.createElement('div');
         let div6 = document.createElement('div');
         let div7 = document.createElement('div');
         let div8 = document.createElement('div');
         let div9 = document.createElement('div');
         let div10 = document.createElement('div');
         let div11 = document.createElement('div');
         let label1 = document.createElement('label');
         let label2 = document.createElement('label');
         let label3 = document.createElement('label');
         let label4 = document.createElement('label');

         label1.setAttribute('for','image'+$i);
         label1.style="Color:blue;";
         label1.textContent = "Image "+$i;
         label2.setAttribute('for','price'+$i);
         label2.textContent = "Prix "+$i;
         label2.style="Color:blue;"
         label3.setAttribute('for','descriptions'+$i);
         label3.textContent = "Desciption "+$i;
         label3.style="Color:blue;"
         label4.setAttribute('for','tailles'+$i);
         label4.textContent = "Taille "+$i;
         label4.style="Color:blue;"


         div1.classList.add('card-body', 'demo-vertical-spacing', 'demo-only-element');
         div1.setAttribute('id','errors');
         div2.classList.add('form-password-toggle');
         div3.classList.add('card-body', 'demo-vertical-spacing', 'demo-only-element');
         div4.classList.add('form-password-toggle');
         div5.classList.add('card-body', 'demo-vertical-spacing', 'demo-only-element')
         div6.classList.add('form-password-toggle')
         div7.classList.add('card-body', 'demo-vertical-spacing', 'demo-only-element')
         div8.classList.add('invalid-feedback');
         div9.classList.add('invalid-feedback','price-error');
         div10.classList.add('invalid-feedback','description-error');
         div11.classList.add('invalid-feedback','tailles-error');

         // Création des input de type file et text
         let inputFile = document.createElement('input');
         inputFile.setAttribute('type','file');
         inputFile.setAttribute('class','form-control','image-input');
         inputFile.setAttribute('name','images'+$i+'[]');
         inputFile.setAttribute('multiple','true');
         inputFile.setAttribute('id','image');
          let inputPrice= document.createElement('input');
         inputPrice.setAttribute('type','number');
         inputPrice.classList.add('form-control');
         inputPrice.setAttribute('name','prices'+$i);
         inputPrice.setAttribute('id','price');

         let selectTaille= document.createElement('select');
            selectTaille.setAttribute('class','form-select form-select-sm tailles-input');
            selectTaille.setAttribute('id','smallSelect')
            selectTaille.setAttribute('name','tailles'+$i+'[]')
            selectTaille.setAttribute('multiple','multiple')
            for($j=0;$j<$properties.length;$j++)
            {
                let option = document.createElement('option')
                    option.text = $properties[$j];
                    option.value=$properties[$j];
                    selectTaille.add(option);
            }
        let inputDescription = document.createElement('textarea');
           inputDescription.setAttribute('class','form-control','description-input')
           inputDescription.setAttribute('name','descriptions'+$i)
           inputDescription.setAttribute('id','description')

           //Ajout des inputs aux div
         div2.appendChild(label1);
         div2.appendChild(inputFile);
         div4.appendChild(label2);
         div4.appendChild(inputPrice);
         div6.appendChild(label3)
         div6.appendChild(inputDescription);
         div7.appendChild(label4)
         div7.appendChild(selectTaille)

          div1.appendChild(div2)
         div3.appendChild(div4)
         div5.appendChild(div6)

         //Ajout de div  au div ayant pour id collections
          div.style="Border:1px solid black;margin-bottom:4px;Background-Color:#E8E8FD;";
          div.classList.add('alert', 'alert-warning', 'alert-dismissible', 'fade', 'show');
          div.setAttribute('role','alert')
          let closeButton = document.createElement('button');
          closeButton.setAttribute('type','button');
          closeButton.classList.add('btn-close');
          closeButton.setAttribute('data-bs-dismiss', 'alert');
          closeButton.setAttribute('aria-label', 'Fermer');
          //div.insertBefore(closeButton,div.firstChild)
         div.appendChild(div1);
         div.appendChild(div3);
         div.appendChild(div5);
         div.appendChild(div7);
         console.log(div)

         document.querySelector('#collections').appendChild(div)
           if(!selectTaille.classList.contains('tomeselected'))
           {
             new TomSelect(selectTaille,{
                plugins:{
                    remove_button:{
                        title:'Supprimer'
                    }
                }
             })
           }
           },
           error:function(xhr,status,error)
           {
              console.log("erreur")
           }
      });

    })

    $('#supprimer').on('click',function(){
        $j = parseInt($("#collectionNbre").val());
        if($j !== $i)
        {
          $('#collections').children().last().remove();
          $i--;
          console.log($i)
        }
    })
        let selectElement = document.getElementById("marqueSelect");
        if(selectElement.hasOwnProperty('tomselect'))
         {
            selectElement.tomeselect.destroy()
         }
         $('#js-form-edit').on('submit',function(e){
               e.preventDefault();
                 let formData = new FormData(this);
               // Récupérer le jeton CSRF
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
            // Ajouter le jeton CSRF à tes données
            formData.append('_token', csrfToken);
            console.log(formData.get('_token'))
            $('.invalid-feedback').hide();
                $.ajax({
                type: 'POST',
                 url: '/style/collectiony/'+collectionId,
                data: formData,
                 // Spécifie que nous envoyons des données binaires (comme des fichiers)
                processData: false,
                contentType: false,
                success: function(){
                     window.location.href="/style/collectiony"
                },
                error: function(xhr){
                    if(xhr.status===422)
                    {
                       var errors = xhr.responseJSON.errors;
                        $.each(errors,function(fieldName,messages){
                               var field  = $('[name="'+fieldName+'"]');
                               var MultipleField = $('[name="'+fieldName+'[]'+'"]');

                               $.each(messages,function(index,message){
                                  if(field.length>0 )
                                  {
                                         if($('#'+fieldName+'Error'+index).length === 0)
                                           {
                                            field.after('<div class="invalid-feedback" id="'+fieldName+'Error'+index+'"></div>')
                                            }
                                           field.addClass('is-invalid');
                                           $('#'+fieldName+'Error'+index).text(message).show()
                                  }
                                 if(MultipleField.length>0)
                                  {
                                    if($('#'+fieldName+'MultipleError'+index).length === 0)
                                    {
                                        MultipleField.after('<div class="invalid-feedback" id="'+fieldName+'MultipleError'+index+'"></div>')
                                    }
                                    MultipleField.addClass('is-invalid')
                                    $('#'+fieldName+'MultipleError'+index).text(message).show()
                                  }
                               })
                        })
                    }
                }
            });
     });

           // Sélectionnez tous les éléments <select>
        var selects = document.querySelectorAll('select');
           // Parcourez chaque élément <select>
          selects.forEach(function(select) {
          // Vérifiez si l'élément <select> n'a pas encore été transformé en Select2
    if (!select.classList.contains('select2')) {
        // Appliquez Select2 à l'élément <select>
        new TomSelect(select, {
            plugins: {
                remove_button: {
                    title: 'Supprimer'
                }
            }
        });
    }
   });
});


  </script>
@endsection
