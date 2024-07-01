<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\categories;
use App\Models\entres;
use App\Models\sorties;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategorieController extends Controller 
{
    public function index(){
        $categories = categories::all();
        return view('categories.index', compact('categories'));
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

        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès.');
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

    public function entre_sortie(categories $categories ){

        $entres = entres::select('entres.*', DB::raw('"entre" as type'))
        ->where('entres.id_cat', $categories->id)
        ->orderBy('entres.date_doc', 'desc')                  
        ->get();

        $sorties = sorties::select('sorties.*', DB::raw('"sortie" as type'))
        ->join('vendres', 'vendres.id_sortie', '=', 'sorties.id')
        ->join('marchandises', 'vendres.id_mar', '=', 'marchandises.id')
        ->join('categories', 'marchandises.id_cat', '=', 'categories.id')
        ->where('categories.id', $categories)
        ->orderBy('sorties.date_doc', 'desc')                  

        ->get();

        $tous = $entres->merge($sorties);
        $tous = $tous->sortByDesc('date_doc');

        return view('categories.entre_sortie', ['categories'=>$categories,'tous' => $tous,'entres'=>$entres , 'sorties'=>$sorties]);
        

    }
    public function entre(categories $categories ){

        $entres = entres::select('entres.*', DB::raw('"entre" as type'))
        ->where('entres.id_cat', $categories->id)
        ->orderBy('entres.date_doc', 'desc')                  
        ->get();
  

        $sorties = sorties::select('sorties.*', DB::raw('"sortie" as type'))
        ->join('vendres', 'vendres.id_sortie', '=', 'sorties.id')
        ->join('marchandises', 'vendres.id_mar', '=', 'marchandises.id')
        ->join('categories', 'marchandises.id_cat', '=', 'categories.id')
        ->where('categories.id', $categories)
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
        ->join('vendres', 'vendres.id_sortie', '=', 'sorties.id')
        ->join('marchandises', 'vendres.id_mar', '=', 'marchandises.id')
        ->join('categories', 'marchandises.id_cat', '=', 'categories.id')
        ->where('categories.id', $categories)
        ->orderBy('sorties.date_doc', 'desc')                  

        ->get();

        $tous = $entres->merge($sorties);
        $tous = $tous->sortByDesc('date_doc');

        return view('categories.sortie', ['categories'=>$categories,'tous' => $tous,'entres'=>$entres , 'sorties'=>$sorties]);
    }
    

    public function delete(Categories $categorie) {
        try {
            $categorie->delete();
            return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Erreur lors de la suppression de la catégorie.');
        }
    }
}
