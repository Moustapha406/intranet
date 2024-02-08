@extends('layouts.main_layout')

@section('content')
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header d-flex justify-content-between">
                  <h4 >Liste des utilisateurs</h4>
                  <div class="card-header-form">
                    <form>
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="button text-right ml-4">
                    <a href="{{route('users.create')}}">
                        <span class="material-symbols-outlined mt-2">person_add</span>
                    </a>
                  </div>    
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Email</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Genre</th>
                            <th>Rôles</th>
                            <th class="text-center">Action</th>
                        </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->email}}</td>
                            <td class="text-truncate">{{$user->nom}}</td>
                            <td class="align-middle">{{$user->prenom}}</td>
                            <td>{{$user->genre}}</td>
                            <td>
                                @if ($user->is_active==true)
                                    <div class="badge badge-success">Activé</div>
                                @else
                                    <div class="badge badge-danger">Desactivé</div>
                                @endif
                            </td>

                            <td> 
                              @foreach ($user->roles as $role)
                                  <span class="badge badge-info">{{$role->name}}</span>
                              @endforeach
                              
                             </td>
                            
                            <td class="text-center">
                                <a href="{{route('users.edit',$user->id)}}" class="test-info">
                                  <span class="material-symbols-outlined">edit</span>
                                </a>
                                <a href="{{route('users.show', $user->id)}}" data-toggle="modal" data-target="#user_{{$user->id}}" class="text-info">
                                  
                                  <span class="material-symbols-outlined">info</span>
                                </a>

                                <a href="#" class="text-danger" onClick="deleteConfirmation('user',{{$user->id}})">
                                  <span class="material-symbols-outlined">delete</span>
                                </a>
                                <form id="delete-{{$user->id}}" action="{{route('users.destroy',$user->id)}}" method="POST">
                                  @csrf
                                  @method("DELETE")
                                </form>
                            </td>

                            @includeIf('admin.users.show')

                            

                        </tr>
                    @endforeach
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection
@push('script')
        <script src="{{asset('assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>
        <script src="{{asset('assets/bundles/jquery-selectric/jquery.selectric.min.js')}}"></script>
        <script src="{{asset('assets/js/page/forms-advanced-forms.js')}}"></script>
        <script src="{{asset('assets/js/page/advance-table.js')}}"></script>
        <script src="{{asset('assets/bundles/datatables/datatables.min.js')}}"></script>
        <script src="{{asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{asset('assets/js/page/datatables.js')}}"></script>

@endpush