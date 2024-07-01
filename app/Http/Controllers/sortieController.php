<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\marchandises;
use App\Models\sorties;
use Illuminate\Http\Request;

class sortieController extends Controller
{
    public function index() {
        $sorties = sorties::all();
        return view('sorties.index', compact('sorties'));
    }

    public function create() {
        return view('sorties.create');
    }
    public function store(Request $request) {
        
        $validatedData = $request->validate([
           'date_doc' => 'date|required',
            'description' => 'string|nullable',
            'id_clt' => 'integer|nullable',
            'id_cat' => 'integer',
            'remise'=>'number'
        ]);
    
        $sortie = new sorties(); 
        $sortie->date_doc = $validatedData['date_doc'];
        $sortie->description = $validatedData['description']; 
        $sortie->remise = $validatedData['remise']; 
        $sortie->id_clt = $validatedData['id_clt'];
        $sortie->id_cat = $validatedData['id_cat'];

        $sortie->save();
        return redirect('/sorties/'.$sortie->id.'/'.$sortie->id_cat.'/mar')->with('success');
    }

    public function vendre(sorties $sorties, categories $categories ){
        $marchandises = $marchandises=marchandises::where('id_cat','=',$categories->id)->get();
        return view('sorties.index_mar',['sorties'=>$sorties,'marchandises'=>$marchandises]);
    }
    

    public function edit(sorties $sorties)
    {
        return view('sorties.edit', ['sortie' => $sorties]);
    }
    
    public function update(Request $request,sorties $sortie )
    {
        $validatedData = $request->validate([
            'date_doc' => 'date|required',
             'description' => 'string|nullable',
             'id_clt' => 'integer|nullable',
             'id_cat' => 'integer'
         ]);
     
        
         $sortie->date_doc = $validatedData['date_doc'];
         $sortie->description = $validatedData['description']; 
         $sortie->id_clt = $validatedData['id_clt'];
         $sortie->id_cat = $validatedData['id_cat'];
         $sortie->save();

         return redirect('/sorties/'.$sortie->id.'/'.$sortie->id_cat.'/mar')->with('success');
       
        
    }

    public function delete(sorties  $sortie) {
       
               $sortie->delete();

           return view('/');
   }
}
