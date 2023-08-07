<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Clustering</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/datatable.css">
</head>

<body class="bg-light">
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#">USER PANEL</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="registrasi.php">Registrasi ID</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="cetak_id.php">CETAK ID</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="analisis.php">Analisis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h3>User Log Data</h3>
        <table class="table table-bordered" id="datatables">
            <thead>
                <tr>
                    <th>No</th>
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
                $no = 0;

                //START DATE
                $start      = $mysqli->query("SELECT * FROM user_log ORDER BY date ASC LIMIT 1");
                $end        = $mysqli->query("SELECT * FROM user_log ORDER BY date DESC LIMIT 1");
                $date_start = $start->fetch_assoc();
                $date_end   = $end->fetch_assoc();

                // Fetch data from the user_log table with pagination
                $result = $mysqli->query("SELECT * FROM user_log");

                while ($row = $result->fetch_assoc()) {
                    $no++;
                    echo "<tr>";
                    echo "<td>".$no."</td>";
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
        <!--- awokawokwa --->

        <hr />

        <div class="container mt-4">
            <!--<h3>User Log Data</h3>-->
            <form method="POST" action="analisis.php">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="from" class="col-sm-2 col-form-label">From</label>
                            <input type="date" class="form-control" id="from" name="from"
                                value="<?php echo $date_start["date"]; ?>" min="<?php echo $date_start["date"]; ?>"
                                max="<?php echo $date_end["date"]; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="to" class="col-sm-2 col-form-label">To</label>
                            <input type="date" class="form-control" id="to" name="to"
                                min="<?php echo $date_start["date"]; ?>" max="<?php echo $date_end["date"]; ?>"
                                value="<?php echo $date_end["date"]; ?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group" style="margin-top: 40px;">
                            <button type="submit" class="btn btn-primary">Show Data</button>
                        </div>
                    </div>
                </div>
        </div>
        </form>
        <?php
// Include database connection file
include("koneksi.php");

//$days = isset($_POST['days']) ? $_POST['days'] : 30; // Number of days

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
//$dateRange = date('Y-m-d', strtotime('-' . $days . ' days')) . " to " . date('Y-m-d');

$dataPoints = array();

foreach ($conditionArray as $condition) {
    // Fetch data from the user_log table within the date range and specific condition value
    if(isset($_POST["from"]) && isset($_POST["to"])){
        $result = $mysqli->query("SELECT COUNT(*) AS count FROM user_log WHERE user_log.condition = '".$condition."' AND date >= '".$_POST['from']."' AND date <= '".$_POST['to']."'");
    }else{
        $result = $mysqli->query("SELECT COUNT(*) AS count FROM user_log WHERE user_log.condition = '".$condition."'");
    }

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
/*
$lineConditionArray = [2, 4, 5]; // Condition values for the line chart
$lineDataPoints = array();

foreach ($lineConditionArray as $condition) {
    if(isset($_POST["from"]) && isset($_POST["to"])){
        $lineResult = $mysqli->query("SELECT date, COUNT(*) AS count FROM user_log WHERE user_log.condition = '".$condition."' AND date >= '".$_POST['from']."' AND date <= '".$_POST['to']."' GROUP BY date");
    }else{
        $lineResult = $mysqli->query("SELECT date, COUNT(*) AS count FROM user_log WHERE user_log.condition = '".$condition."'");
    }
    while ($lineRow = $lineResult->fetch_assoc()) {
        $lineDataPoints[$lineRow['date']] = isset($lineDataPoints[$lineRow['date']]) ? $lineDataPoints[$lineRow['date']] + $lineRow['count'] : $lineRow['count'];
    }
}
*/
?>
        <!-- Bar Chart Container -->
        <div class="container mt-4">
            <h3>User Log Data - Bar Chart</h3>
            <div class="row">
                <div class="col-md-12">
                    <div id="chartContainer" style="height: 300px; width: 100%;"></div>
                </div>
                <?php for($i = 1; $i <= 5; $i++){ ?>
                <div class="col-md-12" style="padding-top: 70px;">
                    <div id="lineChartContainer_<?php echo $i; ?>" style="height: 300px; width: 100%;"></div>
                </div>
                <?php } ?>
            </div>
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
                        type: "column",
                        dataPoints: dataPoints
                    }]
                });
                chart.render();

                <?php
                for($i = 1; $i <= 5; $i++){
                    if(isset($_POST["from"]) && isset($_POST["to"])){
                        $lineResult = $mysqli->query("SELECT date, COUNT(*) AS count FROM user_log WHERE user_log.condition = '".$i."' AND date >= '".$_POST['from']."' AND date <= '".$_POST['to']."' GROUP BY date");
                    }else{
                        $lineResult = $mysqli->query("SELECT date, COUNT(*) AS count FROM user_log WHERE user_log.condition = '".$i."' GROUP BY date");
                    }

                    while ($lineRow = $lineResult->fetch_assoc()) {
                        $dataLine[$i][] = array("label" => $lineRow["date"], "y" => $lineRow['count']);
                    }
                ?>
                // Line Chart
                var lineDataPoints_<?php echo $i; ?> =
                    <?php echo json_encode($dataLine[$i], JSON_NUMERIC_CHECK); ?>;
                var lineChart_<?php echo $i; ?> = new CanvasJS.Chart("lineChartContainer_<?php echo $i; ?>", {
                    animationEnabled: true,
                    title: {
                        text: "Total Data Points with Conditions <?php echo $i; ?>"
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
                        dataPoints: lineDataPoints_<?php echo $i; ?>
                    }]
                });
                lineChart_<?php echo $i; ?>.render();
                <?php } ?>
            }
            </script>
        </div>
        <hr>

        <!-- Chart Explanation -->
        <div class="mt-4">
            <?php
            if(isset($_POST["from"]) && isset($_POST["to"])){
                echo '<p>Data dari tanggal <b>'.date('d F Y', strtotime($_POST['from'])).'</b> sampai <b>'.date('d F Y', strtotime($_POST['to'])).'</b></p>';
            }
            ?>
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

                    if ($condition === 1) {
                        echo "<li><strong>Jumlah pekerja yang bekerja dibawah 12 jam, berjumlah $count.</strong></li>";
                    } else if ($condition === 2) {
                        echo "<li><strong>Jumlah pekerja yang bekerja diatas 12 jam, berjumlah $count.</strong></li>";
                    } else if ($condition === 3) {
                        echo "<li><strong>Jumlah pekerja yang bekerja belum melakukan tap out, ada $count.</strong></li>";
                    } else if ($condition === 4) {
                        echo "<li><strong>Jumlah pekerja yang melakukan tap in lebih dari 1 kali tanpa melakukan penyelesaian tap out, berjumlah $count.</strong></li>";
                    } else if ($condition === 5) {
                        echo "<li><strong>Percobaan tap in dengan kartu sudah tidak aktif, berjumlah $count.</strong></li>";
                    }
                }
                ?>
            </ul>

        </div>

        <!-- <quote>
            <h3>TEST</h3>
            <p>ini adalah penjelasan</p>
        </quote> -->

        <!--asw-->

        <!-- <p>Condition = “1” adalah durasi waktu masuk area dibawah 12 jam.<br>
                Condition = “2” adalah durasi waktu masuk area diatas 12 jam.<br>
                Condition = “3” adalah belum melakukan tap out. <br>
                Condition = “4” adalah belum melakukan tap out tetapi melakukan tap in kembali dalam waktu rentan 24
                jam. <br>
                Condition = “5” adalah kartu sudah tidak aktif akan tetapi ditap.
            </p> -->

        <script src="assets/js/jquery-3.5.1.min.js"></script>
        <script src="assets/js/bootstrap.min.js"></script>
        <!-- Add the necessary libraries for the chart -->
        <!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->
        <!-- <script src="analisis_process.php"></script> -->
        <script src="assets/js/canvas.min.js"></script>
        <script src="assets/js/datatable.js"></script>

        <script>
        $(document).ready(function() {
            $("#datatables").DataTable();
        });
        </script>
</body>

</html>