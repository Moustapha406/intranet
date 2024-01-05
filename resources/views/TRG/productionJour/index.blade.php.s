@extends('layouts.main_layout')

@section('content')
        <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header " style="border:solid;color:red;">
                  <div class="row" >
                    <div class="col-sm-10" style="border:solid;color:blue;">Liste de atelier</div>
                  
                  </div>
                  

                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Date</th>
                            <th>Atelier</th>
                            <th>Qty</th>
                            <th>Genre</th>
                            <th>Rôles</th>
                            <th class="text-center">Action</th>
                        </tr>
                    @foreach ($jourDuMois as  $jour)
                        <tr>
                            <td>{{$jour['dateFormated']}}</td>
                            
                            <td>{{$jour['quantite']}}</td>
                            
                            <td>
                                <div class="form-group">
                                    <input type="number" name="nbreQuart" class="form-control"  />
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" name="nbreQuart" class="form-control-plaintext"  />
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <input type="number" name="nbreQuart" class="form-control-plaintext"  />
                                </div>
                            </td>

                            {{-- @includeIf('admin.production.show') --}}
                        </tr>
                    @endforeach
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
        
        </script>

@endpush