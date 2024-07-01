<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\clients;
use App\Models\sorties;
use Illuminate\Http\Request;

class sortieController extends Controller
{
    public function index() {
        $sorties = sorties::all();
        return view('sorties.index', compact('sorties'));
    }

    public function create() {
        return view('sorties.create',['clients'=>clients::all()]);
    }
    public function store(Request $request) {
        
        $validatedData = $request->validate([
            'nom' => 'required|min:3|string',
            'id_mar' => 'required|exists:marchandises,id'
        ]);
    
       
        $sortie = new sorties(); 
        $sortie->nom = $validatedData['nom'];
        $sortie->id_mar = $validatedData['id_mar']; 
        $sortie->save();
    
       
        return redirect()->route('sorties.index')->with('success', 'sortie ajouté avec succès.'); 
    }
    

    public function edit(sorties $sorties)
    {
        return view('sorties.edit', ['sortie' => $sorties]);
    }
    
    public function update(Request $request,sorties $sortie )
    {
        $valid = $request->validate([
        'nom'=>'min:3|string',
        'id_mar'=>'required|exists:marazins,id'
        ]);
            $sortie->nom=$valid['nom'];
            $sortie->id_sortie=$valid['id_mar'];
        $sortie->save();
        return view('modifier_sortie');
       
        
    }

    public function delete(sorties  $sortie) {
       
               $sortie->delete();

           return view('/');
   }
}
