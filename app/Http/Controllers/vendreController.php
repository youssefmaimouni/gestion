<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\marchandises;
use App\Models\tags;
use App\Models\vendres;
use Illuminate\Http\Request;

class vendreController extends Controller
{
    public function index() {
        $vendres = vendres::all();
        return view('vendres.index', compact('vendres'));
    }

    public function create() {
        return view('vendres.create');
    }
    public function store(Request $request) {
        $validatedData = $request->validate([
            'id_mar' => 'required|exists:marchandises,id',
            'id_sortie' => 'required|exists:sorties,id',
            'quantite' => 'required|integer|min:0'
        ]);
    
        $marchandise = Marchandises::find($validatedData['id_mar']);
    
        if ($validatedData['quantite'] > $marchandise->quantite) {
            return redirect()->back()->withErrors('La quantité demandée dépasse la quantité disponible.');
        }
    
        $vendre = new Vendres();
        $vendre->id_sortie = $validatedData['id_sortie'];
        $vendre->id_mar = $validatedData['id_mar'];
        $vendre->quantite = $validatedData['quantite'];
        $vendre->save();
    
        $marchandise->quantite -= $validatedData['quantite'];
        $marchandise->save();
    
        return redirect()->back()->with('success', 'Vendre ajouté avec succès et quantité de marchandise mise à jour.');
    }
    
    

    public function edit(vendres $vendres)
    {
        return view('vendres.edit', ['vendre' => $vendres]);
    }
    
    public function update(Request $request,vendres $vendre )
    {
        $validatedData = $request->validate([
            'id_mar' => 'required|exists:marchandises,id',
            'id_sortie' => 'required|exists:sorties,id'
        ]);
    
       
        $vendre = new vendres(); 
        $vendre->nom = $validatedData['id_sortie'];
        $vendre->id_mar = $validatedData['id_mar']; 
        $vendre->save();
        return view('modifier_vendre');
       
        
    }

    public function delete(vendres  $vendre) {
       
               $vendre->delete();

           return view('/');
   }
}
