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
    $periode = $request->get('periode', 'day');
    $chart_options = [
        'chart_title' => 'Evolution de la quantité de stock de marchandises',
        'report_type' => 'group_by_date',
        'model' => 'App\Models\marchandises',
        'group_by_field' => 'updated_at', // Assumons que les mises à jour sont enregistrées dans ce champ
        'group_by_period' => $periode,
        'aggregate_function' => 'sum',
        'aggregate_field' => 'quantite',
        'chart_type' => 'bar', // Type de graphique en ligne pour suivre l'évolution
    ];
    $chart1 = new LaravelChart($chart_options);
    $dateFormat = match($periode) {
        'month' => '%Y-%m',
        'year' => '%Y',
        default => '%Y-%m-%d'
    };
    $currentDate = date('Y-m-d');
    $startDate = match($periode) {
        'month' => date('Y-m-01'), // Premier jour du mois courant
        'year' => date('Y-01-01'), // Premier jour de l'année courante
        default => $currentDate
    };
    // Requête pour obtenir la quantité totale de stock chaque jour
    $stockData = DB::table('marchandises')
        ->select(
            DB::raw("SUM(quantite) as total_quantite"),
            DB::raw("DATE_FORMAT(updated_at, '$dateFormat') as date")
        )
        ->whereBetween('updated_at', [$startDate, $currentDate])
        ->groupBy('date')
        ->orderBy('date')
        ->get();
    Log::debug('Chart Data:', $stockData->toArray());
    return view('rapports.chart', compact('chart1', 'stockData'));
}  
}