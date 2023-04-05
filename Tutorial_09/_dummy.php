<?php

    require_once('db.php');
    $db = new DB();

    function generateRandomString ($length) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $charsLength = strlen($chars);
        $randomString = "";

        for ($i = 0; $i < $length; $i++) {
            $randomString .= $chars[rand(0, $charsLength - 1)];
        }

        return $randomString;
    }

    function generateRandomDateTime() {
        $startDate = strtotime("2023-01-01");
        $endDate = strtotime("2023-12-31");

        $randomTimeStamp = rand($startDate, $endDate);

        return date("Y-m-d H:i:s", $randomTimeStamp);
    }

    if ($db->checkDataCounts() < 100) {
        for ($i = 0; $i < 100; $i++) {
            $title = generateRandomString(10);
            $content = generateRandomString(500);
            $is_published = rand(0, 1);
            $created_datetime = generateRandomDateTime();
    
            $db->storeAutomatic($title, $content, $is_published, $created_datetime);
        }
    }

?>