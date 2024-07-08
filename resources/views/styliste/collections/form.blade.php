@extends('styliste.layout')
@section('title', 'Créé une collection')
@section('content')
<h1 style="text-align:center">@yield('title')</h1>
<div class="row">
  <div class="col-md-4"></div>
  <div class="col-md-8">
    <form class="vstack gap-2" action="{{ route($collectiony->exists ? 'style.collectiony.update' : 'style.collectiony.store', ['collectiony' => $collectiony]) }}" method="post" enctype="multipart/form-data" id="js-form">
        @csrf
        @method($collectiony->exists ? 'put' : 'post')
        <div class="card mb-4">
            <input type="hidden" name="nombre_de_clics" id="nombre_de_clics" value="0">
            <div class="card-body demo-vertical-spacing demo-only-element">
               <div class="form-password-toggle">
                    <label for="marque">Marques</label>
                    <select name="marque" class="form-select form-select-md">
                        @foreach($primaries as $key => $primary)
                          <option value="{{$key}}">{{$primary}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle col-md-12">
                    @include('shared.input', ['class' => 'col', 'label' => 'Nom de la collection', 'name' => 'nom', 'value' => $collectiony->name])
                </div>
            </div>
            <div style="background-color:#E8E8FD; border:1px solid black;" class="alert alert-warning alert-dismissible fade show mb-2" role="alert">
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle col-md-12">
                    @include('shared.upload', ['class' => 'col', 'label' => 'Image 1', 'name' => 'images1', 'multiple' => true])
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    @include('shared.input', ['class' => 'col-md-12', 'label' => 'Prix 1', 'name' => 'prices1'])
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    @include('shared.input', ['class' => 'col-12', 'type' => 'textarea', 'label' => 'Description 1', 'name' => 'descriptions1'])
                </div>
            </div>
            <div class="card-body demo-vertical-spacing demo-only-element">
                <div class="form-password-toggle">
                    <label for="tailes1" style="color:blue;">Tailles 1</label>
                    <div id="select" class="mb-2"></div>
                </div>
            </div>
            </div>
            <div id="collections"></div>
            <div class="text-end">
                <p id="ajout" class="btn btn-warning">Ajouter</p>
                <p id="supprimer" class="btn btn-danger">Supprimer</p>
            </div>
            <button class="btn btn-primary mt-2" type="submit">
                @if ($collectiony->exists)
                    Modifier
                @else
                    Valider
                @endif
            </button>
        </div>
    </form>
</div>

</div>

  <script type="text/javascript">
  $(document).ready(function(){
    let $i= 1;
   document.getElementById('nombre_de_clics').value = $i;
    $tailles=[];
       $.ajax({
           url: '/style/taille',
           type: 'GET',
           data: "json",
           success: function(data){
              $tailles  = Object.values(data)
              let selectTaille= document.createElement('select');
                  selectTaille.setAttribute('class','form-select form-select-sm','tailles-input');
                  selectTaille.setAttribute('id','smallSelect')
                  selectTaille.setAttribute('name','tailles'+$i+'[]')
                  selectTaille.setAttribute('multiple','true');

                   for($j=0;$j<$tailles.length;$j++)
                  {
                      let option = document.createElement('option')
                          option.text = $tailles[$j];
                          option.value=$tailles[$j];
                          selectTaille.add(option);
                  }
                  document.querySelector('#select').appendChild(selectTaille)
                   new TomSelect(selectTaille, {
                           plugins: {
                           remove_button: {
                           title: 'Supprimer'
                        }
                      }
                   });
           },
           error:function(xhr,status,error)
           {
              console.log(xhr.responseText)
           }
      });
     $('#ajout').on('click',function(){
         $i++;
          document.getElementById('nombre_de_clics').value = $i;
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
         label1.textContent = "Image "+$i;
         label1.style="Color:blue;";
         label2.setAttribute('for','price'+$i);
         label2.textContent = "Prix "+$i;
         label2.style="Color:blue;";
         label3.setAttribute('for','description');
         label3.textContent = "Desciption "+$i;
         label3.style="Color:blue;";
         label4.setAttribute('for','tailles');
         label4.textContent = "Taille "+$i;
         label4.style="Color:blue;";

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
            selectTaille.setAttribute('class','form-select form-select-sm','tailles-input');
            selectTaille.setAttribute('id','smallSelect')
            selectTaille.setAttribute('name','tailles'+$i+'[]')
            selectTaille.setAttribute('multiple','true')
            for($j=0;$j<$tailles.length;$j++)
            {
                let option = document.createElement('option')
                    option.text = $tailles[$j];
                    option.value=$tailles[$j];
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
         div.appendChild(div1);
         div.appendChild(div3);
         div.appendChild(div5);
         div.appendChild(div7);
         document.querySelector('#collections').appendChild(div)

          new TomSelect(selectTaille, {
                plugins: {
                remove_button: {
                   title: 'Supprimer'
               }
            }
         });
     })

     $('#supprimer').on('click',function(){
        let DernierDiv = $('#collections').children().last();
        DernierDiv.remove();
         $i<=1 ? $i=1:$i--;
     })
     $('#js-form').on('submit',function(e){
        e.preventDefault();
            let formData = new FormData(this)
            $('.invalid-feedback').hide();
                $.ajax({
                type: 'POST',
                url: '/style/collectiony',
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
  });
  </script>
@endsection
