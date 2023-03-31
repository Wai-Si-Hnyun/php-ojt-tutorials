<?php
    $result = "";
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['dateOfBirth'])) {

            $birthDate = $_POST['dateOfBirth'];
            $age = calculateAge($birthDate);

            if ($age == "invalid") {
                $result = "Your date of birth is invalid";
            } else {
                $result = "Your age is {$age[0]} years, {$age[1]} months and {$age[2]} days";
            }
        } else {
            $result = "You need to fill your date of birth";
        }
    }

    /**
     * function to calculate age of user
     *
     * @param string $dateOfBirth date of birth from user input
     * @return mixed Either a string or an array depending on the condition
     */
    function calculateAge($dateOfBirth) {
        $dateOfBirth = new DateTime($dateOfBirth); //user input date
        $today = new DateTime(); //current date

        if ($dateOfBirth > $today) {
            return "invalid";
        }

        $ageYears = $today->format('Y') - $dateOfBirth->format('Y');
        $ageMonths = $today->format('m') - $dateOfBirth->format('m');
        $ageDays = $today->format('d') - $dateOfBirth->format('d');

        //If day of birth is not over yet
        if ($ageDays < 0) {
            $lastMonth = $today->sub(new DateInterval('P1M'));
            $daysInLastMonth = $lastMonth->format('t');
            $ageDays += $daysInLastMonth;
            $ageMonths--;
        }

        //If month of birth is not over yet
        if ($ageMonths < 0) {
            $ageMonths += 12;
            $ageYears--;
        }

        return [$ageYears, $ageMonths, $ageDays];
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Age Calculator</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="libs/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container col-4 mt-5">
        <div class="text-center bg-info p-2 mb-3 rounded text-primary
            <?php echo ($result == '') ? 'collapse' : '' ?> ">
            <?php echo $result; ?>
        </div>
        <div class="card">
            <h1 class="text-center p-3 bg-light">Age Calculator</h1>
            <form action="index.php" class="text-center px-3 py-3" method="POST">
                <label>Date of birth :</label>
                <input type="date" name="dateOfBirth">
                <button type="submit" class="btn btn-primary d-block w-100 mt-5">Calculate</button>
            </form>
        </div>
  </div>
</body>

</html>