@extends('layouts.main_layout')

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-10">
                <form method="post"
                    action="{{ isset($role->id) ? route('permissions.update',$role->id) : route('permissions.store')}}">
                    @csrf
                    @if (isset($role->id))
                        @method('PUT')
                    @endif
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                        </div>
                        <h4>Créer une permission</h4>
                        <div class="card-body p-4 ">
                            <div class="row">
                                
                                <div class="form-group col-5">
                                    <label for="name">Permission</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{isset($permission) ? $permission->name : ''}}" >
                                </div>
                                <div class="form-group col-7">
                                    <label for="prenom">Roles</label>
                                    <select class="form-control select2" multiple="" name="roles[]">
                                        <option value="">....</option>
                                        @php
                                            $selectedRoles= collect(old('permissions',isset($permission) ? $role->permissions->pluck('id')->toArray() : []))
                                        @endphp

                                        @foreach ($roles as $role)
                                            <option value="{{ $role->id }}" {{ $selectedRoles->contains($role->id) ? 'selected' : '' }} >
                                                {{$role->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">{{ isset($permission->id) ? "Modifier" : "Ajouter"}}</button>
                            <a href="{{route('permissions.index')}}" class="btn btn-secondary">Annuler</a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        
    <div>
@endsection

