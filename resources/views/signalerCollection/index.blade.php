@extends('admin.admin')
@section('title', 'Liste des acteur')
@section('content')
<table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Signaleur</th>
      <th scope="col">Signaler</th>
      <th class="text-end">Actions</th>
    </tr>
  </thead>
  <tbody>
  @foreach($signalisations as $signaly)
    <tr>
        <td>{{ $signaly->id }}</td>
        <td><span>{{ $signaly->signaling_user_name }}</span> <span>{{$signaly->signaling_user_prenom}}</span></td>
        <td><span>{{$signaly->modely_user_name}}</span> <span>{{$signaly->modely_user_prenom}}</span></td>
        <td>
            <div class="d-flex gap-2 m-100 justify-content-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    <span class="consulter" data-validationy-id="{{ $signaly->id }}">Motif</span>
                </button>
                <form action="{{route('user.avertir')}}" method="POST">
                  <input type="hidden" name="user_id" value="{{ $signaly->modely_user_id }}">
                   @csrf
                    <button  class="btn btn-warning">
                        <span >Avertir</span>
                    </button>
                </form>
                <form action="#" method="get">
                    @csrf
                    <button class="btn btn-danger">Supprimer</button>
                </form>
            </div>
        </td>
    </tr>
@endforeach

  </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
   let btnConsulter = document.querySelectorAll('.consulter');
   btnConsulter.forEach(btn=>{
    btn.addEventListener('click',function(){
        let signalerId = this.getAttribute('data-validationy-id');
         $.ajax({
            type:'GET',
            url:'/motif/signaler/'+signalerId,
            dataType:"json",
            success: function(response){
               let signaler = response.motifs;
               document.querySelector('.modal-body').innerText = response.motifs[0].motif
            },
            error:function(xhr,status,error){
                console.log("error")
            }
         })
    });
   });
</script>
@endsection
