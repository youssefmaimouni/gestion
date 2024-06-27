<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\marchandises;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class marchandise extends Controller
{
    public function index(){
        $marchandise = marchandises::all();
        return view('marchandise', ['marchandises'=>$marchandise]);
    }

    public function store(Request $request){
        $valid = $request->validate([
            'nom'=>'required|min:3|string',
            'barre_code'=>'integer|nullable',
            'description'=>'string|nullable',
            'quantite'=>'integer|nullable',
            'unite'=>'string|nullable',
            // 'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:3000',
            'categorier'=>'required|exists:categories,id'
        ]);
        $marchandise = new marchandises();
        $marchandise->nom=$valid['nom'];
        $marchandise->barre_code=$valid['barre_code'];
        $marchandise->description=$valid['description'];
        $marchandise->quantite=$valid['quantite'];
        $marchandise->unite=$valid['unite'];
        if ($request->file('image') != null) {
            $marchandise->image =  $request->file('image')->store('logos', 'public');
        }
        if ($request->categorier == -1) {
            $category = new categories();
            $category->categorier = strtolower($request->new_cat);
            $category->save();
            $marchandise->id_cat = $category->id;
        }else{
            $marchandise->id_cat =  $request->categorier;
        }
        $marchandise->id_cat=$valid['categorier'];
        $marchandise->save();
        return redirect('/home')->with('success', 'marchandise crée  avec succee');
    }
    public function ajout(marchandises $marchandise) {
        return View('marchandise-store',['marchandise'=>$marchandise,'categorier'=>categories::all()]);
    }

    public function update(Request $request,marchandises $marchandise )
    {
        $valid = $request->validate([
        'nom'=>'required|min:3|string',
        'barre_code'=>'integer',
        'description'=>'string|min:50',
        'quantite'=>'integer',
        'unite'=>'string',
        'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:3000',
         'id_cat'=>'required|exists:categories,id'
        ]);
            $marchandise->nom=$valid['nom'];
            $marchandise->barre_code=$valid['barre_code'];
            $marchandise->description=$valid['description'];
            $marchandise->quantite=$valid['quantite'];
            $marchandise->unite=$valid['unite'];
            $marchandise->image=$valid['image'];
            $marchandise->id_cat=$valid['id_cat'];
            $marchandise->save();
        return redirect()-back()->with('success', 'marchandise modifier  avec success');
    }

    public function delete(marchandises  $marchandise) {
               $marchandise->delete();
        return redirect()-back()->with('success', 'marchandise supprimer  avec success');
   }
}
