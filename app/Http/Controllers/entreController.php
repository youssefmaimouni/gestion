<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\acheters;
use App\Models\entres;
use App\Models\fournisseurs;
use App\Models\marchandises;
use Illuminate\Http\Request;

class entreController extends Controller
{
    public function index() {
        $entres = entres::all();
        return view('entres.index', ['entres'=>$entres]);
    }

    public function create() {
        return view('entres.create',['fournisseurs'=>fournisseurs::all(),'marchandises'=>marchandises::all()]);
    }
    public function store(Request $request) {
        
        $validatedData = $request->validate([
            'date_doc'=>'date|required',
            'attachement'=>'string',
            'descreption'=>'texte',
            'id_four'=>'integer'
        ]);
    
       
        $entre = new entres(); 
        $entre->nom = $validatedData['nom'];
        $entre->attachement = $validatedData['attachement']; 
        $entre->description = $validatedData['description']; 
        $entre->id_four=$validatedData['id_four'];
        $entre->save();

        
    
       
        return redirect()->route('entres.index')->with('success', 'entre ajouté avec succès.'); 
    }
    

    public function edit(entres $entres)
    {
        return view('entres.edit', ['entre' => $entres]);
    }
    
    public function update(Request $request,entres $entre )
    {
        $validatedData = $request->validate([
            'date_doc'=>'date|required',
            'attachement'=>'string',
            'descreption'=>'texte',
            'id_four'=>'integer'
        ]);
    
       
        $entre = new entres(); 
        $entre->nom = $validatedData['nom'];
        $entre->attachement = $validatedData['attachement']; 
        $entre->description = $validatedData['description']; 
        $entre->id_four=$validatedData['id_four'];
        $entre->save();
        return view('modifier_entre');
       
        
    }

    public function delete(entres  $entre) {
       
               $entre->delete();

           return view('/');
   }
}
