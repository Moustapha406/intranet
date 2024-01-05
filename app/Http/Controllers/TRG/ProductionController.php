<?php

namespace App\Http\Controllers\TRG;


use PDO;
use Carbon\Carbon;
use App\Models\ProductionX3;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ProductionJour;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Atelier;
use Illuminate\Support\Facades\Date;
use Illuminate\Database\QueryException;

class ProductionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $productions = ProductionJour::all();

        $productionX3s = ProductionX3::all();


        $ateliers = Atelier::with('articles.productionX3s')->get();
        $qtyProd = 0;

        foreach ($ateliers as $atelier) {
            // echo ("l'ateliertalier : " . $atelier->libelle . " ");

            foreach ($atelier->articles as $article) {
                $qtyProd += $article->productionX3s->sum("qty");

                foreach ($article->productionX3s as $production) {

                    // return "article : " . $article->designation . " a pour quantité : " . $qtyProd . " au date du :" . $production->DateProd . " </br>";
                }
            }
        }




        $jourDuMois = [];
        $dateFormated = null;
        $atelierSelected = null;
        $TRG = null;
        $productionJours = null;
        $productionForUsine = null;
        $cumulTRG = 0;
        $jourProd = 0;
        $moyenne = 0;


        if ($request->date) {


            $date_selected = $request->input('date');


            $dateSelect = Carbon::createFromFormat('Y-m', $date_selected);

            $dateFormated = Carbon::createFromFormat('Y-m', $date_selected);

            $mois = $dateSelect->format('m');
            $annee = $dateSelect->format('Y');

            $qtyProductionTotal = ProductionJour::whereYear('dateProd', $annee)
                ->whereMonth('dateProd', $mois)
                ->sum('qtyProd');

            $atelierSelected = Atelier::find($request->atelier);

            $atelierArticle = $atelierSelected->articles->pluck('article');
            $nbreQuart = null;


            $dateProd = ProductionX3::select('DateProd')
                ->whereYear('DateProd', $annee)
                ->whereMonth('DateProd', $mois)
                ->orderBy('DateProd')
                ->get();

            $jourDuMois = [];
            //$nbreDeJours = cal_days_in_month(CAL_GREGORIAN, $mois, $annee);


            //count($dateProd)


            $nombreDeJours = $dateSelect->daysInMonth;


            for ($jour = 1; $jour <= $nombreDeJours; $jour++) {


                // $date = $dateProd[$jour];

                //$date = Carbon::createFromFormat('j-m-Y', "$jour-$mois-$annee");
                $dateSearch = Carbon::create($annee, $mois, $jour)->format('Y-m-d');

                //$dateSeach = Carbon::createFromFormat('Y-m-d H:i:s', $date->DateProd)->format('Y-m-d');


                $qty = ProductionX3::whereIn('article', $atelierArticle)
                    ->wheredate('DateProd', $dateSearch)
                    ->sum('qty');

                $productionJours = ProductionX3::whereIn('article', $atelierArticle)
                    ->wheredate('DateProd', $dateSearch)
                    ->get();


                $productionForUsine = ProductionX3::select('usine', DB::raw('MAX(DateProd) as DateProd'), DB::raw('SUM(qty) as totalQty'))
                    ->whereIn('article', $atelierArticle)
                    ->whereDate('DateProd', $dateSearch)
                    ->groupBy('usine')
                    ->get();




                $ligne = ProductionJour::wheredate('dateProd', $dateSearch)
                    ->where('atelier_id', $atelierSelected->id)
                    ->first();




                if ($ligne == null) {
                    $TRG = 0;
                } else {
                    // $jourProd += 1;
                    $TRG = $ligne->TRGjour;
                }
                $productionForDate = [];

                if ($productionForUsine->isEmpty()) {
                    //dd(!$productionJours->isEmpty());
                    $jourDuMois[] = [
                        'dateFormated' =>  date('d/m/Y', strtotime($dateSearch)),
                        'quantite' => 0,
                        'atelier' => $atelierSelected->libelle,
                        'TRG' => $TRG,
                        'usine' => $atelierSelected->usine,
                        'cadenceJournaliere' => $atelierSelected->cadenceJournaliere,
                        'NbreQuartDefault' => $atelierSelected->nbre_quart_default,
                    ];
                } else {

                    foreach ($productionForUsine as $production) {
                        $l = ProductionJour::wheredate('dateProd', $production->DateProd)
                            ->where('atelier_id', $atelierSelected->id)
                            ->where('usine', $production->usine)
                            ->first();

                        if ($l == null) {
                            $TRG = 0;
                        } else {
                            $jourProd += 1;

                            $TRG = $l->TRGjour;
                            $cumulTRG += $TRG;
                        }

                        $jourDuMois[] = [
                            'dateFormated' =>  date('d/m/Y', strtotime($production->DateProd)),
                            'quantite' => $production->totalQty,
                            'atelier' => $atelierSelected->libelle,
                            'TRG' => $TRG,
                            'usine' => $production->usine,
                            'cadenceJournaliere' => $atelierSelected->cadenceJournaliere,
                            'NbreQuartDefault' => $atelierSelected->nbre_quart_default,
                        ];
                    }
                }

                // foreach ($productionJours as $production) {
                //     $productionForDate[] = [
                //         'dateFormated' =>  date('d/m/Y', strtotime($production->DateProd)),
                //         'quantite' => $production->qty,
                //         'atelier' => $atelierSelected->libelle,
                //         'TRG' => $TRG,
                //         'cadenceJournaliere' => $atelierSelected->cadenceJournaliere,
                //         'NbreQuartDefault' => $atelierSelected->nbre_quart_default,
                //     ];
                // }

                // $jourDuMois[] = [

                //     $productionForUsine
                // ];



                // $jourDuMois[] = [
                //     'dateFormated' => "", // date('d/m/Y', strtotime($date->DateProd)),
                //     'quantite' => $qty,
                //     'atelier' => $atelierSelected->libelle,
                //     'TRG' => $TRG,
                //     'cadenceJournaliere' => $atelierSelected->cadenceJournaliere,
                //     'NbreQuartDefault' => $atelierSelected->nbre_quart_default,
                // ];


            }

            //dd($jourDuMois);
            if ($jourProd > 0) {
                $moyenne = $cumulTRG / $jourProd;
            }
        }




        return view('TRG.productionJour.index', compact('productions', 'jourDuMois', 'dateFormated', 'ateliers', 'atelierSelected', 'jourProd', 'cumulTRG', 'moyenne'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        (float)$request->qtyProd;

        $request->merge(['qtyProd' => (float)$request->qtyProd]);



        $request->validate([
            'qtyProd' => ['required', 'min:1', 'numeric'],
            'nbreQuarts' => 'required'
        ]);



        $atelierSelected = Atelier::find($request->atelier_id);




        $dateProd = Carbon::createFromFormat('d/m/Y', $request->dateProd)->format('Y-m-d');



        $TRG = (($request->qtyProd * $atelierSelected->nbre_quart_default) / ($atelierSelected->cadenceJournaliere * $request->nbreQuarts)) * 100;



        $productionJour = ProductionJour::create([
            'qtyProd' => $request->qtyProd,
            'nbreQuarts' => $request->nbreQuarts,
            'TRGjour' => $TRG,
            'usine' => $request->usine,
            'observation' => $request->observation,
            'dateProd' => $dateProd
        ]);

        $productionJour->atelier()->associate($atelierSelected);

        $productionJour->save();

        return redirect()->route('production.index');
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
    public function edit($id, $date, $usine)
    {

        $dates = Carbon::createFromFormat('d-m-Y', $date);

        $dateSeach = $dates->format('Y-m-j');

        $dates = $dates->format('d/m/Y');

        $atelier = Atelier::find($id);

        $atelierArticle = $atelier->articles->pluck('article');



        $qty = ProductionX3::select('usine')
            ->whereIn('article', $atelierArticle)
            ->wheredate('DateProd', $dateSeach)
            ->where('usine', $usine)
            ->groupBy('usine')
            ->sum('qty');



        $productionJour = ProductionJour::wheredate('dateProd', $dateSeach)
            ->where('atelier_id', $atelier->id)
            ->where('usine', $usine)
            ->first();


        // dd($productionJour->nbreQuarts);

        return view('TRG.productionJour.form', compact('atelier', 'dates', 'qty', 'productionJour', 'usine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ProductionJour $production)
    {
        // dd($request);
        $data = $request->validate([
            'qtyProd' => ['required'],
            'nbreQuarts' => ['required', 'max:3', 'min:0', 'not_in:0'],
            //'dateProd' => ['required'],
            'usine'  => ['required'],
            'nbre_quart_default' => ['required'],
            'TRGObjectif' => ['required'],
            'observation' => ""
        ]);



        $atelier = Atelier::find($request->atelier_id);



        $trg = (($request->qtyProd * $atelier->nbre_quart_default) / ($atelier->cadenceJournaliere * $request->nbreQuarts)) * 100;

        $data['TRGjour'] = $trg;



        $production->update($data);
        $atelier = Atelier::find($request->atelier_id);

        $production->atelier()->associate($atelier);

        $production->save();

        return redirect()->route('production.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
