@extends('Bases')
@section('title','Validation d\'identité')
@section('content')
   <form method="POST" action="{{route($validationy->exists ? 'validation.validationy.update':'validation.validationy.store',['validationy'=>$validationy])}}" enctype="multipart/form-data" id="js-form-data">
       @csrf
       @method($validationy->exists ? 'PUT':'POST')
         <div class="row">
          <div class="col-md-6 mx-auto">
                  <h1>@yield('title')</h1>
               <div class="card mb-4">
                  <div class="row">
                     <div class="col-md-6">
                        <div class="card-body demo-vertical-spacing demo-only-element">
                           <div class="form-password-toggle">
                             @include('shared.input', ['class' => 'col','label' => 'Vote Prénoms', 'name' => 'prenom','value'=>$validationy->prenom])
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <div class="card-body demo-vertical-spacing demo-only-element">
                           <div class="form-password-toggle">
                             @include('shared.input', ['class' => 'col','label' => 'Votre nom', 'name' => 'nom','value'=>$validationy->nom])
                           </div>
                        </div>
                     </div>
                  </div>
                   <div class="row">
                     <div class="col-md-6">
                        <div class="card-body demo-vertical-spacing demo-only-element">
                           <div class="form-password-toggle">
                             @include('shared.upload', ['class' => 'col','label' => 'Photo(Format d\'identité)', 'name' => 'photo'])
                           </div>
                        </div>
                     </div>
                     <div class="col-md-6">
                            <div class="card-body demo-vertical-spacing demo-only-element">
                                <div class="form-password-toggle">
                                    @include('shared.upload', ['class' => 'col','label' => 'Photo  de votre pièce d\'identité', 'name' => 'piece'])
                                </div>
                           </div>
                     </div>
                  </div>
                      <input type="hidden" name="image_data" id="imageData">
                   <div style="margin-left:30px;" class="justify-content-center items-align-center">
                        <div id="captureButton">Prendre une photo <span style="font-size:50px;"><i class="bi bi-wallet2"></i></span> </div>
                        <video id="videoElement" width="600" height="600" autoplay></video>
                        <canvas id="canvasElement" width="600" height="600" style="display:none;"></canvas>
                        <img id="capturedImage" name="imageData" style="display:none;" />
                  </div>
                   <button class="btn btn-primary mt-2" type="submit">
                      Envoyer
                   </button>
              </div>
          </div>
       </div>
   </form>

   <script type="text/javascript">
      document.addEventListener('DOMContentLoaded', function () {
    const captureButton = document.getElementById('captureButton');
    const videoElement = document.getElementById('videoElement');
    const canvasElement = document.getElementById('canvasElement');
    const capturedImage = document.getElementById('capturedImage');
    const imageDataInput = document.getElementById('imageData');
    let cameraAccessGranted = false;
    let stream = null;

    captureButton.addEventListener('click', function () {
        if (!cameraAccessGranted) {
            // Demander l'accès à la caméra
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(s => {
                    stream = s;
                    videoElement.srcObject = stream;
                    cameraAccessGranted = true;
                    captureButton.textContent = 'Capturer la photo';
                })
                .catch(error => {
                    console.error('Erreur d\'accès à la caméra :', error);
                });
        } else {
            // Capturer l'image
            const context = canvasElement.getContext('2d');
            context.drawImage(videoElement, 0, 0, canvasElement.width, canvasElement.height);

            // Convertir le canevas en base64
            const imageData = canvasElement.toDataURL('image/png');
            capturedImage.src = imageData;
            capturedImage.style.display = 'block';

            // Stocker l'image en base64 dans un champ de formulaire caché
            imageDataInput.value = imageData;

            // Arrêter le flux de la caméra après la capture
            if (stream) {
                stream.getTracks().forEach(track => track.stop());
            }
        }
    });
});

   </script>
@endsection
