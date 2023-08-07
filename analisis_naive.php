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
        <span class="float-right">
            <a class="btn btn-outline-primary" href="analisis_naive.php" target="_blank">Naive</a>
        </span>
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
                include("koneksi.php");
                $no = 1;

                //START DATE
                $start      = $mysqli->query("SELECT * FROM user_log ORDER BY date ASC LIMIT 1");
                $end        = $mysqli->query("SELECT * FROM user_log ORDER BY date DESC LIMIT 1");
                $date_start = $start->fetch_assoc();
                $date_end   = $end->fetch_assoc();

                // Fetch data from the user_log table with pagination
                $result = $mysqli->query("SELECT * FROM user_log");

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $no . "</td>";
                    echo "<td>" . $row['nik'] . "</td>";
                    echo "<td>" . $row['date'] . "</td>";
                    echo "<td>" . $row['time_stamp_in'] . "</td>";
                    echo "<td>" . $row['time_stamp_out'] . "</td>";
                    echo "<td>" . $row['calculation_time'] . "</td>";
                    echo "<td>" . $row['condition'] . "</td>";
                    echo "</tr>";
                    $no++;
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
            </form>
        </div>
        <div class="container mt-4">
            <?php 
                include("koneksi.php");
            $lineConditionArray = [2, 4, 5]; // Condition values for the line chart

            // Contoh data latih (Training Data)
            $trainingData = array(
                array("no_log", "in_time", "out_time", "label"), // Header
                // array(1, "09:00", "18:00", "normal"),
                // array(1, "09:30", "17:30", "normal"),
                // array(1, "10:00", "19:00", "normal"),
                // array(1, "09:15", "18:30", "normal"),
                // array(1, "11:15", "18:30", "anomaly"),
                // array(1, "08:45", "18:15", "normal"),
                // array(1, "10:30", "16:30", "anomaly"),
                // array(1, "09:00", "17:00", "anomaly"),
                // array(1, "08:00", "20:00", "anomaly"),
            );
            // $sql = "SELECT * FROM user_log where user_log.condition in (".implode(",",$lineConditionArray).")";
            $sql = "SELECT * FROM training_user_log where date < '".date('Y-m-d')."'";
            $result = $mysqli->query($sql);
            foreach ($result as $row) {
                if (!in_array($row['condition'], $lineConditionArray)) {
                    $trainingData[] = array($row['no_log'], $row['time_stamp_in'], $row['time_stamp_out'],'Anomali');
                }else{
                    $trainingData[] = array($row['no_log'], $row['time_stamp_in'], $row['time_stamp_out'],'Normal');
                }
                
            }

            $testData = array(
                array("no_log", "in_time", "out_time"), // Header
                // array("Monday", "09:15", "18:30"),
                // array("Tuesday", "09:00", "18:15"),
                // array("Wednesday", "09:30", "18:45"),
                // array("Thursday", "10:00", "18:00"),
            );
            $result = $mysqli->query("SELECT * FROM user_log where date = '".date('Y-m-d')."'");
            foreach ($result as $row) {
                $testData[] = array($row['no_log'], $row['time_stamp_in'], $row['time_stamp_out']);
                
            }
            // Data uji (Test Data)

            // Fungsi untuk menghitung probabilitas kelas
            function calculateClassProbabilities($data) {
                $classCounts = array();
                foreach ($data as $row) {
                    $class = $row[count($row) - 1];
                    if (!isset($classCounts[$class])) {
                        $classCounts[$class] = 0;
                    }
                    $classCounts[$class]++;
                }
                
                $totalRows = count($data);
                $classProbabilities = array();
                foreach ($classCounts as $class => $count) {
                    $classProbabilities[$class] = $count / $totalRows;
                }
                
                return $classProbabilities;
            }

            // Hitung probabilitas kelas dari data latih
            $classProbabilities = calculateClassProbabilities($trainingData);

            // Fungsi untuk menghitung probabilitas fitur diberikan kelas
            function calculateFeatureProbabilities($data, $featureIndex, $class) {
                $featureCounts = array();
                $totalClassInstances = 0;
                
                foreach ($data as $row) {
                    if ($row[count($row) - 1] == $class) {
                        $totalClassInstances++;
                        $featureValue = $row[$featureIndex];
                        if (!isset($featureCounts[$featureValue])) {
                            $featureCounts[$featureValue] = 0;
                        }
                        $featureCounts[$featureValue]++;
                    }
                }
                
                $featureProbabilities = array();
                foreach ($featureCounts as $value => $count) {
                    $featureProbabilities[$value] = $count / $totalClassInstances;
                }
                
                return $featureProbabilities;
            }

            // Prediksi kelas data uji menggunakan Naive Bayes
            $predictedClasses = array();
            foreach ($testData as $row) {
                if ($row[0] !== "no_log") { // Skip header
                    $maxProbability = -1;
                    $predictedClass = "";
                    foreach ($classProbabilities as $class => $classProbability) {
                        $probability = $classProbability;
                        for ($i = 1; $i < count($row) - 1; $i++) {
                            $featureProbabilities = calculateFeatureProbabilities($trainingData, $i, $class);
                            if (isset($featureProbabilities[$row[$i]])) {
                                $probability *= $featureProbabilities[$row[$i]];
                            }
                        }
                        if ($probability > $maxProbability) {
                            $maxProbability = $probability;
                            $predictedClass = $class;
                        }
                    }
                    $predictedClasses[] = $predictedClass;
                }
            }

            // Tampilkan hasil prediksi
            echo "<html><head><title>Hasil Prediksi Anomali Absensi</title></head><body>";
            echo "<h1>Hasil Prediksi Anomali Absensi</h1>";
            echo "<table border='1'><tr><th>Data Test</th><th>NIK</th><th>Prediksi Kelas</th><th>True Condition</th></tr>";
            for ($i = 0; $i < count($testData) - 1; $i++) {
                $data = $mysqli->query("SELECT * FROM user_log where no_log = '".$testData[$i+1][0]."'");
                $result = $data->fetch_array();
                $style = (in_array($result['condition'], $lineConditionArray)) ? ' style="background:#e94335;color:#f1f1f1;" ':'';
                echo '<tr><td>Data Test '.($i + 1).'</td><td title="No Log '.$result['no_log'].'">'.$result['nik'].'</td><td>'.$predictedClasses[$i].'</td><td '.$style.'>'.$result['condition'].'</td></tr>';
            }
            echo "</table></body></html>";

            ?>
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