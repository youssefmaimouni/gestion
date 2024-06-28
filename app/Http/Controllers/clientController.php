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
            'adresse'=>'min:8|string',
            'telephone'=>'tel|min:10|max:10',
            'email'=>'mail',
            'num_fiscal'=>'integer',
            'compt-bancaire'=>'min:13',
            'remarque'=>'text',
            'remise',
        ]);
    
       
        $client = new clients(); 
        $client->nom = $validatedData['nom'];
        $client->nom = $validatedData['adresse'];
        $client->nom = $validatedData['telephone'];
        $client->nom = $validatedData['email'];
        $client->nom = $validatedData['num_fiscal'];
        $client->nom = $validatedData['compt_bancaire'];
        $client->nom = $validatedData['remarque'];
        $client->nom = $validatedData['remise'];
        $client->save();
    
       
        return redirect()->route('clients.index')->with('success', 'client ajouté avec succès.'); 
    }
    

    public function edit(clients $clients)
    {
        return view('clients.edit',[ 'client' => $clients]);
    }
    
    public function update(Request $request,clients $client )
    {
       
        $validatedData = $request->validate([
            'nom' => 'required|min:3|string',
            'adresse'=>'min:8|string',
            'telephone'=>'tel|min:10|max:10',
            'email'=>'mail',
            'num_fiscal'=>'integer',
            'compt-bancaire'=>'min:13',
            'remarque'=>'text',
            'remise',
        ]);
    
       
        $client = new clients(); 
        $client->nom = $validatedData['nom'];
        $client->nom = $validatedData['adresse'];
        $client->nom = $validatedData['telephone'];
        $client->nom = $validatedData['email'];
        $client->nom = $validatedData['num_fiscal'];
        $client->nom = $validatedData['compt_bancaire'];
        $client->nom = $validatedData['remarque'];
        $client->nom = $validatedData['remise'];
        $client->save();   
        
    }

    public function delete(clients  $client) {
       
               $client->delete();

           return view('/');
   }
}
