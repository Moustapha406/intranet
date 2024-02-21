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
                <form method="post"
                    action="{{ isset($productionJour) ? route('production.update',$productionJour->id) : route('production.store')}}">
                    @csrf
                    @if (isset($productionJour))
                        @method('PUT')
                    @endif
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>{{isset($atelier) ? 'Atalier : '.$atelier->libelle: 'Création d\'un atelier'}}</h4>
                            <h4>{{isset($atelier) ? 'Date : '.$dates: 'Création d\'un atelier'}}</h4>
                            <input type="hidden" name="dateProd" value="{{$dates}}" redondly />
                        </div>
                        <div class="card-body p-4 ">
                            <div class="row">
                                <div class="col-sm-10">
                                    <input type="hidden" name="atelier_id" value="{{$atelier->id}}" />
                                    <input type="hidden"  name='usine' value="{{$usine }}"  />
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="atelier">Nom de l'atelier</label>
                                    <input id="atelier" type="text" class="form-control" name="atelier" value="{{isset($atelier) ? $atelier->libelle: ''}}" {{ isset($atelier) ? 'readonly' : '' }} autofocus>
                                </div>
                                <div class="form-group col-4">
                                    <label for="qtyProd">Quantité de la production</label>
                                    <input id="qtyProd" type="number" class="form-control" name="qtyProd" value="{{ isset($production->totalQty) ? $production->totalQty : 0 }}" readonly>
                                    
                                        @error('qtyProd')
                                            <div class="text-danger" >
                                                {{ $message }}
                                            </div>
                                        @enderror
                                        
                                        
                                </div>
                                <div class="form-group col-4">
                                    <label for="nbre_quart_default">Nombre de quart par default</label>
                                    <input id="nbre_quart_default" type="number" class="form-control" name="nbre_quart_default" value="{{isset($atelier) ? $atelier->nbre_quart_default : ''}}" {{ isset($atelier) ? 'readonly' : '' }}>
                                    
                                </div>

                            </div>
                            

                            <div class="row">

                                <div class="form-group col-3">
                                    <label for="TRGObjectif">Objectif du TRG</label>
                                    <input id="TRGObjectif" type="number" class="form-control" name="TRGObjectif" value="{{isset($atelier) ? $atelier->TRGObjectif: ''}}" readonly >
                                </div>

                                <div class="form-group col-2">
                                    <label for="nbreQuarts">Nombre de Quart</label>
                                    <input id="nbreQuarts" type="number" class="form-control nbreQuart" name="nbreQuarts" value="{{isset($productionJour) ? $productionJour->nbreQuarts: old('nbreQuarts')}}" min="0" max="3">
                                    @error('nbreQuarts')
                                        <div class="text-danger">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-7">
                                    <label for="observation">Observation</label>
                                    <textarea class="form-control" id="observation" name="observation"  rows="4">{{ isset($productionJour->observation)? $productionJour->observation : ''}}</textarea>
                                </div>
                                
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">Enregistrer</button>
                            <a href="{{url()->previous()}}" class="btn btn-secondary">Annuler</a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        
    <div>
@endsection

