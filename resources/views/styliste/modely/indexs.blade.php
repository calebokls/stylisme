@extends('styliste.layout')
@section('title', 'Liste de vos modèles')
@section('content')
<h1>@yield('title')</h1>
 @if(Auth::check() && is_null(Auth::user()->address) && is_null(Auth::user()->country))
    <div class="btn btn-danger mb-3">
       <a class="text-white" href="{{ route('profile.edit') }}"> Veuillez compléter votre profil </a>
    </div>
@endif

<div class="card">
                <h5 class="card-header">Table des modèles</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nom</th>
                        <th>Marque</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody  id="body-principal" class="table-border-bottom-0">
                 @foreach($modelies as $modely)
                      <tr>
                        <td>
                          <span class="fw-medium">{{$modely->name}}</span>
                        </td>
                        <td>
                          <span class="fw-medium">{{$modely->marques->name}}</span>
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{route('style.modely.edit',$modely)}}"
                                ><i class="bx bx-edit-alt me-1"></i>Modifier</a
                              >
                              <form action="{{route('style.modely.destroy',$modely)}}" method="post">
                                 @csrf
                                 @method('delete')
                                 <button class="dropdown-item"><i class="bx bx-trash me-1"></i>Supprimer</button>
                              </form>
                            </div>
                          </div>
                        </td>
                      </tr>
              @endforeach
                    </tbody>
                     <tbody id="body-search" class="table-border-bottom-0"></tbody>
                  </table>
                {{$modelies->links()}}
           </div>
 </div>
<script>
  $(document).ready(function(){
    $('.form-control').on('keyup',function(){
        let val = $(this).val();
        if (val == "") {
            $('#body-principal').show();
            $('#body-search').hide();
        } else {
            $('#body-principal').hide();
            $('#body-search').show();
        }
         $.ajax({
            type: 'GET',
            url: '/style/search-style-modely',
            data: {
                search: val,
            },
            success: function(response) {
                $('#body-search').html(response); // Utiliser html() pour remplacer le contenu
            },
            error: function() {
                alert('Erreur lors de la recherche');
            }
        });
    })
  })
</script>
@endsection

