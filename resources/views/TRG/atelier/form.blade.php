@extends('layouts.main_layout')

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-11">
                <form method="post"
                    action="{{ isset($atelier->id) ? route('atelier.update',$atelier->id) : route('atelier.store')}}">
                    @csrf
                    @if (isset($atelier->id))
                        @method('PUT')
                    @endif
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{isset($atelier) ? 'Atalier : '.$atelier->libelle: 'Création d\'un atelier'}}</h4>
                            {{-- @isset($atelier->id)
                                <div class="button text-right ml-4">
                                    <a href="{{route('atelier.affecter',$atelier->id)}}" class="btn btn-icon icon-left btn-success">
                                        <i class="far fa-edit"></i> Affecter un article
                                    </a>
                                </div>
                            @endisset --}}
                        </div>
                        <div class="card-body p-4 ">
                            <div class="row">
                                <div class="form-group col-3">
                                    <label for="code">code</label>
                                    <input id="code" type="text" class="form-control" name="code" value="{{isset($atelier) ? $atelier->code : ''}}" {{ isset($atelier) ? 'disabled' : '' }} autofocus>
                                </div>
                                <div class="form-group col-4">
                                    <label for="libelle">Nom d'atelier</label>
                                    <input id="libelle" type="text" class="form-control" name="libelle" value="{{isset($atelier) ? $atelier->libelle : ''}}" {{ isset($atelier) ? 'disabled' : '' }}>
                                </div>
                                <div class="form-group col-3">
                                    <label for="usine">Usine</label>
                                    <input id="usine" type="text" class="form-control" name="usine" value="{{isset($atelier) ? $atelier->usine : ''}}" >
                                </div>
                                <div class="form-group col-2">
                                    <label for="usine">Unité</label>
                                    <select class="form-control select2" name="unite">
                                        <option></option>
                                        <option value="Cartons" {{isset($atelier) && $atelier->unite=="Cartons" ? 'selected' : ''}}>Cartons</option>
                                        <option value="Kg" {{isset($atelier) && $atelier->unite=="Kg" ? 'selected' : ''}}>Kg</option>
                                        <option value="Tonnes" {{isset($atelier) && $atelier->unite=="Tonnes" ? 'selected' : ''}}>Tonnes</option>
                                    </select>
                                </div>

                            </div>
                            

                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="cadenceLigne">Cadence de ligne</label>
                                    <input id="cadenceLigne" type="number" class="form-control" name="cadenceLigne" value="{{isset($atelier) ? $atelier->cadenceLigne : ''}}" >
                                </div>

                                <div class="form-group col-4">
                                    <label for="cadenceJournaliere">Cadence journaliére</label>
                                    <input id="cadenceJournaliere" type="number" class="form-control" name="cadenceJournaliere" value="{{isset($atelier) ? $atelier->cadenceJournaliere : ''}}" autofocus>
                                </div>
                                
                                <div class="form-group col-4">
                                    <label for="nbre_quart_default">Nombre de quart par default</label>
                                    <input id="nbre_quart_default" type="number" class="form-control" name="nbre_quart_default" value="{{isset($atelier) ? $atelier->nbre_quart_default : ''}}" >
                                </div>

                            </div>


                            <div class="row">

                                <div class="form-group col-3">
                                    <label for="nbre_heure">Nombre d'heures</label>
                                    <input id="nbre_heure" type="number" class="form-control" name="nbre_heure" value="{{isset($atelier) ? $atelier->nbre_heure : ''}}" >
                                </div>

                                <div class="form-group col-3">
                                    <label for="nbre_ligne">Nombre de ligne</label>
                                    <input id="nbre_ligne" type="number" class="form-control" name="nbre_ligne" value="{{isset($atelier) ? $atelier->nbre_ligne : ''}}" >
                                </div>

                                <div class="form-group col-3">
                                    <label for="TRGObjectif">Objectif du TRG</label>
                                    <input id="TRGObjectif" type="number" class="form-control" name="TRGObjectif" value="{{isset($atelier) ? $atelier->TRGObjectif: ''}}" >
                                </div>

                                <div class="form-group col-3">
                                    <label for="user">Responsable</label>
                                    <select class="form-control select2" multiple="" name="users[]">
                                        <option value="">....</option>
                                        @php
                                            $selectedUsers= collect(old('permission',isset($atelier) ? $atelier->users->pluck('id')->toArray() : []))
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
                            <button class="btn btn-primary" type="submit">{{ isset($atelier->id) ? "Modifier" : "Ajouter"}}</button>
                            <a href="{{route('atelier.index')}}" class="btn btn-secondary">Annuler</a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        
    <div>
@endsection

