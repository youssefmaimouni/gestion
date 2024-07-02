<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\clients;
use Illuminate\Http\Request;

class clientController extends Controller
{
    public function index() {
        $clients = clients::all();
        return view('clients.index', compact('clients'));
    }

    public function create() {
        return view('clients.create');
    }
    public function store(Request $request) {
        
        $validatedData = $request->validate([
            'nom' => 'required|min:3|string',
            'adresse'=>'min:8|string|nullable',
            'telephone'=>'min:10|max:10|nullable',
            'email'=>'email|nullable',
            'num_fiscal'=>'integer|nullable',
            'compt_bancaire'=>'min:13|nullable',
            'remarque'=>'string|nullable',
            'remise'=>'integer|nullable',
        ]);
    
       
        $client = new clients(); 
        $client->nom = $validatedData['nom'];
        $client->adresse = $validatedData['adresse'];
        $client->telephone = $validatedData['telephone'];
        $client->email = $validatedData['email'];
        $client->num_fiscal = $validatedData['num_fiscal'];
        $client->compt_bancaire = $validatedData['compt_bancaire'];
        $client->remarque = $validatedData['remarque'];
        $client->remise = $validatedData['remise'];
        $client->save();   
    
       
        return redirect()->route('clients.index')->with('success', 'client ajouté avec succès.'); 
    }
    

    public function edit(clients $clients)
    {
        return view('clients.edit',[ 'clients' => $clients]);
    }
    
    public function update(Request $request,clients $client )
    {
       
        $validatedData = $request->validate([
            'nom' => 'required|min:3|string',
            'adresse'=>'min:8|string|nullable',
            'telephone'=>'min:10|max:10|nullable',
            'email'=>'email|nullable',
            'num_fiscal'=>'integer|nullable',
            'compt_bancaire'=>'min:13|nullable',
            'remarque'=>'string|nullable',
            'remise'=>'integer|nullable',
        ]);
    
       
        
        $client->nom = $validatedData['nom'];
        $client->adresse = $validatedData['adresse'];
        $client->telephone = $validatedData['telephone'];
        $client->email = $validatedData['email'];
        $client->num_fiscal = $validatedData['num_fiscal'];
        $client->compt_bancaire = $validatedData['compt_bancaire'];
        $client->remarque = $validatedData['remarque'];
        $client->remise = $validatedData['remise'];
        $client->save();   
        return redirect()->route('clients.index')->with('success', 'client ajouté avec succès.'); 
    }

    public function delete(Request $request) {
                $client=clients::find($request->id);
               $client->delete();

               return redirect()->route('clients.index')->with('success', 'client ajouté avec succès.'); 
   }
}
