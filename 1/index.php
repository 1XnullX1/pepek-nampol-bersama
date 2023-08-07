<!DOCTYPE html>
<html>
<head>
    <title>K-Means Clustering Results</title>
    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <h2>K-Means Clustering Results:</h2>
    <canvas id="clusterChart" width="400" height="200"></canvas>

    <?php
    // Baca file JSON hasil clustering
    $jsonFile = 'clusters.json';
    $data = file_get_contents($jsonFile);
    $clusters = json_decode($data, true)['clusters'];

    // Create arrays to hold the data for the chart
    $labels = array();
    $clusterValues = array();

    // Loop through the clusters
    foreach ($clusters as $index => $cluster) {
        $labels[] = "Data ke-$index";
        $clusterValues[] = $cluster;
    }
    ?>

    <script>
    // Retrieve PHP data and convert it to JavaScript arrays
    var labels = <?php echo json_encode($labels); ?>;
    var clusterValues = <?php echo json_encode($clusterValues); ?>;

    // Create a new Chart instance
    var ctx = document.getElementById('clusterChart').getContext('2d');
    var clusterChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Cluster',
                data: clusterValues,
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1,
                fill: false,
            }]
        },
        options: {
            responsive: false, // Adjust as needed
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
</body>
</html>
