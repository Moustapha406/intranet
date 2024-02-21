<div class="modal fade bd-example-modal-lg" id="atelier_{{$atelier->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Détail</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item font-weight-bold">Atelier</li>
                            <li class="list-group-item font-weight-bold">Usine</li>
                            <li class="list-group-item font-weight-bold">Cadence en ligne</li>
                            <li class="list-group-item font-weight-bold">Cadence journaliére</li>
                            <li class="list-group-item font-weight-bold">Quart par defaut</li>
                            <li class="list-group-item font-weight-bold">Nbre de ligne</li>
                            <li class="list-group-item font-weight-bold">Nbre d'heure</li>
                            <li class="list-group-item font-weight-bold">Objectif du TRG</li>
                            <li class="list-group-item font-weight-bold">Responsables</li>
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$atelier->libelle}}</li>
                            <li class="list-group-item">{{$atelier->usine}}</li>
                            <li class="list-group-item">{{$atelier->cadenceLigne}}</li>
                            <li class="list-group-item"> {{$atelier->cadenceJournaliere}} </li>
                            <li class="list-group-item"> {{$atelier->nbre_quart_default}} </li>
                            <li class="list-group-item">{{ $atelier->nbre_ligne }}</li>
                            <li class="list-group-item">{{ $atelier->nbre_heure }}</li>
                            <li class="list-group-item">{{ $atelier->TRGObjectif }}</li>
                            <li class="list-group-item">
                                @foreach ($atelier->users as $res )
                                    <span class="badge badge-primary">{{$res->prenom.' '.$res->nom}}</span>
                                @endforeach
                            </li>
                        </ul>
                    </div>

                    <hr>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>