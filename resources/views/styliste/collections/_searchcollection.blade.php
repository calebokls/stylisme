                        @forelse($collections as $collection)
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
                        @empty
                         Aucune collection ne correspond a votre recherche
             @endforelse
