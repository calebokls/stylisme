@extends('manequins.layout')
@section('title', 'Liste de vos media')
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
                 @foreach($manequins as $manequin)
                      <tr>

                         {{-- <td>
                          <ul class="list-unstyled users-list m-0 avatar-group d-flex align-items-center">
                            <li
                              data-bs-toggle="tooltip"
                              data-popup="tooltip-custom"
                              data-bs-placement="top"
                              class="avatar avatar-xs pull-up"
                              title="Lilian Fuller">
                              <img src="#" alt="Avatar" class="rounded-circle" />
                            </li>
                          </ul>
                        </td> --}}

                        <td>
                          <span class="fw-medium">{{$manequin->name}}</span>
                        </td>
                        <td>
                          <div class="dropdown">
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                            </button>
                            <div class="dropdown-menu">
                              <a class="dropdown-item" href="{{route('manequina.manequin.edit',$manequin)}}"
                                ><i class="bx bx-edit-alt me-1"></i>Modifier</a
                              >
                              <form action="{{route('manequina.manequin.destroy',$manequin)}}" method="post">
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
                </div>
              </div>

@endsection

