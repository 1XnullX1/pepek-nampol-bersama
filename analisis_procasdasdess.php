<?php
// Include database connection file
require("koneksi.php");

// Fetch data from the user_log table
$sql = "SELECT * FROM user_log";
$result = $mysqli->query($sql);

// Store the data in a PHP array for clustering
$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}
$mysqli->close();

// Step 2: Perform K-Modes Clustering on the data using "php-ml" library

// Make sure you have installed php-ml library through composer
require 'vendor/autoload.php';

use Phpml\Clustering\KMeans;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\Tokenization\WhitespaceTokenizer;

// Prepare the data for clustering (you may need to preprocess it further based on your needs)
$clusteringData = [];
foreach ($data as $entry) {
    $clusteringData[] = [$entry['nik'], $entry['time_stamp_in'], $entry['time_stamp_out'], $entry['calculation_time'], $entry['condition']];
}

// Initialize the KMeans clustering algorithm
$clusterer = new KMeans(3); // You can adjust the number of clusters based on your requirements

// Fit the data to the clusterer
$clusters = $clusterer->cluster($clusteringData); 

// $predictions = $clusterer->predict($clusteringData); 

// Step 3: Categorize conditions as specified
foreach ($data as &$entry) {
    if (in_array($entry['condition'], ['2', '4', '5'])) {
        $entry['condition'] = 'anomaly';
    }
}

// Step 4: Display the clustered data in a table and create a chart to visualize the clusters
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Your existing code for head -->
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <!-- Your existing code for navigation -->
    </nav>

    <div class="container mt-5">
        <h2>Data Clustering</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Time Stamp In</th>
                    <th>Time Stamp Out</th>
                    <th>Calculation Time</th>
                    <th>Condition</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $entry): ?>
                <tr>
                    <td><?= $entry['nik']; ?></td>
                    <td><?= $entry['time_stamp_in']; ?></td>
                    <td><?= $entry['time_stamp_out']; ?></td>
                    <td><?= $entry['calculation_time']; ?></td>
                    <td><?= $entry['condition']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <div>
            <canvas id="clusterChart" width="400" height="200"></canvas>
        </div>

    </div>

    <script>
    // Add the necessary JavaScript code to generate the chart

    var clusters = <?php  echo json_encode($clusters); ?>;
    var ctx = document.getElementById('clusterChart').getContext('2d');
    var clusterColors = ['red', 'green', 'blue', 'yellow']; // Add more colors if needed

    var data = {
        labels: clusters.map((_, index) => 'Cluster ' + (index + 1)),
        datasets: [{
            data: clusters.map(cluster => clusters.filter(c => c === cluster).length),
            backgroundColor: clusters.map((_, index) => clusterColors[index % clusterColors.length]),
            borderWidth: 1
        }]
    };

    var options = {
        legend: {
            display: false
        }
    };

    var clusterChart = new Chart(ctx, {
        type: 'bar',
        data: data,
        options: options
    });
    </script>

</body>

</html>