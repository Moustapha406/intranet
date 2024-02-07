@extends('layouts.main_layout')

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-10">
                <form method="post"
                    action="{{ isset($role->id) ? route('roles.update',$role->id) : route('roles.store')}}">
                    @csrf
                    @if (isset($role->id))
                        @method('PUT')
                    @endif
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                        </div>
                        <h4>Créer un rôle</h4>
                        <div class="card-body p-4 ">
                            <div class="row">
                                
                                <div class="form-group col-6">
                                    <label for="name">Rôles</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{isset($role) ? $role->name : ''}}" >
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-10">
                                    <label for="prenom">Permissions</label>
                                    <select class="form-control select2" multiple="" name="permission[]">
                                        <option value="">....</option>
                                        @php
                                            $selectedPermission= collect(old('permission',isset($role) ? $role->permissions->pluck('id')->toArray() : []))
                                        @endphp

                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->name }}" {{ $selectedPermission->contains($permission->id) ? 'selected' : '' }} >
                                                {{$permission->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            

                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">{{ isset($role->id) ? "Modifier" : "Ajouter"}}</button>
                            <a href="{{route('roles.index')}}" class="btn btn-secondary">Annuler</a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        
    <div>
@endsection

