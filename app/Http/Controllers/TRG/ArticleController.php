<?php

namespace App\Http\Controllers\TRG;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Atelier;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {
        $this->middleware('permission:article-read|article-create|article-edit|article-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:article-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:article-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:article-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $articles = Article::orderBy('article', 'desc')->paginate(30);

        return view('TRG.articles.index', compact('articles')); //->with('i',($request->input('page',1) -1 ) *10)
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $ateliers = Atelier::all();


        return view('TRG.articles.form', compact('ateliers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'article' => ['required', 'string', 'unique:articles,article'],
            'designation' => ['required', 'string'],
            'category' => ['required'],
            'marque' => ['required'],
            'saveur' => ['required'],
            'is_active' => ''
        ]);

        $atelier = Atelier::find($request->atelier);



        $article = Article::create([
            'article' => $request->article,
            'designation' => $request->designation,
            'category' => $request->category,
            'marque' => $request->marque,
            'saveur' => $request->saveur,
            'is_active' => $request->is_active
        ]);


        $article->atelier()->associate($atelier);

        $article->save();

        return redirect(route('article.index'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        $ateliers = Atelier::all();

        return view('TRG.articles.form', compact('article', 'ateliers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Article $article)
    {


        $data = $request->validate([
            // 'article' => ['required', 'string', 'unique:articles,article'],
            'designation' => ['required', 'string'],
            'category' => ['required'],
            'marque' => ['required'],
            'saveur' => ['required'],
            'is_active' => ''
        ]);


        $article->update($data);

        $atelier = Atelier::find($request->atelier);

        $article->atelier()->associate($atelier);

        $article->save();

        return redirect(route('article.index'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $article = Article::findorFail($id);
    }
}