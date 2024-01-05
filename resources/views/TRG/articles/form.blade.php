@extends('layouts.main_layout')

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-11">
                <form method="post"
                    action="{{ isset($article->id) ? route('article.update',$article->id) : route('article.store')}}">
                    @csrf
                    @if (isset($article->id))
                        @method('PUT')
                    @endif
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                        <h4>Liste des utilisateurs</h4>
                        </div>
                        <div class="card-body p-4 ">
                            <div class="row">
                                <div class="form-group col-4">
                                    <label for="article">Article</label>
                                    <input id="article" type="text" class="form-control" name="article" value="{{isset($article) ? $article->article : ''}}" autofocus {{ isset($article) ? 'disabled' : '' }}>
                                </div>
                                <div class="form-group col-4">
                                    <label for="designation">Désignation</label>
                                    <input id="designation" type="text" class="form-control" name="designation" value="{{isset($article) ? $article->designation : ''}}"  >
                                </div>
                                <div class="col-sm-2 offset-2">
                                    <div class="form-group">
                                        <label for="is_active">Activer</label>
                                        <input type="hidden" name="is_active" value="0" />
                                            <input type="checkbox" name="is_active"  id="is_active" {{ isset($article) && $article->is_active ? 'checked' : ''}} value="1" />
                                        
                                    </div>
                                </div>
                            </div>
                            

                            <div class="row">
                                <div class="form-group col-6">
                                    <label for="category">Categorie</label>
                                    <input id="category" type="text" class="form-control" name="category" value="{{isset($article) ? $article->category : ''}}" >
                                </div>
                                <div class="form-group col-6">
                                    <label for="marque">Marque</label>
                                    <input id="marque" type="text" class="form-control" name="marque" value="{{isset($article) ? $article->marque : ''}}" autofocus>
                                </div>
                                
                            </div>


                            <div class="row">

                                <div class="form-group col-6">
                                    <label for="saveur">Saveur</label>
                                    <input id="saveur" type="text" class="form-control" name="saveur" value="{{isset($article) ? $article->saveur : ''}}" autofocus>
                                </div>

                                <div class="form-group col-6">
                                    <label for="prenom">Ateliers</label>
                                    <select class="form-control select2"  name="atelier">
                                        <option value="">....</option>
                                        {{-- @php
                                            $selectedAtelier= collect(old('atelier',isset($article) ? $article->atelier()->libelle : ''))
                                        @endphp --}}

                                        @foreach ($ateliers as $atelier)
                                            <option value="{{ $atelier->id }}" {{ isset($article->atelier->id) ? 'selected' : '' }} >
                                                {{$atelier->libelle}}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-right">
                            <button class="btn btn-primary" type="submit">{{ isset($article->id) ? "Modifier" : "Ajouter"}}</button>
                            <a href="{{route('article.index')}}" class="btn btn-secondary">Annuler</a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        
    <div>
@endsection

