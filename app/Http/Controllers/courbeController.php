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
    
        // Determine the date format based on the selected period
        $dateFormat = match($periode) {
            'month' => '%Y-%m',
            'year' => '%Y',
            default => '%Y-%m-%d'
        };
    
        // Get the current date to limit the query
        $currentDate = date('Y-m-d');
    
        // Fetch the data from the database
        $data = DB::table('rapports')
            ->select(DB::raw("SUM(quantite) as total_quantite, DATE_FORMAT(created_at, '$dateFormat') as formatted_date"))
            ->groupBy('formatted_date')
            ->orderBy('formatted_date')
            ->get();
    
        // Calculate cumulative total
        $cumulativeTotal = 0;
        $chartData = [];
        foreach ($data as $entry) {
            $cumulativeTotal += $entry->total_quantite;
            $chartData[] = [
                'date' => $entry->formatted_date,
                'quantite' => $cumulativeTotal
            ];
        }
    
        // Pass the prepared data to the view
        return view('rapports.chart', ['chartData' => $chartData, 'periode' => $periode]);
    }
       
}