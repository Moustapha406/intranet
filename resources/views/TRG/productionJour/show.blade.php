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
                  <div class="card-header">
                    <h4>Détail de l'atelier : {{$atelier->lieblle}}</h4>
                  </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item font-weight-bold">Date</li>
                                    <li class="list-group-item font-weight-bold">Atelier</li>
                                    <li class="list-group-item font-weight-bold">Cadence Journaliere</li>
                                    <li class="list-group-item font-weight-bold">Cadence ligne</li>
                                    <li class="list-group-item font-weight-bold">Nombre de ligne </li>
                                    <li class="list-group-item font-weight-bold">Nombre d'heure</li>
                                    <li class="list-group-item font-weight-bold">Nombre de quart par default</li>
                                    <li class="list-group-item font-weight-bold">Nombre de quart</li>
                                    <li class="list-group-item font-weight-bold">TRG jour</li>
                                    <li class="list-group-item font-weight-bold">Objectif du TRG</li>
                                    <li class="list-group-item font-weight-bold">Observation: </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">{{$dates}}</li>
                                    <li class="list-group-item">{{$atelier->usine}}</li>
                                    <li class="list-group-item">{{$atelier->cadenceJournaliere}}</li>
                                    <li class="list-group-item"> {{$atelier->cadenceLigne}} </li>
                                    <li class="list-group-item"> {{$atelier->nbre_ligne}} </li>
                                    <li class="list-group-item"> {{$atelier->nbre_heure}} </li>
                                    <li class="list-group-item"> {{$atelier->nbre_quart_default}} </li>
                                    <li class="list-group-item"> {{isset($productionJour->nbreQuarts) ? $productionJour->nbreQuarts : 0 }} </li>
                                    
                                    <li class="list-group-item"> {{isset($productionJour->TRGjour) ? $productionJour->TRGjour : '0 %'}} </li>
                                    <li class="list-group-item"> {{$atelier->TRGObjectif}} </li>
                                    <li> {{isset($productionJour->observation) ? $productionJour->observation : ''}}</li>
                                </ul>
                            </div>
                        </div>
                        <hr>
                        
                    </div>

                    <div class="card-footer text-right">
                        <a href="{{url()->previous()}}" class="btn btn-secondary">Retour</a>
                    </div>
                </div>
            </div>
        </div>
        
    <div>
@endsection

