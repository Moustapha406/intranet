<?php

namespace App\Http\Controllers\TRG;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Atelier;
use App\Models\User;
use Illuminate\Http\Request;

class AtelierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:atelier-read|atelier-create|atelier-edit|atelier-delete|atelier-affecter', ['only' => ['index', 'store']]);
        $this->middleware('permission:atelier-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:atelier-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:atelier-affecter', ['only' => ['affecter']]);
        $this->middleware('permission:atelier-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $ateliers = Atelier::orderBy('libelle', 'desc')->paginate(10);



        return view('TRG.atelier.index', compact('ateliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();

        return view('TRG.atelier.form', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'code' => ['required', 'string'],
            'libelle' => ['required'],
            'usine' => ['required'],
            'cadenceLigne' => ['required'],
            'cadenceJournaliere' => ['required'],
            'nbre_quart_default' => ['required'],
            'nbre_ligne' => ['required'],
            'nbre_heure' => ['required'],
            'TRGObjectif' => '',
            'unite' => ['required', 'string']
        ]);

        $atelier = Atelier::create([
            'code' => $request->code,
            'libelle' => $request->libelle,
            'usine' => $request->usine,
            'cadenceLigne' => $request->cadenceLigne,
            'cadenceJournaliere' => $request->cadenceJournaliere,
            'nbre_quart_default' => $request->nbre_quart_default,
            'nbre_ligne' => $request->nbre_ligne,
            'nbre_heure' => $request->nbre_heure,
            'TRGObjectif' => $request->TRGObjectif,
            'unite' => $request->unite
        ]);

        $atelier->users()->attach($request->input('users', []));

        $atelier->save();

        return redirect(route('atelier.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    public function affecter($atelier)
    {
        $articles = Article::whereNull('atelier_id')
            ->where('is_active', true)
            ->get();

        $atelier = Atelier::find($atelier);



        return view('TRG.atelier.add_article', compact('articles', 'atelier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Atelier $atelier)
    {
        $users = User::all();

        return view('TRG.atelier.form', compact('atelier', 'users'));
    }

    public function affectation(Request $request, $atelier_id)
    {

        //$data = $request->validate();

        $atelier = Atelier::find($atelier_id);

        $articlesList = Article::whereIn('id', $request->input('articles', []))->get();
        $articles_atelier = Article::whereIn('id', $request->input('articles_atelier', []))->get();



        if (!empty($articlesList)) {

            foreach ($articlesList as $article) {
                $article->atelier_id = $atelier->id;
                $article->save();
            }
        }

        if (!empty($articles_atelier)) {
            foreach ($articles_atelier as $article) {
                $article->atelier_id = null;
                $article->save();
            }
        }

        $articles = Article::whereNull('atelier_id')->get();




        return redirect()->route('atelier.affecter', ['atelier' => $atelier, 'articles' => $articles]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Atelier $atelier)
    {


        $data = $request->validate([
            'usine' => ['required'],
            'cadenceLigne' => ['required'],
            'cadenceJournaliere' => ['required'],
            'nbre_quart_default' => ['required'],
            'nbre_ligne' => ['required'],
            'nbre_heure' => ['required'],
            'TRGObjectif' => '',
            'unite' => ['required', 'string']
        ]);

        // dd($request);

        $atelier->update($data);

        // $user = User::find($request->user);

        $atelier->users()->sync($request->input('users', []));

        $atelier->save();

        return redirect(route('atelier.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}