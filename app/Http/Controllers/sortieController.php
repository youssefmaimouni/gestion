<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\clients;
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
        return view('sorties.create',['clients'=>clients::all(),'categories'=>categories::all()]);
    }
    public function store(Request $request) {
        $validatedData = $request->validate([
           'date_doc' => 'date|required',
            'description' => 'string|nullable',
            'id_client' => 'integer|nullable',
            'id_cat' => 'integer|nullable',
            'remise'=>'integer|nullable',
            'attachement' => 'nullable|mimes:png,gif,jpeg,jpg,pdf|max:2048',
        ]);
    
        $sortie = new sorties(); 
        $sortie->date_doc = $validatedData['date_doc'];
        $sortie->description = $validatedData['description']; 
        $sortie->remise = $validatedData['remise']; 
        $sortie->id_client = $validatedData['id_client'];
        $sortie->id_cat = $validatedData['id_cat'];
        if ($request->file('attachement')) {
            $file = $request->file('attachement');
            $path = $file->store('uploads', 'public');
            $sortie->attachement = $path; 
        }

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
             'id_client' => 'integer|nullable',
             'id_cat' => 'integer'
         ]);
     
        
         $sortie->date_doc = $validatedData['date_doc'];
         $sortie->description = $validatedData['description']; 
         $sortie->id_client = $validatedData['id_clt'];
         $sortie->id_cat = $validatedData['id_cat'];
         $sortie->save();

         return redirect('/sorties/'.$sortie->id.'/'.$sortie->id_cat.'/mar')->with('success');
       
        
    }

    public function delete(sorties  $sortie) {
       
               $sortie->delete();

               return redirect()->back();
   }
}
