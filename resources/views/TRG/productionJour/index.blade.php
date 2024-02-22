@extends('layouts.main_layout')

@push('head')
<style>

:root{
    --size:5px;
}

.select_1{
    appearance:none;
    background-color: transparent;
    border:solid 1px rgba(149, 113, 131, 0.04);
    padding: 0 10px 0px 10px;
    margin:0;
    min-width:250px;
    max-width:350px;
    font-family:inherit;
    font-size:inherit;
    cursor: inherit;
    line-height: inherit;
    outline:solid 1px rgba(69, 80, 235, 0.06);
    border-radius: 25px;
    
    position: relative;
}

.custum_select{
    min-width: 250px;
    position: relative;
}

.custum_select::after {
  --size: 5px;
  content: "";
  position: absolute;
  right: 0.5rem;
  pointer-events: none;
}

.custum_select::after {
  border-left: var(--size) solid transparent;
  border-right: var(--size) solid transparent;
  border-top: var(--size) solid black;
  top: 40%;
}

input[type=number]::-webkit-inner-spin-button, 
input[type=number]::-webkit-outer-spin-button { 
    -webkit-appearance: none;
    appearance: none; 
}

/* Firefox */
input[type=number] {
    -moz-appearance: textfield;
}

.input_table{
    width:100px;
    padding:0;
}
.input_table input{
    -webkit-appearance:none;
    -moz-appearance:textfield;
    display:block;
    height:50%;
    width:100%;
    border:solid 1px rgba(149, 113, 131, 0.04);
    outline:solid 1px rgba(69, 80, 235, 0.06);
    style:none;
}


</style>
@endpush

@section('content')
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header " >
                    <h4>TRG</h4>
                    
                    <div class="card-header-form">
                        <form method="GET" action="{{route('production.index')}}">
                            @csrf
                            <div class="input-group">
                                <h4 class="control-label mr-2 mt-1">Atelier:</h4>
                                <div class="custum_select">
                                    <select class="select_1" name="atelier">
                                    @php
                                        $id_atelier=isset($atelierSelected) ? $atelierSelected->id : null;
                                    @endphp
                                    @foreach ($ateliers as $atelier)
                                        <option value="{{$atelier->id}}" {{ ($atelier->id == $id_atelier)? 'selected' : ''}}>{{$atelier->libelle}}</option>
                                    @endforeach
                                        
                                        
                                    </select>
                                </div>
                                
                                <input type="month"  class="form-control "  id="dateFormated" name="date" placeholder="Search"> 

                                <div class="input-group-btn">
                            
                                    <button class="btn btn-primary">Rechercher  <i class="fas fa-search"></i></button>
                                </div>

                            </div>
                        </form>
                        
                    </div>

                    <div class="pl-5">
                        <form method="POST" action="{{route('productions.export')}}">
                            @csrf
                            <input type="hidden" name="date" value="{{ isset($dateFormated) ? $dateFormated : '' }}">
                            <input type="hidden" name="atelierSelect" value="{{ isset($atelierSelected->id ) ? $atelierSelected->id : ''}}">
                            @isset($atelierSelected->id )
                                <button type="submit" class="badge badge-primary">Exporter</button>
                            @endisset
                            
                        </form>

                        
                    </div>

                </div>
                
                <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Date</th>
                            <th>Atelier</th>
                            <th>Quantité</th>
                            <th>Nb Quarts</th>
                            <th>TRG en %</th>
                            <th>Observation</th>
                            <th class="text-center">Action</th>
                        </tr>
                    @foreach ($jourDuMois as  $production)

                        <tr>
                            @php
                                $date=\Carbon\Carbon::createFromFormat('d/m/Y',$production['dateFormated']);
                                $dateString=$date->format('d-m-Y');
                            @endphp
                            <td> {{ $production['dateFormated'] }} </td>
                            <td> {{ $production['atelier'] }} </td>
                            <td> {{ $production['quantite'] > 0 ? number_format($production['quantite'],3,',',' ') : $production['quantite'] }} </td>
                            <td> {{ $production['nbreQuarts'] }}</td>
                            <td> {{ $production['TRG'] }} %</td>
                            <td> {{ $production['observation'] !='' ? substr($production['observation'],0,20).' ...' : '' }}</td>
                            <td class="text-center">
                                @can('prod-edit')
                                    <a href="{{route('productions.edit',['atelier'=>$id_atelier,'date'=>$dateString,'usine'=>$production['usine'] ])}}" class="test-info">
                                        <span class="material-symbols-outlined">add</span>
                                    </a>
                                @endcan
                                <a href="{{route('production.show',['atelier'=>$id_atelier,'date'=>$dateString,'usine'=>$production['usine'] ])}}" class="test-info">
                                    <span class="material-symbols-outlined">edit</span>
                                </a>
                                
                                
                            </td>
                        </tr>

                        {{-- <tr>
                            @php
                                $date=\Carbon\Carbon::createFromFormat('d/m/Y',$jour['dateFormated']);
                                $dateString=$date->format('d-m-Y');
                            @endphp
                            <td>{{$jour['dateFormated']}}</td>
                            
                            <td>{{$jour['atelier']}}</td>
                            <td>{{$jour['quantite']}}</td>
                            
                            <td> {{$jour['TRG']}} </td>
                            <td> {{$jour['cadenceJournaliere']}} </td>
                            <td> {{$jour['NbreQuartDefault']}} </td>
                            <td class="text-center">
                                <a href="{{route('productions.edit',['atelier'=>$id_atelier,'date'=>$dateString ])}}" class="test-info">
                                  <span class="material-symbols-outlined">add</span>
                                </a>
                            </td>
                            
                        </tr> --}}
                    @endforeach
                    
                    <tr style="background-color:Lavender;">

                        <th scope="col" >MOYENNE DES TRG </th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th> {{number_format($moyenne,2,',',' ')}} %</th>
                        <th></th>
                        <th></th>
                    </tr>
                    </table>
                </div>
                </div>
                
              </div>
            </div>
          </div>

@endsection
@push('script')
        <script src="{{asset('assets/bundles/select2/dist/js/select2.full.min.js')}}"></script>
        <script src="{{asset('assets/bundles/jquery-selectric/jquery.selectric.min.js')}}"></script>
        <script src="{{asset('assets/js/page/forms-advanced-forms.js')}}"></script>
        <script src="{{asset('assets/js/page/advance-table.js')}}"></script>
        <script src="{{asset('assets/bundles/datatables/datatables.min.js')}}"></script>
        <script src="{{asset('assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js')}}"></script>
        <script src="{{asset('assets/bundles/jquery-ui/jquery-ui.min.js')}}"></script>
        <script src="{{asset('assets/js/page/datatables.js')}}"></script>

        <script>

           
            
          const dateInput=document.getElementById('dateFormated');
          const dateValue="{{isset($dateFormated) ? $dateFormated->format('Y-m') : ''}}";

          dateInput.value=dateValue; 
/*
          $(document).ready(function(){
            $('#dateFormated').datepicker({
                dateFormat: 'yy-mm',
                changeMonth: true,
                changeYear: true,
                showButtonPanel:true,
                onClose: function(dateText,inst){
                    var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                    var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                    $(this).datepicker('setDate', new Date(year, month, 1));
                }
            })
          })
 */
        
        </script>

@endpush