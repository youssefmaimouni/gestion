<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

use App\Models\marchandises;
use Illuminate\Http\Request;

class rapportController extends Controller
{

    public function index_cat(){
        $marchandises = marchandises::all();
        return view('rapports.index', compact('marchandises'));
    }

}