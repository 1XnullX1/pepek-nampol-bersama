<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Clustering</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Add the necessary libraries for the chart -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- <script src="analisis_process.php"></script> -->
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">ADMIN PANEL</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="newdata.php">Registrasi Admin</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="registrasi_admin.php">Registrasi ID</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cetak_id_admin.php">CETAK ID</a>
                    </li>
                    <a class="nav-link" href="analisis_admin.php">Analisis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <script src="assets/js/bootstrap.min.js"></script>

    <div class="container mt-4">
        <h3>User Log Data</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>NIK</th>
                    <th>Date</th>
                    <th>Time In</th>
                    <th>Time Out</th>
                    <th>Calculation Time</th>
                    <th>Condition</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include database connection file
                include_once("koneksi.php");

                // Number of records per page
                $limit = 10;

                // Get the current page from the URL, default is 1
                $page = isset($_GET['page']) ? $_GET['page'] : 1;

                // Calculate the offset for the query
                $offset = ($page - 1) * $limit;

                // Fetch data from the user_log table with pagination
                $result = $mysqli->query("SELECT * FROM user_log LIMIT $limit OFFSET $offset");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['nik'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['time_stamp_in'] . "</td>";
                    echo "<td>" . $row['time_stamp_out'] . "</td>";
                    echo "<td>" . $row['calculation_time'] . "</td>";
                    echo "<td>" . $row['condition'] . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>



        <!-- Pagination links -->
        <ul class="pagination">
            <?php
            // Count total number of records in the user_log table
            $count_result = $mysqli->query("SELECT COUNT(*) AS total FROM user_log");
            $row_count = $count_result->fetch_assoc();
            $total_records = $row_count['total'];

            // Calculate total number of pages
            $total_pages = ceil($total_records / $limit);

            // Display pagination links
            for ($i = 1; $i <= $total_pages; $i++) {
                echo "<li class='page-item'><a class='page-link' href='?page=" . $i . "'>" . $i . "</a></li>";
            }
            ?>
        </ul>
    </div>

    <!--- awokawokwa --->

    <div class="container mt-4">
        <h3>User Log Data</h3>
        <form method="POST" action="">
            <div class="form-group row">
                <label for="days" class="col-sm-2 col-form-label">Number of Days:</label>
                <div class="col-sm-4">
                    <input type="number" class="form-control" id="days" name="days" min="1" value="30">
                </div>
                <div class="col-sm-6">
                    <button type="submit" class="btn btn-primary">Show Data</button>
                </div>
            </div>
        </form>
        <?php
// Include database connection file
include("koneksi.php");

$days = isset($_POST['days']) ? $_POST['days'] : 30; // Number of days

// Define the mapping array for condition values to string labels
$conditionLabels = array(
    1 => "CONDITION 1",
    2 => "CONDITION 2",
    3 => "CONDITION 3",
    4 => "CONDITION 4",
    5 => "CONDITION 5"
);

$conditionArray = [1, 2, 3, 4, 5]; // Condition values to display

// Calculate the date range
$dateRange = date('Y-m-d', strtotime('-' . $days . ' days')) . " to " . date('Y-m-d');

$dataPoints = array();

foreach ($conditionArray as $condition) {
    // Fetch data from the user_log table within the date range and specific condition value
    $result = $mysqli->query("SELECT COUNT(*) AS count FROM user_log WHERE `condition` = $condition AND date >= '" . date('Y-m-d', strtotime('-' . $days . ' days')) . "'");

    // Check for errors in the query execution
    if (!$result) {
        die("Error: " . $mysqli->error);
    }

    $row = $result->fetch_assoc();

    // Use the mapping array to get the string label for the condition
    $conditionLabel = $conditionLabels[$condition];

    $dataPoints[] = array("label" => $conditionLabel, "y" => $row['count']);
}

// Fetch data for the line chart (conditions 2, 4, and 5)
$lineConditionArray = [2, 4, 5]; // Condition values for the line chart
$lineDataPoints = array();

foreach ($lineConditionArray as $condition) {
    $lineResult = $mysqli->query("SELECT date, COUNT(*) AS count FROM user_log WHERE `condition` = $condition AND date >= '" . date('Y-m-d', strtotime('-' . $days . ' days')) . "' GROUP BY date");
    while ($lineRow = $lineResult->fetch_assoc()) {
        $lineDataPoints[$lineRow['date']] = isset($lineDataPoints[$lineRow['date']]) ? $lineDataPoints[$lineRow['date']] + $lineRow['count'] : $lineRow['count'];
    }
}

?>
        <!-- Bar Chart Container -->
        <div class="container mt-4">
            <h3>User Log Data - Bar Chart</h3>
            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
            <div id="lineChartContainer" style="height: 300px; width: 100%;"></div>
            <script>
            window.onload = function() {
                // Bar Chart
                var dataPoints = <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>;
                var chart = new CanvasJS.Chart("chartContainer", {
                    animationEnabled: true,
                    title: {
                        text: "User Log Data by Condition"
                    },
                    data: [{
                        type: "bar",
                        dataPoints: dataPoints
                    }]
                });
                chart.render();

                // Line Chart
                var lineDataPoints = <?php echo json_encode($lineDataPoints, JSON_NUMERIC_CHECK); ?>;
                var lineChart = new CanvasJS.Chart("lineChartContainer", {
                    animationEnabled: true,
                    title: {
                        text: "Total Data Points with Conditions 2, 4, and 5"
                    },
                    axisX: {
                        title: "Date"
                    },
                    axisY: {
                        title: "Total Data Points",
                        includeZero: false
                    },
                    data: [{
                        type: "line",
                        dataPoints: lineDataPoints
                    }]
                });
                lineChart.render();
            }
            </script>
        </div>
        <hr>




        <!-- Chart Explanation -->
        <div class="mt-4">
            <h3>Chart Explanation</h3>
            <p>Berikut adalah diagram batang yang menunjukkan jumlah titik data untuk setiap kondisi.:</p>
            <ul>
                <?php
                foreach ($conditionArray as $condition) {
                    // Get the string label for the condition
                    $conditionLabel = $conditionLabels[$condition];

                    // Get the total count for the current condition
                    $count = 0;
                    foreach ($dataPoints as $dataPoint) {
                        if ($dataPoint['label'] === $conditionLabel) {
                            $count = $dataPoint['y'];
                            break;
                        }
                    }

                    echo "<li><strong>Condition = \"$condition\"</strong> dengan jumlah $count.</li>";
                }
                ?>
            </ul>
            <p>Condition = “1” adalah durasi waktu masuk area dibawah 12 jam.<br>
                Condition = “2” adalah durasi waktu masuk area diatas 12 jam.<br>
                Condition = “3” adalah belum melakukan tap out. <br>
                Condition = “4” adalah belum melakukan tap out tetapi melakukan tap in kembali dalam waktu rentan 24
                jam. <br>
                Condition = “5” adalah kartu sudah tidak aktif akan tetapi ditap.
            </p>
        </div>

        <!-- <quote>
            <h3>TEST</h3>
            <p>ini adalah penjelasan</p>
        </quote> -->

        <!--asw-->




</body>

</html>