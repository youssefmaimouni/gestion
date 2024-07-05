<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Marchandises; // Ensure this matches the correct model namespace
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RapportController extends Controller
{
    public function index()
    {
        $marchandises = Marchandises::all();
        return view('rapports.index', compact('marchandises'));
    }

    public function downloadPdf() 
    {
        // Fetch the data to be passed to the view
        $marchandises = Marchandises::all();
        $data = ['title' => 'Rapport PDF', 'marchandises' => $marchandises];
    
        // Generate the PDF
        $pdf = Pdf::loadView('rapports.pdf', $data);
        return $pdf->download('rapport.pdf');
    }
}