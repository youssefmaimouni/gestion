<?php
// app/Exports/MarchendiseDataExport.php

namespace App\Exports;

use App\Models\entres;
use App\Models\marchandises;
use App\Models\sorties;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;

class MarchendiseDataExport implements FromView, ShouldAutoSize
{
    use Exportable;

    private $marchandises;

    public function __construct($filters = [])
    {
        $search=$filters['search'];
        $start=$filters['start'];
        $end=$filters['end'];
        if ($search!==null && (empty($start) && empty($end))) {
            $marchandises = marchandises::join('categories', 'marchandises.id_cat', '=', 'categories.id')
                                        ->where('marchandises.nom', 'LIKE', '%' . $search . '%')
                                        ->orWhere('categories.nom', 'LIKE', '%' . $search . '%')
                                        ->select('marchandises.*')
                                        ->get();
            $entres = entres::select('marchandises.id', DB::raw('COALESCE(SUM(entres.quantite), 0) as entre'))
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
            } elseif (!empty($start) && !empty($end)) {
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

                if ($start == $end) {
                    // If start and end dates are the same, use a single date comparison
                    $entresQuery->whereDate('entres.created_at', $start);
                    $sortiesQuery->whereDate('sorties.created_at', $start);
                } else {
                    // Otherwise, use the range comparison
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
        }else{
            $marchandises = marchandises::paginate(10);
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
        }
        $this->marchandises = $marchandises;
    }

    public function view(): View
    {
        return view('rapports.excel', [
            'marchandises' => $this->marchandises,
        ]);
    }
}
