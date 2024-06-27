<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\marchandises;
use Exception;
use Illuminate\Http\Request;

class marchandiseController extends Controller
{
    public function index(){
        $marchandise = marchandises::all();
        return $marchandise;
    }

    public function store(Request $request){

        $valid = $request->validate([
         'nom'=>'required|min:3|string',
        'barre_code'=>'integer',
        'description'=>'string|min:50',
        'quantite'=>'integer',
        'unite'=>'string',
        'image'=>'string',
         'id_cat'=>'required|exists:categories,id'
        ]);

       
        $marchandise = new marchandises();
        $marchandise->nom=$valid['nom'];
        $marchandise->barre_code=$valid['barre_code'];
        $marchandise->description=$valid['description'];
        $marchandise->quantite=$valid['quantite'];
        $marchandise->unite=$valid['unite'];
        $marchandise->image=$valid['image'];
        $marchandise->id_cat=$valid['id_cat'];
        $marchandise->save();


        return view('modifier_marchandise');
        
    }
    public function update(Request $request,marchandises $marchandise )
    {
        $valid = $request->validate([
        'nom'=>'required|min:3|string',
        'barre_code'=>'integer',
        'description'=>'string|min:50',
        'quantite'=>'integer',
        'unite'=>'string',
        'image'=>'string',
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
        return view('marchandises');
        
    }

    public function delete(marchandises  $marchandise) {
        
               $marchandise->delete();

           return view('/');
           
           
        
   }
}
