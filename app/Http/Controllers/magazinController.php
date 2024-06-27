<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\magazins;
use Exception;
use Illuminate\Http\Request;



class magazinController extends Controller
{
    public function index() {
        $magazins = magazins::where('cacher', false)->get();
        return view('magazins.index', compact('magazins'));
    }

    public function create() {
        return view('magazins.create');
    }


    public function store(Request $request) {
        $valid = $request->validate([
            'nom' => ['required', 'min:3'],
            'cacher' => ['nullable']
        ]);

        $magazin = new magazins();
        $magazin->nom = $valid['nom'];
        $magazin->cacher = filter_var($valid['cacher'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $magazin->save();

        return redirect()->route('magazins.index')->with('success', 'Magazin ajouté');
    }

    public function edit(magazins $magazins)
{
    return view('magazins.edit', ['magazin' => $magazins]);
}

    public function update(Request $request, magazins $magazin) {
        $valid = $request->validate([
            'nom' => ['required', 'min:3'],
            'cacher' => ['nullable']
        ]);

        $magazin->nom = $valid['nom'];
        $magazin->cacher = filter_var($valid['cacher'] ?? false, FILTER_VALIDATE_BOOLEAN);
        $magazin->save();

        return redirect()->route('magazins.index')->with('success', 'Magazin modifié');
    }

    public function delete(magazins $magazin) {
        $magazin->delete();
        return redirect()->route('magazins.index')->with('success', 'Magazin supprimé');
    }
}

