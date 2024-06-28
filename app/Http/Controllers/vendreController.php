<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\marchandises;
use App\Models\tags;
use Illuminate\Http\Request;

class vendreController extends Controller
{
    public function index() {
        $tags = tags::all();
        return view('tags.index', compact('tags'));
    }

    public function create() {
        return view('tags.create',['marchandise'=>marchandises::all()]);
    }
    public function store(Request $request) {
        
        $validatedData = $request->validate([
            'nom' => 'required|min:3|string',
            'id_mar' => 'required|exists:marchandises,id'
        ]);
    
       
        $tag = new tags(); 
        $tag->nom = $validatedData['nom'];
        $tag->id_mar = $validatedData['id_mar']; 
        $tag->save();
    
       
        return redirect()->route('tags.index')->with('success', 'Tag ajouté avec succès.'); 
    }
    

    public function edit(tags $tags)
    {
        return view('tags.edit', ['tag' => $tags,'marchandise'=>marchandises::all()]);
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
