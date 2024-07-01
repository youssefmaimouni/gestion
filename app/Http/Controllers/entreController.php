<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\acheters;
use App\Models\categories;
use App\Models\entres;
use App\Models\fournisseurs;
use App\Models\marchandises;
use Illuminate\Http\Request;

class entreController extends Controller
{

    public function create() {
        return view('entres.create',['fournisseurs'=>fournisseurs::all(),'categories'=>categories::all()]);
    }

    public function store(Request $request) {
        $validatedData = $request->validate([
            'date_doc' => 'date|required',
            'description' => 'string|nullable',
            'id_four' => 'integer|nullable',
            'id_cat' => 'integer'
        ]);
    
        $entre = new entres(); 
        $entre->date_doc = $validatedData['date_doc'];
        $entre->description = $validatedData['description']; 
        $entre->id_four = $validatedData['id_four'];
        $entre->id_cat = $validatedData['id_cat'];
        $entre->save();
        return redirect('/entres/'.$entre->id.'/'.$entre->id_cat.'/mar')->with('success');
    }
    
    
    public function acheter(entres $entres, categories $categories ){
        $marchandises = $marchandises=marchandises::where('id_cat','=',$categories->id)->get();
        return view('entres.index_mar',['entres'=>$entres,'marchandises'=>$marchandises]);
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
            'description'=>'texte',
            'id_four'=>'integer',
            'id_cat'=>'integer'
        ]);
    
        $entre->nom = $validatedData['nom'];
        $entre->attachement = $validatedData['attachement']; 
        $entre->description = $validatedData['description']; 
        $entre->id_four=$validatedData['id_four'];
        $entre->id_four=$validatedData['id_cat'];
        $entre->save();
        return view('modifier_entre');
       
        
    }

    public function delete(entres  $entre) {
       
               $entre->delete();

           return redirect()->back();
   }
}
