<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\entres;
use App\Models\marchandises;
use App\Models\sorties;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class rapportController extends Controller
{

    public function index(){
        $marchandises = marchandises::all();
        $entres = entres::select('marchandises.id',DB::raw('COALESCE(SUM(entres.quantite), 0) as entre'))
                        ->leftJoin('marchandises', 'entres.id_mar', '=', 'marchandises.id')
                        ->groupBy('marchandises.id')
                        ->pluck('entre', 'marchandises.id');
        $sorties = sorties::select('marchandises.id', DB::raw('COALESCE(SUM(sorties.quantite), 0) as sortie'))
                        ->leftJoin('marchandises', 'sorties.id_mar', '=', 'marchandises.id')
                        ->groupBy('marchandises.id')
                        ->pluck('sortie', 'marchandises.id');
     
     foreach ($marchandises as $marchandise) {
                                    $marchandise->entres = $entres[$marchandise->id] ?? 0;
                                    $marchandise->sorties = $sorties[$marchandise->id] ?? 0;
                                    $marchandise->solde = $marchandise->entres - $marchandise->sorties;
                }                           
        return view('rapports.index', compact('marchandises'));
    }

    public function search(Request $request) {
        $search = $request->search;
        $start = $request->start;
        $end = $request->end;
    
        // Initialize the query for 'marchandises'
        $query = marchandises::join('categories', 'marchandises.id_cat', '=', 'categories.id')
            ->select('marchandises.*');
    
        if (isset($search)) {
            $query->where(function($q) use ($search) {
                $q->where('marchandises.nom', 'LIKE', '%' . $search . '%')
                  ->orWhere('categories.nom', 'LIKE', '%' . $search . '%');
            });
        }
    
        $marchandises = $query->get();
    
        // Initialize the 'entres' and 'sorties' queries
        $entresQuery = entres::select('marchandises.id', DB::raw('COALESCE(SUM(entres.quantite), 0) as entre'))
            ->leftJoin('marchandises', 'entres.id_mar', '=', 'marchandises.id')
            ->groupBy('marchandises.id');
        
        $sortiesQuery = sorties::select('marchandises.id', DB::raw('COALESCE(SUM(sorties.quantite), 0) as sortie'))
            ->leftJoin('marchandises', 'sorties.id_mar', '=', 'marchandises.id')
            ->groupBy('marchandises.id');
    
        if (isset($start) && isset($end)) {
            $entresQuery->whereBetween('entres.created_at', [$start, $end]);
            $sortiesQuery->whereBetween('sorties.created_at', [$start, $end]);
        }
    
        $entres = $entresQuery->pluck('entre', 'marchandises.id');
        $sorties = $sortiesQuery->pluck('sortie', 'marchandises.id');
    
        foreach ($marchandises as $marchandise) {
            $marchandise->entres = $entres[$marchandise->id] ?? 0;
            $marchandise->sorties = $sorties[$marchandise->id] ?? 0;
            $marchandise->solde = $marchandise->entres - $marchandise->sorties;
        }
    
        return view('rapports.index', ['marchandises' => $marchandises, 'search' => $search, 'start' => $start, 'end' => $end]);
    }
    

}