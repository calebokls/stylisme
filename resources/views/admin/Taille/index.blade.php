@extends('admin.admin')
@section('title', 'Liste des sous catégories')
@section('content')
<h1>@yield('title')</h1>


  <div class="card">
                <h5 class="card-header">Table Basic</h5>
                <div class="table-responsive text-nowrap">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Nom</th>
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                 @foreach($tailles as $taille)
                      <tr>
                        <td>
                          <span class="fw-medium">{{$taille->name}}</span>
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{route('admin.taille.edit',$taille)}}"
                                ><i class="bx bx-edit-alt me-1"></i>Modifier</a
                              >
                              <form action="{{route('admin.taille.destroy',$taille)}}" method="post">
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
                  {{$tailles->links()}}
                </div>
              </div>

@endsection
