<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\acheters;
use App\Models\marchandises;
use Illuminate\Http\Request;

class acheterController extends Controller
{
    public function index() {
        $acheters = acheters::all();
        return view('acheters.index', compact('acheters'));
    }

    public function create() {
        return view('acheters.create');
    }
    public function store(Request $request) {
        $validatedData = $request->validate([
            'id_mar' => 'required|exists:marchandises,id',
            'id_entre' => 'required|exists:entres,id',
            'quantite' => 'numeric|min:0'
        ], [
            'id_mar.required' => 'The merchandise ID is required.',
            'id_mar.exists' => 'The selected merchandise does not exist.',
            'id_entre.required' => 'The entry ID is required.',
            'id_entre.exists' => 'The selected entry does not exist.',
            'quantite.numeric' => 'The quantity must be a number.',
            'quantite.min' => 'The quantity must not be less than zero.'
        ]);
        
       
        $marchandise = Marchandises::find($validatedData['id_mar']);
       
        $acheter = new acheters(); 
        $acheter->id_entre = $validatedData['id_entre'];
        $acheter->id_mar = $validatedData['id_mar']; 
        
        $acheter->quantite = $validatedData['quantite']; 
        $acheter->save();

        $marchandise->quantite += $validatedData['quantite'];
        $marchandise->save();
    
       
        return redirect()->back()->with('success', 'acheter ajouté avec succès.'); 
    }
    

    public function edit(acheters $acheters)
    {
        return view('acheters.edit', ['acheter' => $acheters]);
    }
    
    public function update(Request $request,acheters $acheter )
    {
        $validatedData = $request->validate([
            'id_mar' => 'required|exists:marchandises,id',
            'id_entre' => 'required|exists:entres,id'
        ]);
    
       
        $acheter = new acheters(); 
        $acheter->nom = $validatedData['id_entre'];
        $acheter->id_mar = $validatedData['id_mar']; 
        $acheter->save();
        return view('modifier_acheter');
       
        
    }

    public function delete(acheters  $acheter) {
       
               $acheter->delete();

           return view('/');
   }
}
