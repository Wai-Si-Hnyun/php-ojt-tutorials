<?php

    require_once('../db.php');
    $db = new DB();

    $data = $db->fetchPostDates();
    $data = $db->processMonthlyData($data);

    //Reformat to show in chart
    $monthlyData = [];

    foreach ($data[0] as $key => $value) {
        $newKey =  $data[1] . '-' . str_pad($key, 2, '0', STR_PAD_LEFT) . '-' . $data[2];
        $monthlyData[$newKey] = $value;
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="../libs/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-3 d-flex justify-content-between">
        <a href="../index.php" class="btn btn-secondary">Back</a>
        <div class="d-flex justify-content-evenly">
            <a href="_weekly.php" class="btn btn-outline-secondary me-2">Weekly</a>
            <a href="_monthly.php" class="btn active btn-outline-secondary me-2">Monthly</a>
            <a href="_yearly.php" class="btn btn-outline-secondary me-2">Yearly</a>
        </div>
    </div>
    <canvas class="mx-auto mt-5" id="myChart" width="900" height="500"></canvas>
    <script src="../libs/chart.js-4.2.1/package/dist/chart.umd.js"></script>
    <script src="../js/script.js"></script>
    <script>
        <?php
            echo "
                const data = " . json_encode($monthlyData) . ";\n
            ";
        ?>

        createMonthlyChart(data);

    </script>
</body>
</html>