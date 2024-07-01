<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\documents;
use Illuminate\Http\Request;

class documentController extends Controller
{
    public function index() {
        $documents = documents::all();
        return view('documents.index', compact('documents'));
    }

    public function create() {
        return view('documents.create');
    }
    public function store() {
        
        $document = new documents(); 
    
        return redirect()->route('documents.index')->with('success', 'document ajouté avec succès.'); 
    }
    

    public function delete(documents  $document) {
       
               $document->delete();

           return view('/');
   }
}
