@extends('admin.admin')
@section('title', 'Liste des sous catégories')
@section('content')
<h1>@yield('title')</h1>


  <div class="card">
                <h5 class="card-header">Table des sous catégories</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nom</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                 @foreach($primaries as $primary)
                      <tr>
                        <td>
                          <span class="fw-medium">{{$primary->nom}}</span>
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{route('admin.primary.edit',$primary)}}"
                                ><i class="bx bx-edit-alt me-1"></i>Modifier</a
                              >
                              <form action="{{route('admin.primary.destroy',$primary)}}" method="post">
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
                  </table>
                  {{$primaries->links()}}
                </div>
              </div>

@endsection
