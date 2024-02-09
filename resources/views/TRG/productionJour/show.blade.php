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
                <div class="card">
                  <div class="card-header">
                    <h4>Détail de l'atelier {{$atelier->lieblle}}</h4>
                  </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered  border-black" id="table-1">
                                
                                <tbody>
                                    <tr>
                                        <th scope="row" class="col-2 bg-light" >Date </th>
                                        <td >{{$dates}}</td>
                                        <th scope="row" class="col-2 bg-light" >Atelier</th>
                                        <td>{{ $atelier->usine }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="col-2 bg-light">Cadence Journaliere </th>
                                        <td>{{$atelier->cadenceJournaliere}}</td>
                                        <th scope="row" class="col-2 bg-light">Cadence ligne</th>
                                        <td>{{ $atelier->cadenceLigne }}</td>
                                    </tr>
                                    <tr>
                                        <th scope="row" class="col-2 bg-light">Nombre de ligne </th>
                                        <td>{{$atelier->nbre_ligne}}</td>
                                        <th scope="row" class="col-2 bg-light">Nombre d'heure</th>
                                        <td>{{ $atelier->nbre_heure }}</td>
                                    </tr>
                                    <tr>
                                        <td>Nombre de quart par default </td>
                                        <td>{{$atelier->nbre_quart_default}}</td>
                                        <td >Nombre de quart </td>
                                        <td>{{ $productionJour->nbreQuarts ? $productionJour->nbreQuarts : '' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Objectif du TRG</td>
                                        <td>{{$atelier->TRGObjectif}}</td>
                                        <td >TRG du jour</td>
                                        <td>{{ $productionJour->TRGjour ? $productionJour->TRGjour :''}} %</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
    <div>
@endsection

