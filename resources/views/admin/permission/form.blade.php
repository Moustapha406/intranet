@extends('layouts.main_layout')

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-11">
                <form method="post"
                    action="{{ isset($permission->id) ? route('permissions.update',$permission->id) : route('permissions.store')}}">
                    @csrf
                    @if (isset($permission->id))
                        @method('PUT')
                    @endif
                    <div class="card card-primary">
                        <div class="card-header d-flex justify-content-between">
                        <h4>Création des permission</h4>
                        </div>
                        <div class="card-body p-4 ">
                            <div class="row">
                                
                                <div class="form-group col-8 offset-2">
                                    <label for="name">Permission</label>
                                    <input id="name" type="text" class="form-control" name="name" value="{{isset($permission) ? $permission->name : ''}}" >
                                        @error('name')
                                            <div class="text-danger" >
                                                {{ $message }}
                                            </div>
                                        @enderror
                                </div>
                                {{-- <div class="form-group col-7">
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
                                </div> --}}
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

