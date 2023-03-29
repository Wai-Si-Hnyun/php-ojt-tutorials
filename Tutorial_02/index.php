<?php

/**
 * Function generate diamond shape
 *
 * @param integer $row number of rows for diamond pattern
 * @return void
 */
function makeDiamondShape($row) {
    if (!($row > 0)) {
        echo '$row parameter must be greater than 0.';
    } elseif (!is_int($row)) {
        echo '$row parameter must be number.';
    } elseif ($row % 2 == 0) {
        echo '$row parameter must be odd number.';
    } else {
        //Calculate the number of spaces and stars for each row
        $halfRows = floor($row / 2);
        $spaces = $halfRows;
        $stars = 1;

        //Top half of the diamond
        for ($i = 0; $i < $halfRows; $i++) {
            echo str_repeat('&nbsp;&nbsp;', $spaces) . str_repeat('*', $stars) . '<br>';
            $spaces--;
            $stars += 2;
        }

        //Middle row of the diamond
        echo str_repeat('*', $row) . '<br>';

        //Bottom half of the diamond
        for ($i = 0; $i < $halfRows; $i++) {
            $spaces++;
            $stars -= 2;
            echo str_repeat('&nbsp;&nbsp;', $spaces) . str_repeat('*', $stars) . '<br>';
        }
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Diamond Pattern</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Diamond Pattern</h1>
    <div class="diamond-container">
        <?php makeDiamondShape(11)?>
    </div>
</body>

</html>
