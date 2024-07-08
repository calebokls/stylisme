@extends('admin.admin')
@section('title', 'Liste des acteur')
@section('content')
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">Nom</th>
      <th scope="col">Prenoms</th>
      <th scope="col">Valider</th>
      <th class="text-end">Actions</th>
    </tr>
  </thead>
  <tbody>
   @foreach($validaries as $validary)
    <tr>
      <td>{{$validary->nom}}</td>
      <td>{{$validary->prenom}}</td>
      <td>{{$validary->validary?'Valider':'Non valider'}}</td>
      <td>
         <div class="d-flex gap-2 m-100 justify-content-end">
                <!-- Button trigger modal -->
                  <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                          <span class="consulter" data-validationy-id ="{{$validary->id}}">Consulter</span>
                  </button>
                  <form action="{{route('user.valider',['id'=>$validary->id])}}" method="post">
                      @csrf
                       @method('put')
                       <button class="btn btn-primary">Valider</button>
                    </form>
                     <form action="{{route('user.annuler',['id'=>$validary->id])}}" method="get">
                      @csrf
                       <button class="btn btn-danger">Annuler</button>
                    </form>
                    </div>
     </td>
    </tr>
   @endforeach
  </tbody>
</table>
{{$validaries->links()}}

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Information de validation</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
   let btnConsulter = document.querySelectorAll('.consulter');
btnConsulter.forEach(btn => {
    btn.addEventListener('click', function() {
        let validationyId = this.getAttribute('data-validationy-id');
        $.ajax({
            type: 'GET',
            url: '/validation/validationy/' + validationyId,
            success: function(data) {
                $('.modal-body').html(data)
            },
            error: function(xhr, status, error) {
                console.log("Erreur: " + status + " " + error);
            }
        });
    });
});
</script>
@endsection


