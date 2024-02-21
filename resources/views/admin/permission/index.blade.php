@extends('layouts.main_layout')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card card-primary">
                <div class="card-header d-flex justify-content-between">
                    <h4>Liste des rôles</h4>
                    <div class="button text-right ml-4">
                        
                        <a href="{{route('permissions.create')}}" class="btn btn-icon icon-left btn-primary">
                            <i class="fa fa-plus-square" aria-hidden="true"></i> Ajouter
                        </a>
                    </div> 
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tr>
                                <th>Permission</th>
                                <th>Rôles</th>
                                <th class="text-center">Action</th>
                            </tr>

                            @foreach ($permissions as $key=>$permission)
                                <tr>
                                    <td>{{$permission->name}}</td>
                                    <td>
                                        @foreach ($permission->roles as $role)
                                            <span class="badge badge-info">{{$role->name}}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a href="{{route('permissions.edit',$permission->id)}}" class="text-info">
                                            <span class="material-symbols-outlined">edit</span>
                                        </a>

                                    

                                        <a href="#" class="text-danger" onClick="deletePermission('permissions',{{$permission->id}})">
                                            <span class="material-symbols-outlined">delete</span>
                                        </a>
                                        <form id="delete-{{$permission->id}}" action="{{route('permissions.destroy',$permission->id)}}" method="POST">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                    </td>

                                </tr>
                            @endforeach
                        </table>
                    </div>
                </div>

                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                      {{$permissions->links()}}
                    </nav>
                </div>
                    
            </div>

        </div>
    </div>
@endsection
@push('script')
        <script>
            
        </script>
        <script src="{{asset('assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>
        <script src="{{asset('assets/bundles/jquery-selectric/jquery.selectric.min.js')}}"></script>
        <script src="{{asset('assets/js/page/forms-advanced-forms.js')}}"></script>
        <script src="{{asset('assets/js/page/advance-table.js')}}"></script>
        <script src="{{asset('assets/bundles/datatables/datatables.min.js')}}"></script>
        <script src="{{asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{asset('assets/js/page/datatables.js')}}"></script>

        <script>
            function deletePermission(itemType, itemId) {
                if (confirm(`Êtes-vous sûr de vouloir supprimer ce (t) ${itemType} ?`)) {
                    document.getElementById(`delete-${itemId}`).submit();
                }
            }
        </script>
@endpush