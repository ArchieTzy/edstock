<!-- Include Chart.js library -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Add Canvas Element for Line Chart -->
<canvas id="usersLineChart" width="400" height="200"></canvas>

<!-- Initialize Line Chart -->
<script>
    // Get usersCount from PHP (assuming it's passed to the view variable $usersCount)
    var usersCount = <?= $usersCount ?>;

    // Get the canvas element and its context
    var usersLineChartCanvas = document.getElementById('usersLineChart').getContext('2d');

    // Define data for the line chart
    var data = {
        labels: ['Users'],
        datasets: [{
            label: 'Actual Users',
            data: [usersCount],
            backgroundColor: 'rgba(102, 179, 255, 0.2)',
            borderColor: 'rgba(102, 179, 255, 1)',
            borderWidth: 1
        }]
    };

    // Line Chart Configuration
    var chartConfig = {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            legend: {
                display: false
            },
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    };

    // Create the line chart
    var usersLineChart = new Chart(usersLineChartCanvas, chartConfig);
</script>