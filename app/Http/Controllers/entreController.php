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

    public function store(Request $request) {
        $validatedData = $request->validate([
                'quantite'=>'integer',
                'id_mar'=>'exists:marchandises,id'
        ]);
        $entre = new entres(); 
       $entre->quantite=$validatedData['quantite'];
       $entre->id_mar=$validatedData['id_mar'];
       $marchandises=marchandises::find($validatedData['id_mar']);
       $marchandises->quantite=$marchandises->quantite+$validatedData['quantite'];
       $marchandises->save();
        $entre->save();

    
        return redirect()->back()->with('success', 'Entrée  crée avec success.');
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
                    'quantite'=>'integer',
                    'id_mar'=>'exists:marchandises,id'
                ]); 
                $entre->quantite=$validatedData['quantite'];
                $entre->id_mar=$validatedData['id_mar'];
                $entre->save();

            return redirect()->back()->with('success');
        
    }

    public function delete(Request $request) {

        $entre=entres::find($request->id);
            
            $marchandises=marchandises::find($entre->id_mar);
            $marchandises->quantite=$marchandises->quantite-$entre->quantite;
            $marchandises->save();
               $entre->delete();

           return redirect()->back();
   }
}
