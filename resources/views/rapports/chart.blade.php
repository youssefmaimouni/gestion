<x-nav-bar>
    <form action="{{ route('rapports.courbe') }}" method="GET">
        <select name="periode" onchange="this.form.submit()">
            <option value="day" {{ request('periode') == 'day' ? 'selected' : '' }}>Jour</option>
            <option value="month" {{ request('periode') == 'month' ? 'selected' : '' }}>Mois</option>
            <option value="year" {{ request('periode') == 'year' ? 'selected' : '' }}>Année</option>
        </select>
    </form>
    <div class="container mx-auto px-4">
        <canvas id="stockChart"></canvas>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const ctx = document.getElementById('stockChart').getContext('2d');
            const chartData = @json($chartData);

            const labels = chartData.map(data => data.date);
            const data = chartData.map(data => data.quantite);

            const stockChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Cumulative Quantity',
                        data: data,
                        backgroundColor: 'rgba(54, 162, 235, 0.5)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    </script>
</x-nav-bar>
