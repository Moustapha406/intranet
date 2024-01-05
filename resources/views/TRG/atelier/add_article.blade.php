@extends('layouts.main_layout')

@section('content')
    <div class="section-body">
        <div class="row justify-content-center">
            <div class="col-11">
                <form method="POST"
                    action="{{route('atelier.affectation',['atelier' => $atelier])}}">

                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <h4>Atalier : {{isset($atalier)? $atelier->libelle: ''}}</h4>
                            
                        </div>
                        <div class="card-body p-4 ">
                            <div class="row" style="height: 300px;">
                                
                                <div class="form-group col-5" >
                                    <select class="form-control select " multiple='' id="select_articles" name="articles[]" data-height="100%">
                                        @foreach ($articles as $article)
                                            <option value="{{$article->id}}">{{ $article->designation }}</option>
                                        @endforeach

                                    </select>
                                    
                                </div>

                                <div class="col-2 text-center align-self-center p-0 " >
                                    <button type="submit"  class="badge badge-secondary w-100" >Mise en jour</button>
                                    <br><br>
                                    <button class="badge badge-light w-100" type="reset"  onclick="deselectionnerArticle()">Desélectionner</button>
                                </div>

                                <div class="form-group col-5" >
                                    <select class="form-control select " name="articles_atelier[]" multiple=''  data-height="100%">
                                        @foreach ($atelier->articles as $article)
                                            <option value="{{$article->id}}">{{ $article->designation }}</option>
                                        @endforeach
                                    </select>
                                </div>

                            </div>
                            
                        </div>

                        <div class="card-footer text-right">
                            {{-- <button class="btn btn-primary" type="submit">{{ isset($atelier->id) ? "Modifier" : "Ajouter"}}</button> --}}
                            <a href="{{route('atelier.index')}}" class="badge badge-secondary w-30">Retour</a>
                        </div>
                        
                    </div>
                </form>
            </div>
        </div>
        
    <div>
@endsection

@push('script')
    
@endpush


