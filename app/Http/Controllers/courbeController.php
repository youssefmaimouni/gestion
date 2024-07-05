<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\marchandises;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class courbeController extends Controller
{
    
        public function courbe()
        {
            
            $chart_options = [
              'chart_title' => 'Quantités de marchandises mises à jour pour le mois ' ,
              'report_type' => 'group_by_date',
              'model' => 'App\Models\marchandises',
              'group_by_field' => 'created_at',
              'group_by_period' => 'day',
              'aggregate_function' => 'sum',
              'aggregate_field' => 'quantite',
              'chart_type' => 'bar'
            ];
        
            $chart1 = new LaravelChart($chart_options);

       
        $chartData = marchandises::select(DB::raw('SUM(quantite) as total_quantite'), DB::raw('DATE(created_at) as date'))
            // ->where(DB::raw('DATE_FORMAT(created_at, "%Y-%m")'), $lastMonth)
            ->groupBy('date')
            ->get();

        Log::debug('Chart Data:', $chartData->toArray());

        

        return view('rapports.chart', compact('chart1'));
        }
        
    
}
