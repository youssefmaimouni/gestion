<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphiques interactifs avec Chart.js</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
           
        }
        .chart-container {
            width: 100%;
            max-width: 600px;
            padding: 20px;
            margin: 20px auto;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .chart-container.full-width {
            max-width: 1000px;
        }
        .charts-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
        }
        .styled-select {
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
            color: #333;
            outline: none;
            width: 150px;
            height: 40px;
            transition: border-color 0.3s, box-shadow 0.3s;
            margin-bottom: 10px;
        }
        .styled-select:hover {
            border-color: #888;
        }
        .styled-select:focus {
            border-color: #555;
            box-shadow: 0 0 8px rgba(81, 203, 238, 0.6);
        }
        h2 {
            font-size: 20px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }
        form {
            display: flex;
            justify-content: center;
            gap: 10px;
        }
        canvas {
            width: 100%;
            max-width: 600px;
            max-height: 400px;
        }
        .no-data-message {
            text-align: center;
            color: #888;
            font-size: 16px;
            padding: 20px;
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <x-nav-bar>
        <div class="charts-row">
            <div class="chart-container">
                <h2>Graphique des Catégories</h2>
                <canvas id="categoryChart"></canvas>
            </div>

            <div id="itemChartContainer" class="chart-container">
                <h2>Graphique des Marchandises</h2>
                <form action="{{ route('rapports.courbe') }}" method="GET">
                    <select name="id_cat" class="styled-select" onchange="this.form.submit()">
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}" {{ request('id_cat') == $item->id ? 'selected' : '' }}>{{ $item->nom }}</option>
                        @endforeach
                    </select>
                </form>
                <div id="itemChartMessage" class="no-data-message" style="display: none;">Aucune marchandise disponible pour cette catégorie.</div>
                <canvas id="itemChart" style="display: none;"></canvas>
            </div>
        </div>

        <div class="charts-row">
            <div class="chart-container full-width">
                <h2>Graphique du Stock</h2>
                <form action="{{ route('rapports.courbe') }}" method="GET">
                    <select name="periode" class="styled-select" onchange="this.form.submit()">
                        <option value="day" {{ request('periode') == 'day' ? 'selected' : '' }}>Jour</option>
                        <option value="month" {{ request('periode') == 'month' ? 'selected' : '' }}>Mois</option>
                        <option value="year" {{ request('periode') == 'year' ? 'selected' : '' }}>Année</option>
                    </select>
                    <select name="type" class="styled-select" onchange="this.form.submit()">
                        <option value="bar" {{ request('type') == 'bar' ? 'selected' : '' }}>Barre</option>
                        <option value="line" {{ request('type') == 'line' ? 'selected' : '' }}>Ligne</option>
                    </select>
                </form>
                <canvas id="stockChart"></canvas>
            </div>
        </div>

        <div class="charts-row">
            <div class="chart-container  full-width">
                <h2>Graphique des Entrées/Sorties</h2>
                <form action="{{ route('rapports.courbe') }}" method="GET">
                    <select name="periode2" class="styled-select" onchange="this.form.submit()">
                        <option value="day" {{ request('periode2') == 'day' ? 'selected' : '' }}>Jour</option>
                        <option value="month" {{ request('periode2') == 'month' ? 'selected' : '' }}>Mois</option>
                        <option value="year" {{ request('periode2') == 'year' ? 'selected' : '' }}>Année</option>
                    </select>
                    <select name="type2" class="styled-select" onchange="this.form.submit()">
                        <option value="bar" {{ request('type2') == 'bar' ? 'selected' : '' }}>Barre</option>
                        <option value="line" {{ request('type2') == 'line' ? 'selected' : '' }}>Ligne</option>
                    </select>
                </form>
                <canvas id="esChart"></canvas>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const chartData = @json($chartData);
                const chartDataentre = @json($chartDataentre);
                const chartDatasortie = @json($chartDatasortie);
                const chartDatac = @json($chartDatac);
                const chartDatam = @json($chartDatam);
                const type = @json($type);
                const type2 = @json($type2);
                const periode2 = @json($periode2);

                function initializeChart(ctx, type, labels, datasets) {
                    new Chart(ctx, {
                        type: type,
                        data: {
                            labels: labels,
                            datasets: datasets
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                }

                const ctxCategory = document.getElementById('categoryChart').getContext('2d');
                initializeChart(ctxCategory, 'pie', chartDatac.map(item => item.nom), [{
                    label: 'Quantité',
                    data: chartDatac.map(item => item.quantite),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]);

                const ctxItem = document.getElementById('itemChart').getContext('2d');
                if (chartDatam.length > 0) {
                    document.getElementById('itemChart').style.display = 'block';
                    document.getElementById('itemChartMessage').style.display = 'none';
                    initializeChart(ctxItem, 'pie', chartDatam.map(item => item.nom), [{
                        label: 'Quantité',
                        data: chartDatam.map(item => item.quantite),
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]);
                } else {
                    document.getElementById('itemChart').style.display = 'none';
                    document.getElementById('itemChartMessage').style.display = 'block';
                }

                const ctxStock = document.getElementById('stockChart').getContext('2d');
                initializeChart(ctxStock, type, chartData.map(item => item.date), [{
                    label: 'Quantité du stock',
                    data: chartData.map(item => item.quantite),
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]);

                const ctxES = document.getElementById('esChart').getContext('2d');
                initializeChart(ctxES, type2, chartDataentre.map(item => item.date), [
                    {
                        label: 'Entrée',
                        data: chartDataentre.map(item => item.quantite),
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Sortie',
                        data: chartDatasortie.map(item => item.quantite),
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderWidth: 1
                    }
                ]);
            });
        </script>
    </x-nav-bar>
</body>
</html>
