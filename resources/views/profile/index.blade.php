@extends('layouts.main_layout')

@push('head')
<style>

input::-webkit-outer-spin-button,
input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

input[type=number] {
  -moz-appearance: textfield;
}

</style>
@endpush

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-11">
                <div class="card card-primary">
                  <div class="card-header d-flex justify-content-between">
                    <h4>Profile de l'utilisateur</h4>
                    <a href="#" data-toggle="modal" data-target="#user_{{$user->id}}" class="text-info">
                                  <span class="badge badge-primary">Nouveau mot de passe</span>
                    </a>
                  </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item font-weight-bold">Nom</li>
                                    <li class="list-group-item font-weight-bold">Prénom</li>
                                    <li class="list-group-item font-weight-bold">Genre</li>
                                    <li class="list-group-item font-weight-bold">Site</li>
                                    <li class="list-group-item font-weight-bold">Departement</li>
                                    <li class="list-group-item font-weight-bold">Fonction</li>
                                    <li class="list-group-item font-weight-bold">Email</li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{$user->nom}}</li>
                                    <li class="list-group-item">{{$user->prenom}}</li>
                                    <li class="list-group-item">{{$user->genre}}</li>
                                    <li class="list-group-item"> {{$user->site}} </li>
                                    <li class="list-group-item"> {{$user->departement}} </li>
                                    <li class="list-group-item"> {{$user->fonction}} </li>
                                    <li class="list-group-item"> {{$user->email}} </li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        
                    </div>

                    @includeIf('profile.update_password')

                    <div class="card-footer text-right">
                        <a href="{{url()->previous()}}" class="btn btn-secondary">Retour</a>
                    </div>
                </div>
            </div>
        </div>
        
    <div>
@endsection

