<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\tags;
use Exception;
use Illuminate\Http\Request;

class tag extends Controller
{
    public function index(){
        $tag = tags::all();
        return $tag;
    }

    public function store(Request $request){

        $valid = $request->validate([
         'nom'=>'required|min:3|string',
         'id_mar'=>'required|exists:marazins,id'
        ]);

        
        $tag = new tags();
        $tag->nom=$valid['nom'];
        $tag->nom=$valid['id_mar'];
        $tag->save();


        return view('ajouter_tag');
        
        
        
    }
    public function update(Request $request,tags $tag )
    {
        $valid = $request->validate([
        'nom'=>'min:3|string',
        'id_mar'=>'required|exists:marazins,id'
        ]);

     
           
            $tag->nom=$valid['nom'];
            $tag->id_tag=$valid['id_mar'];
        $tag->save();
        return view('modifier_tag');
       
        
    }

    public function delete(tags  $tag) {
       
               $tag->delete();

           return view('/');
   }
}
