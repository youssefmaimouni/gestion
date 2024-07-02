<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\fournisseurs;
use Illuminate\Http\Request;

class fournisseurController extends Controller
{
    public function index() {
        $fournisseurs = fournisseurs::all();
        return view('fournisseurs.index', compact('fournisseurs'));
    }

    public function create() {
        return view('fournisseurs.create');
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
        ]);
        $fournisseur = new fournisseurs(); 
        $fournisseur->nom = $validatedData['nom'];
        $fournisseur->adresse = $validatedData['adresse'];
        $fournisseur->telephone = $validatedData['telephone'];
        $fournisseur->email = $validatedData['email'];
        $fournisseur->num_fiscal = $validatedData['num_fiscal'];
        $fournisseur->compt_bancaire = $validatedData['compt_bancaire'];
        $fournisseur->remarque = $validatedData['remarque'];
        $fournisseur->save();
        return redirect()->route('fournisseurs.index')->with('success', 'fournisseur ajouté avec succès.'); 
    }
    public function edit(fournisseurs $fournisseurs)
    {
        return view('fournisseurs.edit',[ 'fournisseur' => $fournisseurs]);
    }
    public function update(Request $request,fournisseurs $fournisseur )
    {
        $validatedData = $request->validate([
            'nom' => 'required|min:3|string',
            'adresse'=>'min:8|string',
            'telephone'=>'tel|min:10|max:10',
            'email'=>'mail',
            'num_fiscal'=>'integer',
            'compt-bancaire'=>'min:13',
            'remarque'=>'text',
        ]);
        $fournisseur = new fournisseurs(); 
        $fournisseur->nom = $validatedData['nom'];
        $fournisseur->adresse = $validatedData['adresse'];
        $fournisseur->telephone = $validatedData['telephone'];
        $fournisseur->email = $validatedData['email'];
        $fournisseur->num_fiscal = $validatedData['num_fiscal'];
        $fournisseur->compt_bancaire = $validatedData['compt_bancaire'];
        $fournisseur->remarque = $validatedData['remarque'];
        $fournisseur->save();   
        return redirect()->route('fournisseurs.index')->with('success', 'fournisseur modifier avec succès.'); 
    }
    public function delete(fournisseurs  $fournisseur) {
        $fournisseur->delete();
        return view('/');
   }
}