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
            'date_doc' => 'required|date',
            'attachments' => 'nullable|mimes:png,gif,jpeg,jpg,pdf|max:2048',
            'description' => 'nullable|string',
            'id_client' => 'nullable|integer',
            'id_cat' => 'nullable|integer',
        ]);
        $sortie = new sorties(); 
        $sortie->date_doc = $validatedData['date_doc'];
        $sortie->description = $validatedData['description']; 
        $sortie->id_four = $validatedData['id_four'];
        $sortie->id_cat = $validatedData['id_cat'];
    
        if ($request->file('attachments')) {
            $file = $request->file('attachments');
            $path = $file->store('uploads', 'public');
            $sortie->attachement = $path; // Save the file path in the database
        }
    
        $sortie->save();
    
        return redirect('/sorties/'.$sortie->id.'/'.$sortie->id_cat.'/mar')->with('success', 'Entry created successfully.');
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
