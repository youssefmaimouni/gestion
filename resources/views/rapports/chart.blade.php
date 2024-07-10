<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Graphique interactif avec Chart.js</title>
    <style>
        .chart-container {
        
            width: 600px;
            height: 400px;
            padding: 20px;
            margin: 40px;
            flex;
        }
        .charts-row {
            display: flex;
            justify-content: space-around;
            align-items: flex-start;
            
        }
        
        .styled-select {
            padding: 2px;
            font-size: 16px;
            border: 1px solid #cccccc91;
            border-radius: 5px;
            background-color: #f9f9f9f5;
            color: #333;
            outline: none;
            width: 150px;
            height: 28px;
        }
        .styled-select:hover {
            border-color: #888;
        }
        .styled-select:focus {
            border-color: #555;
            box-shadow: 0 0 5px rgba(81, 203, 238, 1);
        }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <x-nav-bar>
        
       

       

        <div class="container  charts-row">
            <div class="chart-container chart-container p-15   bg-white rounded-xl shadow-md flex ">
                <h2 class="h-7">Graphique des Catégories</h2>
                <canvas id="categoryChart"></canvas>
            </div>

            <div class="chart-container p-15 bg-white rounded-xl shadow-md flex ">
                <div  >
                <h2 class="m-5 ">Graphique des Marchandises</h2>
                <form action="{{ route('rapports.courbe') }}" method="GET">
                    <select name="id_cat" class="styled-select" onchange="this.form.submit() ">
                        @foreach ($categories as $item)
                            <option value="{{ $item->id }}" {{ request('id_cat') == $item->id ? 'selected' : '' }}>{{ $item->nom }}</option>
                        @endforeach
                    </select>
                </form>
                </div>
                <canvas id="itemChart"></canvas>
            </div>
        </div>

         <div class="container m-4 px-5 p-15 bg-white rounded-xl shadow-md  ">  
            <div class=" p-5 bg-white flex ">
        <form action="{{ route('rapports.courbe') }}" method="GET">
            <select name="periode" class="styled-select" onchange="this.form.submit()" >
                <option value="day" {{ request('periode') == 'day' ? 'selected' : '' }}>Jour</option>
                <option value="month" {{ request('periode') == 'month' ? 'selected' : '' }}>Mois</option>
                <option value="year" {{ request('periode') == 'year' ? 'selected' : '' }}>Année</option>
            </select>
        </form>
        <form action="{{ route('rapports.courbe') }}" method="GET">
            <select name="type" class="styled-select" onchange="this.form.submit()" >
                <option value="bar" {{ request('type') == 'bar' ? 'selected' : '' }}>barre</option>
                <option value="line" {{ request('type') == 'line' ? 'selected' : '' }}>ligne</option>
            </select>
        </form><br>
        
            </div>
            
            <canvas class=' chart-container px-4' id="stockChart"></canvas>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                
                const ctxStock = document.getElementById('stockChart').getContext('2d');
                const chartData = @json($chartData);
                const type = @json($type);

                const stockLabels = chartData.map(data => data.date);
                const stockData = chartData.map(data => data.quantite);

                new Chart(ctxStock, {
                    type: type,
                    data: {
                        labels: stockLabels,
                        datasets: [{
                            label: 'Quantité Cumulative',
                            data: stockData,
                            backgroundColor: 'rgba(54, 162, 235, 0.5)',
                            borderColor: 'rgba(54, 162, 235, 1)',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

             
                const ctxCategory = document.getElementById('categoryChart').getContext('2d');
                const chartDatac = @json($chartDatac);
                const categoryLabels = chartDatac.map(function(e) { return e.nom; });
                const categoryQuantities = chartDatac.map(function(e) { return e.quantite; });

                new Chart(ctxCategory, {
                    type: 'pie',
                    data: {
                        labels: categoryLabels,
                        datasets: [{
                            label: 'Quantité',
                            data: categoryQuantities,
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
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Graphique des Catégories'
                            }
                        }
                    }
                });

 
                const ctxmar = document.getElementById('itemChart').getContext('2d');
                const chartDatam = @json($chartDatam);
                if (chartDatam.length > 0) {
                    const marLabels = chartDatam.map(function(e) { return e.nom; });
                    const marQuantities = chartDatam.map(function(e) { return e.quantite; });

                    new Chart(ctxmar, {
                        type: 'pie',
                        data: {
                            labels: marLabels,
                            datasets: [{
                                label: 'Quantité',
                                data: marQuantities,
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
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: true,
                            plugins: {
                                legend: {
                                    position: 'top',
                                },
                                title: {
                                    display: true,
                                    text: 'Graphique des Marchandises'
                                }
                            }
                        }
                    });
                    document.getElementById('itemChartContainer').style.display = 'block';
                }
            });
        </script>
    </x-nav-bar>
</body>
</html>
