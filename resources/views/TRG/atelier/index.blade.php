@extends('layouts.main_layout')

@section('content')
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header d-flex justify-content-between">
                  <h4>Liste des ateliers</h4>
                  <div class="card-header-form">
                    <form>
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search">
                        <div class="input-group-btn">
                          <button class="btn btn-primary"><i class="fas fa-search"></i></button>
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="button text-right ml-4">

                    @can('atelier-create')
                      <a href="{{route('atelier.create')}}" class="btn btn-icon icon-left btn-primary">
                      {{-- <i class="far fa-file-alt"></i> Ajouter --}}
                        <i class="fa fa-plus-square" aria-hidden="true"></i> Ajouter

                      </a>
                    @endcan
                    
                  </div>
                      
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Nom ateliers</th>
                            <th>Usine</th>
                            <th>Cadence en ligne</th>
                            <th>Cadence journaliére</th>
                            <th>Quart par defaut</th>
                            <th>Nbre de ligne</th>
                            <th>Nbre d'heure</th>
                            <th>Objectif du TRG</th>
                            <th class="text-center">Action</th>
                        </tr>
                    @foreach ($ateliers as $atelier)
                        <tr>
                            <td>{{$atelier->libelle}}</td>
                            <td class="text-truncate">{{$atelier->usine}}</td>
                            <td class="align-middle">{{$atelier->cadenceLigne}}</td>
                            <td class="align-middle">{{$atelier->cadenceJournaliere}}</td>
                            <td class="align-middle">{{$atelier->nbre_quart_default}}</td>
                            <td class="align-middle">{{$atelier->nbre_ligne}}</td>
                            <td class="align-middle">{{$atelier->nbre_heure}}</td>
                            <td class="align-middle">{{$atelier->TRGObjectif}}</td>
                            
                            <td class="text-center">
                                @can('atelier-edit')
                                  <a href="{{route('atelier.edit',$atelier->id)}}" class="test-info">
                                    <span class="material-symbols-outlined">edit</span>
                                  </a>
                                @endcan
                                
                                @can('atelier-affecter')
                                  <a href="{{route('atelier.affecter',$atelier->id)}}"  class="edit_square"> 
                                    <span class="material-symbols-outlined">edit_square</span>
                                  </a>
                                @endcan

                                @can('atelier-delete')
                                  <a href="#" class="text-danger" onClick="deleteConfirmation('atelier',{{$atelier->id}})">
                                    <span class="material-symbols-outlined">delete</span>
                                  </a>
                                @endcan
                                <form id="delete-{{$atelier->id}}" action="{{route('atelier.destroy',$atelier->id)}}" method="POST">
                                  @csrf
                                  @method("DELETE")
                                </form>
                            </td>

                            {{-- @includeIf('admin.users.show') --}}

                            

                        </tr>
                    @endforeach
                    </table>
                  </div>
                </div>
                <div class="card-footer text-right">
                    <nav class="d-inline-block">
                      {{$ateliers->links()}}
                    </nav>
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

@endpush