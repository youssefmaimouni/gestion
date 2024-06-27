<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\categories;
use Exception;
use Illuminate\Http\Request;

class CategorieController extends Controller 
{
    public function index(){
        $categories = categories::all();
        return view('categories.index', compact('categories'));
    }

    public function create() {
        return view('categories.create');
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'nom' => 'required|min:3|string',
        ]);
       
        $categorie = new Categories();
        $categorie->nom = $validatedData['nom'];
        $categorie->save();

        return redirect()->route('categories.index')->with('success', 'Catégorie ajoutée avec succès.');
    }

    public function edit(categories $categories)
{
    return view('categories.edit', ['categorie' => $categories]);
}

    public function update(Request $request, Categories $categorie) {
        $validatedData = $request->validate([
            'nom' => 'required|min:3|string',
        ]);
        $categorie->nom = $validatedData['nom'];
        $categorie->save();

        return redirect()->route('categories.index')->with('success', 'Catégorie mise à jour avec succès.');
    }

    public function delete(Categories $categorie) {
        try {
            $categorie->delete();
            return redirect()->route('categories.index')->with('success', 'Catégorie supprimée avec succès.');
        } catch (Exception $e) {
            return redirect()->route('categories.index')->with('error', 'Erreur lors de la suppression de la catégorie.');
        }
    }
}
