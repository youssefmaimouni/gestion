<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\entres;
use App\Models\marchandises;
use App\Models\rapport;
use App\Models\sorties;
use DateTime;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class marchandiseController extends Controller
{
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
        $marchandise = marchandises::where('id_cat','=',$categories->id)->paginate(10)->withQueryString();
        return view('marchandises.index', ['marchandises'=>$marchandise,'categories'=>$categories]);
    }

   
    public function create() {
        return view('marchandises.create',['categorie'=>categories::all()]);
    }
    public function create_cat(categories $categories) {
        return view('marchandises.create',['categorie'=>categories::all(),'category'=>$categories]);
    }
   public function store(Request $request) {
    // Valider les données d'entrée
    
    $valid = $request->validate([
            'nom' => 'required|min:3|string',
            
            'description' => 'string|nullable',
            'quantite' => 'integer|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            'categorie' => 'required',
            
        ]);
        
        
        if (strstr($valid['categorie'],'add')) {
            $valid2 = $request->validate([
                'new_categorie' => 'required|string|min:3' 
            ]);
            $categorie = new Categories();
            $categorie->nom = $valid2['new_categorie'];
            $categorie->save();
            $valid['categorie'] = $categorie->id; 
        }else{
            $categorie=$valid['categorie'] ;
        }
        
        
        $marchandise = new marchandises();
        $marchandise->nom = $valid['nom'];
        
        $marchandise->description = $valid['description'];
        
        if ($valid['quantite']<0) {
            return redirect()->back()->with('error', 'la quantite doit être positive.');
        }
        $marchandise->quantite = $valid['quantite'];
        
        if ($request->file('image') != null) {
            $marchandise->image = $request->file('image')->store('logos', 'public');
        }
        
        $marchandise->id_cat = $valid['categorie'] ?? null;
        try{
        $marchandise->save();
        if ($valid['quantite']>0) {
            $entre = new entres(); 
            $entre->quantite=$valid['quantite'];
            $entre->id_mar=$marchandise->id;
            $entre->save();
            $rapports=rapport::all();
            $found = false; 
            foreach ($rapports as $rapport) {
                $rapportDate = (new DateTime($rapport->date))->format('Y-m-d');
                $entreDate = (new DateTime($entre->created_at))->format('Y-m-d');

                if ($rapportDate == $entreDate) {
                    $rapport->quantite += $entre->quantite;
                    $rapport->save();
                    $found = true;
                    break;
                }
            }

            if (!$found) {
                $rapport = new Rapport();
                $rapport->date = $entre->created_at;
                $rapport->quantite = $entre->quantite;
                $rapport->save();
            }
        }
        return redirect()->route('marchandises.index',$categorie)->with('success', 'Marchandise ajoutée avec succès.');
    } catch (Exception $e) {
        return redirect()->back()->with('error', $e->getMessage());
    }
}
    public function edit(marchandises $marchandises) {
        return View('marchandises.edit',['marchandise'=>$marchandises,'categorie'=>categories::all()]);
    }

    public function update(Request $request,marchandises $marchandise )
    {
        $valid = $request->validate([
            'nom' => 'required|min:3|string',
            'description' => 'string|nullable',
            'quantite' => 'integer|nullable',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            'categorie' => 'required'
        ]);
    
        
         
        
        if (strstr($valid['categorie'],'add')) {
            $valid2 = $request->validate([
                'new_categorie' => 'required|string|min:3' 
            ]);
            $categorie = new Categories();
            $categorie->nom = $valid2['new_categorie'];
            $categorie->save();
            $valid['categorie'] = $categorie->id; 
        }else{
            $categorie=$valid['categorie'] ;
        }
        $marchandise->nom = $valid['nom'];
      
        $marchandise->description = $valid['description'];
    
        if ($request->file('image') != null) {
            $marchandise->image = $request->file('image')->store('logos', 'public');
        }
    
        $marchandise->id_cat = $valid['categorie'] ?? null;
        $marchandise->save();
        return redirect()->route('marchandises.index',$categorie)->with('success', 'marchandise modifier  avec success');
    }

    public function delete(Request $request) {

                if (auth()->user()->role != 'S') {
                    return abort(403, 'you are not a super admin');
                }
                $request->validateWithBag('userDeletion', [
                    'current_password' => ['required', 'current_password'],
                ]);
                $marchandise = marchandises::find($request->id);
                $entres=entres::where('id_mar','=',$marchandise->id)->get();
                $sorties=sorties::where('id_mar','=',$marchandise->id)->get();
                foreach ($entres as $entre) {
                    $rapports=rapport::all();
                    foreach ($rapports as $rapport) {
                        $rapportDate = (new DateTime($rapport->date))->format('Y-m-d');
                            $entreDate = (new DateTime($entre->created_at))->format('Y-m-d');
            
                            if ($rapportDate == $entreDate) {
                                $rapport->quantite -= $entre->quantite;
                                $rapport->save();
                                break;
                        }
                    }
                }
                foreach ($sorties as $sortie) {
                    $rapports=rapport::all();
                    foreach ($rapports as $rapport) {
                        $rapportDate = (new DateTime($rapport->date))->format('Y-m-d');
                            $sortieDate = (new DateTime($sortie->created_at))->format('Y-m-d');
            
                            if ($rapportDate == $sortieDate) {
                                $rapport->quantite += $sortie->quantite;
                                $rapport->save();
                                break;
                        }
                    }
                }
               $marchandise->delete();
        return redirect()->back()->with('success','marchandise supprimer  avec success');
   }
}
