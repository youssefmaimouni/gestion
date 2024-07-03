<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\categories;
use App\Models\entres;
use App\Models\marchandises;
use App\Models\sorties;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class CategorieController extends Controller 
{
    public function index() {
        // Retrieve all categories
        $categories = categories::all();
    
        // Fetch total 'entres' (purchases) grouped by category ID
        $entres = marchandises::select('categories.id', DB::raw('COALESCE(SUM(marchandises.quantite), 0) as total_achetes'))
                                ->join('categories', 'categories.id', '=', 'marchandises.id_cat')
                                ->groupBy('categories.id')
                                ->pluck('total_achetes', 'categories.id');
    
        // Fetch total 'sorties' (sales) grouped by category ID
        $sorties = marchandises::select('categories.id', DB::raw('COALESCE(SUM(sorties.quantite), 0) as total_vendus'))
                                ->leftJoin('sorties', 'sorties.id_mar', '=', 'marchandises.id')
                                ->join('categories', 'categories.id', '=', 'marchandises.id_cat')
                                ->groupBy('categories.id')
                                ->pluck('total_vendus', 'categories.id');
    
        // Combine 'entres' and 'sorties' with categories
        foreach ($categories as $category) {
            $category->total_achetes = $entres[$category->id] ?? 0;
            $category->total_vendus = $sorties[$category->id] ?? 0;
        }
    
        // Return the view with the categories data
        return view('categories.index', compact('categories'));
    }

    public function index_cat(){
        $categories = categories::all();
        return view('categories.index_cat', compact('categories'));
    }

    public function index_mar(categories $categories){
        $marchandise = marchandises::where('id_cat','=',$categories->id)->get();
       
        return view('categories.index_mar', ['marchandises'=>$marchandise]);
    }

    public function index_mar_acheter( entres $entre)
    {
        $mar_e = marchandises::select('marchandises.*', DB::raw('"entre" as type'))
            ->join('acheters', 'acheters.id_mar', '=', 'marchandises.id')
            ->where('acheters.id_entre', $entre->id)
            ->get();
    
        return view('categories.index_mar', ['marchandises' => $mar_e]);
    }
    

    public function index_mar_vendre(sorties $sorties){
    
        
  

        $mar_s =  marchandises::select('marchandises.*', DB::raw('"sortie" as type'))
        ->join('vendres','vendres.id_mar','=','marchandises.id')
        ->where('vendres.id_sortie', $sorties->id)
        ->get();

        
        return view('categories.index_mar',['marchandises'=>$mar_s]);
        
    }

    public function create() {
        return view('categories.create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nom' => 'required|min:3|string',
        ]);
       
        $categorie = new Categories();
        $categorie->nom = $validatedData['nom'];
        $categorie->save();

        return redirect()->route('categories.index_cat')->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function edit(categories $categories)
{
    return view('categories.edit', ['categorie' => $categories]);
}

    public function update(Request $request, Categories $categorie) {
        $validatedData = $request->validate([
            'nom' => 'required|min:3|string',
        ]);
        $categorie->nom = $validatedData['nom'];
        $categorie->save();

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function entre_sortie(categories $categories) {
        // Récupérer les entres en ajoutant une colonne 'type' avec la valeur 'entre'
        $entres = entres::select('entres.*', DB::raw('"entre" as type'))
            ->where('entres.id_cat', $categories->id)
            ->orderBy('entres.date_doc', 'desc')                  
            ->get();
    
        // Récupérer les sorties en ajoutant une colonne 'type' avec la valeur 'sortie'
        $sorties = sorties::select('sorties.*', DB::raw('"sortie" as type'))
            ->where('sorties.id_cat', $categories->id)
            ->orderBy('sorties.date_doc', 'desc')                  
            ->get();
    
        // Fusionner les collections d'entres et de sorties
        $tous = $entres->concat($sorties);
    
        // Trier toutes les données ensemble par date de document en ordre décroissant
        $tous = $tous->sort(function ($a, $b) {
            $comp = strcmp($b->date_doc, $a->date_doc); // Tri décroissant par 'date_doc'
            if ($comp === 0) {
                return strcmp($b->created_at, $a->created_at); // Si égaux, tri décroissant par 'created_at'
            }
            return $comp;
        });
        
        // Retourner la vue avec toutes les données nécessaires
        return view('categories.entre_sortie', [
            'categories' => $categories,
            'tous' => $tous,
            'entres' => $entres, 
            'sorties' => $sorties
        ]);
    }
    
    public function entre(categories $categories ){

        $entres = entres::select('entres.*', DB::raw('"entre" as type'))
        ->where('entres.id_cat', $categories->id)
        ->orderBy('entres.date_doc', 'desc')                  
        ->get();
  

        $sorties = sorties::select('sorties.*', DB::raw('"sortie" as type'))
        ->where('sorties.id_cat', $categories->id)
        ->orderBy('sorties.date_doc', 'desc')                  
        ->get();

        $tous = $entres->merge($sorties);
        $tous = $tous->sortByDesc('date_doc');

        return view('categories.entre', ['categories'=>$categories,'tous' => $tous,'entres'=>$entres , 'sorties'=>$sorties]);

        
    }
    public function sortie(categories $categories ){

        $entres = entres::select('entres.*', DB::raw('"entre" as type'))
        ->where('entres.id_cat', $categories->id)
        ->orderBy('entres.date_doc', 'desc')                  
        ->get();

        $sorties = sorties::select('sorties.*', DB::raw('"sortie" as type'))
        ->where('sorties.id_cat', $categories->id)
        ->orderBy('sorties.date_doc', 'desc')                  
        ->get();

        $tous = $entres->merge($sorties);
        $tous = $tous->sortByDesc('date_doc');

        return view('categories.sortie', ['categories'=>$categories,'tous' => $tous,'entres'=>$entres , 'sorties'=>$sorties]);
    }
    

    public function delete(Request $request) {
            $categorie=categories::find($request->id);
            $categorie->delete();
            return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
        
    }
}
