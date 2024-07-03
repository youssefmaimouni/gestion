<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\entres;
use App\Models\marchandises;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Milon\Barcode\DNS1D;

class marchandiseController extends Controller
{
    public static function generateBarcode($number)
    {
        $d = new DNS1D();
        return $d->getBarcodePNG($number, 'C39');
    }
    public function index_cat() {
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
        return view('marchandises.index_cat', compact('categories'));
    }
    public function index(categories $categories){
        $marchandise = marchandises::where('id_cat','=',$categories->id)->get();
        return view('marchandises.index', ['marchandises'=>$marchandise]);
    }

   
    public function create() {
        return view('marchandises.create',['categorie'=>categories::all()]);
    }
   public function store(Request $request) {
    // Valider les données d'entrée
    $valid = $request->validate([
        'nom' => 'required|min:3|string',
        'barre_code' => 'integer|nullable',
        'description' => 'string|nullable',
        'quantite' => 'integer|nullable',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3000',
        'categorie' => 'nullable',
        'new_categorie' => 'nullable|string|min:3' 
    ]);

    
    if (!empty($valid['new_categorie'])) {
        $categorie = new Categories();
        $categorie->nom = $valid['new_categorie'];
        $categorie->save();
        $valid['categorie'] = $categorie->id; 
    }else{
        $categorie=$valid['categorie'] ;
    }

   
    $marchandise = new marchandises();
    $marchandise->nom = $valid['nom'];
    $marchandise->barre_code = $valid['barre_code'];
    $marchandise->description = $valid['description'];
    $marchandise->quantite = $valid['quantite'];

    if ($request->file('image') != null) {
        $marchandise->image = $request->file('image')->store('logos', 'public');
    }

    $marchandise->id_cat = $valid['categorie'] ?? null;
    $marchandise->save();
    return redirect()->route('marchandises.index',$categorie)->with('success', 'Marchandise ajoutée avec succès.');
}
    public function edit(marchandises $marchandises) {
        return View('marchandises.edit',['marchandise'=>$marchandises,'categorie'=>categories::all()]);
    }

    public function update(Request $request,marchandises $marchandise )
    {
        $valid = $request->validate([
            'nom' => 'required|min:3|string',
            'barre_code' => 'integer|nullable',
            'description' => 'string|nullable',
            'quantite' => 'integer|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            'categorie' => 'nullable',
            'new_categorie' => 'nullable|string|min:3' 
        ]);
    
        
        if (!empty($valid['new_categorie'])) {
            $categorie = new Categories();
            $categorie->nom = $valid['new_categorie'];
            $categorie->save();
            $valid['categorie'] = $categorie->id; 
        }else{
            $categorie=$valid['categorie'] ;
        }
        $marchandise->nom = $valid['nom'];
        $marchandise->barre_code = $valid['barre_code'];
        $marchandise->description = $valid['description'];
        $marchandise->quantite = $valid['quantite'];
    
        if ($request->file('image') != null) {
            $marchandise->image = $request->file('image')->store('logos', 'public');
        }
    
        $marchandise->id_cat = $valid['categorie'] ?? null;
        $marchandise->save();
        return redirect()->route('marchandises.index',$categorie)->with('success', 'marchandise modifier  avec success');
    }

    public function delete(Request $request) {
                $marchandise = marchandises::find($request->id);
               $marchandise->delete();
        return redirect()->back()->with('success','marchandise supprimer  avec success');
   }
}
