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
        return view('sorties.create',['categories'=>categories::all()]);
    }
    public function store(Request $request) {
        $validatedData = $request->validate([
                'quantite'=>'integer',
                'id_mar'=>'exists:marchandises,id'
        ]);
        $marchandises = Marchandises::find($validatedData['id_mar']);
        if ($validatedData['quantite']<0) {
            return redirect()->back()->with('error', 'la quantite doit être positive.');
        }
        if ($validatedData['quantite'] > $marchandises->quantite) {
            return redirect()->back()->with('error','La quantité demandée dépasse la quantité disponible.');
        }
        $sortie = new sorties(); 
       $sortie->quantite=$validatedData['quantite'];
       $sortie->id_mar=$validatedData['id_mar'];
       $marchandises->quantite=$marchandises->quantite-$validatedData['quantite'];
       $marchandises->save();
        $sortie->save();
    
        return redirect()->back()->with('success', 'sortie crée avec success.');
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
            'quantite'=>'integer',
            'id_mar'=>'exists:marchandises,id'
    ]);
    $sortie = new sorties(); 
   $sortie->quantite=$validatedData['quantite'];
   $sortie->id_mar=$validatedData['id_mar'];
    $sortie->save();

    return redirect()->back()->with('success');
    }

    public function delete(Request $request) {
       
        $sortie = sorties::find($request->id);
        $marchandises=marchandises::find($sortie->id_mar);
            $marchandises->quantite=$marchandises->quantite+$sortie->quantite;
            $marchandises->save();
               $sortie->delete();

               return redirect()->back();
   }
}
