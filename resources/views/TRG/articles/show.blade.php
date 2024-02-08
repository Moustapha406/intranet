<div class="modal fade" id="article_{{$article->id}}" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
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
                            <li class="list-group-item font-weight-bold">Article</li>
                            <li class="list-group-item font-weight-bold">Designation</li>
                            <li class="list-group-item font-weight-bold">Categorie</li>
                            <li class="list-group-item font-weight-bold">Marque</li>
                            <li class="list-group-item font-weight-bold">Saveur</li>
                            <li class="list-group-item font-weight-bold">Statut</li>
                            <li class="list-group-item font-weight-bold">Atelier</li>
                            
                        </ul>
                    </div>

                    <div class="col-md-6">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">{{$article->article}}</li>
                            <li class="list-group-item">{{$article->designation}}</li>
                            <li class="list-group-item">{{$article->categorie}}</li>
                            <li class="list-group-item"> {{$article->marque}} </li>
                            <li class="list-group-item"> {{$article->saveur}} </li>
                            <li class="list-group-item">
                                @if ($article->is_active==true)
                                    <span class="badge badge-success">Activé</span>
                                @else
                                    <span class="badge badge-danger">Désactivé</span>
                                @endif
                            </li>
                            
                            <li class="list-group-item"> {{isset($article->atelier->libelle) ? $article->atelier->libelle : ''}} </li>
                            
                        </ul>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-whitesmoke br">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>