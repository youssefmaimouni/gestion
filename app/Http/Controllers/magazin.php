<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\magazins;
use Exception;
use Illuminate\Http\Request;

class magazin extends Controller
{
  public function index(){
        $magazin = magazins::all();
        return $magazin;
    }

    public function store(Request $request){

        $valid = $request->validate([
            'nom' => ['required', 'min:3'],
            'cacher' => 'boolean' 
        ]);

     
        $magazin = new magazins();
        $magazin->nom=$valid['nom'];
        $magazin->cacher=$valid['cacher'];
        $magazin->save();


        return view('ajouter_mag');
        
    }
    public function update(Request $request,magazins $magazin )
    {
        $valid = $request->validate([
            'nom' => [ 'required','min:3'],
            'cacher' => 'boolean' 
        ]);

      
           
        $magazin->nom=$valid['nom'];
        $magazin->cacher=$valid['cacher'];
        $magazin->save();
        return view('modifier_magazin');
        
        
    }

    public function delete(magazins  $magazin) {
        
               $magazin->delete();

           return view('/');


 
   }
}