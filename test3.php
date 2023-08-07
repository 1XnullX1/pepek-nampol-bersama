<!DOCTYPE html>
<html>

<head>
    <title>Control Relay</title>
</head>

<body>
    <h1>Control Relay</h1>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <label for="relay">Pilih Relay:</label>
        <select name="relay" id="relay">
            <option value="1">Relay 1</option>
            <option value="2">Relay 2</option>
            <option value="all">Semua Relay</option>
        </select>
        <input type="submit" name="trigger" value="Aktifkan">
        <input type="submit" name="trigger" value="Matikan">
    </form>

    <?php
    // Eksekusi skrip Node.js berdasarkan aksi dari form
    if (isset($_POST['trigger']) && isset($_POST['relay'])) {
        $trigger = $_POST['trigger'];
        $relay = $_POST['relay'];
        $cmd = "node app.js $relay $trigger";
        $output = shell_exec($cmd);
        echo "<p>Status: $output</p>";
    }
    ?>
</body>

</html>