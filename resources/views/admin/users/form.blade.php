@extends('layouts.main_layout')

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-11">
                <form method="post"
                    action="{{ isset($user->id) ? route('users.update',$user->id) : route('users.store')}}">
                    @csrf
                    @if (isset($user->id))
                        @method('PUT')
                    @endif
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                        <h4>Liste des utilisateurs</h4>
                        </div>
                        <div class="card-body p-4 ">
                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="nom">Nom</label>
                                    <input id="nom" type="text" class="form-control" name="nom" value="{{isset($user) ? $user->nom : ''}}" autofocus>
                                </div>
                                <div class="form-group col-6">
                                    <label for="prenom">Prénom</label>
                                    <input id="prenom" type="text" class="form-control" name="prenom" value="{{isset($user) ? $user->prenom : ''}}" >
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-6">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <fieldset class="form-group">
                                                <div class="row">
                                                    <div class="col-form-label col-sm-4 pt-3 text-center" >Genre</div>
                                                    <div class="col-sm-6">
                                                        <div class="form-check">
                                                            <div class="custom-control custom-radio">
                                                                <input type="radio"  id="homme" name="genre" value="Homme" class="custom-control-input" {{isset($user) && $user->genre =="Homme" ? 'checked' : ''}} />
                                                                <label class="custom-control-label" for="homme">Homme</label>
                                                            </div>

                                                            <div class="custom-control custom-radio">
                                                                <input type="radio" id="femme" name="genre" value="Femme" class="custom-control-input" {{isset($user) && $user->genre =="Femme" ? 'checked' : ''}}  />
                                                                <label for="femme" class="custom-control-label">Femme</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </div>

                                        <div class="col-sm-5">
                                            <div class="form-group">
                                                <label for="is_active">Activer</label>
                                                <input type="hidden" name="is_active" value="0" />
                                                 <input type="checkbox" name="is_active"  id="is_active" {{ isset($user) && $user->is_active ? 'checked' : ''}} value="1" />
                                                
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                                 {{-- <div>
                                    {{ $user->roles->pluck('id')->toArray() }}
                                 </div> --}}

                                <div class="form-group col-6">
                                    <label for="prenom">Rôles</label>
                                    <select class="form-control select2" multiple="" name="roles[]">
                                        <option value="">....</option>
                                        @php
                                            $selectedRoles= collect(old('roles',isset($user) ? $user->roles->pluck('id')->toArray() : []))
                                        @endphp

                                        @foreach ($roles as $role)
                                            <option value="{{ $role->name }}" {{ $selectedRoles->contains($role->id) ? 'selected' : '' }} >
                                                {{$role->name}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>

                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="site">Site</label>
                                    <input id="site" type="text" class="form-control" name="site" value="{{isset($user) ? $user->site : ''}}" >
                                </div>
                                <div class="form-group col-4">
                                    <label for="departement">Département</label>
                                    <input id="departement" type="text" class="form-control" name="departement" value="{{isset($user) ? $user->departement : ''}}" autofocus>
                                </div>
                                <div class="form-group col-4">
                                    <label for="fonction">Fonction</label>
                                    <input id="fonction" type="text" class="form-control" name="fonction" value="{{isset($user) ? $user->fonction : ''}}" autofocus>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="email">Email</label>
                                    <input id="email" type="mail" class="form-control" value="{{ isset($user) ? $user->email : ''}}" name="email" autofocus>
                                </div>
                                <div class="form-group col-6">
                                    <label for="password">Mot de passe</label>
                                    <input id="password" type="password"  class="form-control" name="password"  >
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">{{ isset($user->id) ? "Modifier" : "Ajouter"}}</button>
                            <a href="{{route('users.index')}}" class="btn btn-secondary">Annuler</a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        
    <div>
@endsection

