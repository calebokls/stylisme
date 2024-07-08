@forelse($modelies as $modely)
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
@empty
 Aucun model ne correspond a votre recherche
@endforelse

