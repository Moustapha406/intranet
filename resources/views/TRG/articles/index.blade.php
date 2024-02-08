@extends('layouts.main_layout')

@section('content')
        <div class="row">
            <div class="col-12">
              <div class="card card-primary">
                <div class="card-header d-flex justify-content-between">
                  <h4>Liste des utilisateurs</h4>
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
                    <a href="{{route('article.create')}}">
                        <span class="material-symbols-outlined mt-2">person_add</span>
                    </a>
                  </div>    
                </div>
                <div class="card-body p-0">
                  <div class="table-responsive">
                    <table class="table table-striped">
                        <tr>
                            <th>Article</th>
                            <th>Désignation</th>
                            <th>Catégorie</th>
                            <th>Marque</th>
                            <th>Saveur</th>
                            <th>Atelier</th>
                            <th class="text-center">Action</th>
                        </tr>
                    @foreach ($articles as $article)
                        <tr>
                            <td>{{$article->article}}</td>
                            <td class="text-truncate">{{$article->designation}}</td>
                            <td class="align-middle">{{$article->category}}</td>
                            <td>{{$article->marque}}</td>
                            <td>{{$article->saveur}}</td>
                            <td>{{isset($article->atelier->libelle) ? $article->atelier->libelle : ''}}</td>
                            {{-- <td>
                                @if ($article->is_active==true)
                                    <div class="badge badge-success">Activé</div>
                                @else
                                    <div class="badge badge-danger">Desactivé</div>
                                @endif
                            </td> --}}
                            
                            <td class="text-center">
                                @can('atelier-edit')
                                  <a href="{{route('article.edit',$article->id)}}" class="test-info">
                                    <span class="material-symbols-outlined">edit</span>
                                  </a>
                                @endcan
                                <a href="{{route('article.show', $article->id)}}" data-toggle="modal" data-target="#article_{{$article->id}}" class="text-info">
                                  <span class="material-symbols-outlined">info</span>
                                </a>

                                @can('article-delete')
                                  <a href="#" class="text-danger" onClick="deleteConfirmation('article',{{$article->id}})">
                                    <span class="material-symbols-outlined">delete</span>
                                  </a>
                                @endcan

                                <form id="delete-{{$article->id}}" action="{{route('article.destroy',$article->id)}}" method="POST">
                                  @csrf
                                  @method("DELETE")
                                </form>
                            </td>

                            @includeIf('trg.articles.show')

                            

                        </tr>
                    @endforeach
                    
                    </table>
                    
                  </div>
                  
                </div>
                  <div class="card-footer text-right">
                    <nav class="d-inline-block">
                      {{$articles->links()}}
                    </nav>
                  </div>
                  
              </div>
            </div>
          </div>
<button class="btn btn-action">bonjou</button>
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