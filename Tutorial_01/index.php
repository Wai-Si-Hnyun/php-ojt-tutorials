<?php

/**
 * Function to draw chess borad
 * @param integer $rows number of rows in chess borad
 * @param integer $cols number of columns in chess borad
 * @return void
 */
function drawChessBorad($rows, $cols) {

    if (!is_int($rows) && !is_int($cols)) {
        echo '$rows and $cols parameters must be number.';
    } elseif (!($rows > 0) && !($cols > 0)) {
        echo '$rows and $cols parameters must be greater than 0.';
    } elseif (!is_int($rows) && !($cols > 0)) {
        echo '$rows parameter must be integer number. $cols parameter must be greater than 0.';
    } elseif (!($rows > 0) && !is_int($cols)) {
        echo '$rows parameter must be greater than 0. $cols parameter must be integer number.';
    } elseif (!is_int($rows)) {
        echo '$rows parameter must be number.';
    } elseif (!is_int($cols)) {
        echo '$cols parameter must be number.';
    } elseif (!($rows > 0)) {
        echo '$rows parameter must be greater than 0.';
    } elseif (!($cols > 0)) {
        echo '$cols parameter must be greater than 0.';
    } else {
        for ($x = 1; $x <= $rows; $x++) {
            echo "<tr>";
            for ($y = 1; $y <= $cols; $y++) {
                $colorClass = ($x + $y) % 2 == 0 ? 'white' : 'black';
                echo "<td class='{$colorClass}'></td>";
            }
            echo "</tr>";
        }
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>ChessBoard</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <h1>Chessboard</h1>
    <div class="chess-container">
        <table>
            <?php drawChessBorad(8, 8);?>
        </table>
    </div>
</body>

</html>
