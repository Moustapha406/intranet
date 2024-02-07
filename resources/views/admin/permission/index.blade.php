@extends('layouts.main_layout')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-1">
            <div class="card">
                <div class="card-header d-flex justify-content-between">
                    <h4>Liste des rôles</h4>
                    <div class="button text-right ml-4">
                        <a href="{{route('permissions.create')}}"  >
                            <span class="material-symbols-outlined mt-2">person_add</span>
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

                                        <a herf="#" onClick="deletePermission('permissions',{{$permission->id}})" class="text-danger">
                                            <span class="material-symbols-outlined">delete</span>
                                        </a>
                                        <form id="permission_{{$permission->id}}" method="POST" action="{{route('permissions.destroy',$permission->id)}}">
                                            @csrf
                                            @method("DELETE")
                                        </form>
                                    </td>

                                    

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