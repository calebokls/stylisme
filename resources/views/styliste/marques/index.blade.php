@extends('styliste.layout')
@section('title', 'Liste de vos marques')
@section('content')
<h1>@yield('title')</h1>

<div class="card">
                <h5 class="card-header">Table Basic</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>logo</th>
                        <th>Nom</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody id="body-principal" class="table-border-bottom-0">
                 @foreach($marques as $marque)
                      <tr>
                         <td>
                          <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            <li
                              data-bs-toggle="tooltip"
                              data-popup="tooltip-custom"
                              data-bs-placement="top"
                              class="avatar avatar-xs pull-up"
                              title="Lilian Fuller">
                              <img src="{{$marque->getImageForMarquesUrl()}}" alt="Avatar" class="rounded-circle" />
                            </li>
                          </ul>
                        </td>

                        <td>
                          <span class="fw-medium">{{$marque->name}}</span>
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{route('style.marque.edit',$marque)}}"
                                ><i class="bx bx-edit-alt me-1"></i>Modifier</a
                              >
                              <form action="{{route('style.marque.destroy',$marque)}}" method="post">
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
                  {{$marques->links()}}
                </div>
              </div>

<script>
  $(document).ready(function(){
    $('.form-control').on('keyup', function() {
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
            url: '/style/search-style-marque',
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
    });
});
</script>
@endsection
