<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\entres;
use App\Models\marchandises;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class courbeController extends Controller
{
    public function courbe(Request $request)
    {
        $chart_options = [
            'chart_title' => 'Total de la quantité de stock de marchandises',
            'report_type' => 'group_by_string', // Utiliser group_by_string
            'model' => 'App\Models\marchandises',
            'group_by_field' => 'id', // Grouper par un champ unique pour simuler une somme totale
            'aggregate_function' => 'sum',
            'aggregate_field' => 'quantite',
            'chart_type' => 'bar',
        ];
    
        $chart1 = new LaravelChart($chart_options);
    
        // Requête pour obtenir la quantité totale de stock chaque jour
        $totalQuantite = DB::table('marchandises')
            ->select(DB::raw("SUM(quantite) as total_quantite"))
            ->first();
    
        Log::debug('Quantité totale de stock:', ['total_quantite' => $totalQuantite]);
    
        return view('rapports.chart', compact('chart1', 'totalQuantite'));
    }
    

    
}
