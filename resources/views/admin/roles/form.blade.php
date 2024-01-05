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
                        <h4>Liste des Rôles</h4>
                        <div class="card-body p-4 ">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="code">code</label>
                                    <input id="code" type="text" class="form-control" name="code" value="{{isset($role) ? $role->code : ''}}" autofocus>
                                </div>
                                <div class="form-group col-6">
                                    <label for="libelle">Rôles</label>
                                    <input id="libelle" type="text" class="form-control" name="libelle" value="{{isset($role) ? $role->libelle : ''}}" >
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-10">
                                    <label for="prenom">Utilisateurs</label>
                                    <select class="form-control select2" multiple="" name="users[]">
                                        <option value="">....</option>
                                        @php
                                            $selectedUsers= collect(old('users',isset($role) ? $role->users->pluck('id')->toArray() : []))
                                        @endphp

                                        @foreach ($users as $user)
                                            <option value="{{ $user->id }}" {{ $selectedUsers->contains($user->id) ? 'selected' : '' }} >
                                                {{$user->email}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            

                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">{{ isset($user->id) ? "Modifier" : "Ajouter"}}</button>
                            <a href="{{route('roles.index')}}" class="btn btn-secondary">Annuler</a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        
    <div>
@endsection

