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

    public function __construct()
    {
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
        $this->marchandises = $marchandises;
    }

    public function view(): View
    {
        return view('rapports.excel', [
            'marchandises' => $this->marchandises,
        ]);
    }
}
