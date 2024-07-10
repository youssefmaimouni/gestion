<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\categories;
use App\Models\entres;
use App\Models\marchandises;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class courbeController extends Controller
{ public function courbe(Request $request)
    {
        $periode = $request->get('periode', 'day');
        $type = $request->get('type', 'bar');
        $categoryId = $request->get('id_cat',1);

        // Déterminer le format de date en fonction de la période sélectionnée
        $dateFormat = match($periode) {
            'month' => '%Y-%m',
            'year' => '%Y',
            default => '%Y-%m-%d'
        };

        // Récupérer les données de la base de données
        $data = DB::table('rapports')
            ->select(DB::raw("SUM(quantite) as total_quantite, DATE_FORMAT(created_at, '$dateFormat') as formatted_date"))
            ->groupBy('formatted_date')
            ->orderBy('formatted_date')
            ->get();

        // Calculer le total cumulé
        $cumulativeTotal = 0;
        $chartData = [];
        foreach ($data as $entry) {
            $cumulativeTotal += $entry->total_quantite;
            $chartData[] = [
                'date' => $entry->formatted_date,
                'quantite' => $cumulativeTotal
            ];
        }

        $categoryData = DB::table('categories')
            ->select(DB::raw("categories.id, SUM(marchandises.quantite) as total_quantite, categories.nom"))
            ->join('marchandises', 'marchandises.id_cat', '=', 'categories.id')
            ->groupBy('categories.id', 'categories.nom')
            ->get();

        $chartDatac = $categoryData->map(function($item) {
            return [
                'id' => $item->id,
                'nom' => $item->nom,
                'quantite' => $item->total_quantite
            ];
        });

        $datam = [];
        $chartDatam = [];
        if ($categoryId) {
            $datam = DB::table('marchandises')
                ->select('nom', 'quantite')
                ->where('id_cat', $categoryId)
                ->get();

            $chartDatam = $datam->map(function($item) {
                return [
                    'nom' => $item->nom,
                    'quantite' => $item->quantite
                ];
            });
        }

        $categories = categories::all();

        return view('rapports.chart', [
            'chartData' => $chartData,
            'periode' => $periode,
            'type'=>$type,
            'chartDatac' => $chartDatac,
            'chartDatam' => $chartDatam,
            'categories' => $categories
        ]);
    }

}