<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\acheters;
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
            'id_entre' => 'required|exists:entres,id'
        ]);
    
       
        $acheter = new acheters(); 
        $acheter->nom = $validatedData['id_entre'];
        $acheter->id_mar = $validatedData['id_mar']; 
        $acheter->save();
    
       
        return redirect()->route('acheters.index')->with('success', 'acheter ajouté avec succès.'); 
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
