@extends('styliste.layout')
@section('title', 'Liste de vos collections')
@section('content')
<h1>@yield('title')</h1>

<div class="card">
                <h5 class="card-header"></h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nom</th>
                        <th>Marque</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <div>
                       <tbody id="body-principal"  class="table-border-bottom-0">
                        @foreach($collections as $collection)
                      <tr>
                         <td>
                          <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            <li>
                              {{$collection->name}}
                            </li>
                          </ul>
                        </td>

                        <td>
                          <span class="fw-medium">{{$collection->marques->name}}</span>
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{route('style.collectiony.edit',$collection)}}"
                                ><i class="bx bx-edit-alt me-1"></i>Modifier</a
                              >
                              <form action="#" method="post">
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
                    </div>
                     <tbody id="body-search" class="table-border-bottom-0"></tbody>
                  </table>
                  {{$collections->links()}}
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
            url: '/style/search-style-collection',
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

