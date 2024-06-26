<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\categories;
use Exception;
use Illuminate\Http\Request;

class categorie extends Controller
{
    public function index(){
        $categorie = categories::all();
        return $categorie;
    }

    public function store(Request $request){

        $valid = $request->validate([
         'nom'=>'required|min:3|string',
         'id_mag'=>'required|exists:categories,id'
        ]);

       
        $categorie = new categories();
        $categorie->nom=$valid['nom'];
        $categorie->id_mag=$valid['id_mag'];
        $categorie->save();


        return view('ajouter_cat');
        
       
        
    }
    public function update(Request $request,categories $categorie )
    {
        $valid = $request->validate([
        'nom'=>'required|min:3|string',
        'id_mag'=>'required|exists:categories,id'
        ]);
            $categorie->nom=$valid['nom'];
            $categorie->id_mag=$valid['id_mag'];
            $categorie->save();

        return view('modifier_cat');        
    }

    public function delete(categories  $categorie) {
       
               $categorie->delete();

           return view('delete');
           
    }  
        
   
}
