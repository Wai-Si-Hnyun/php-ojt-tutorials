<?php

    session_start();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($_POST['name'])) {

            $name = $_POST['name'];

            if (file_exists('images/' . $name . '.png')) {
                $_SESSION['error'] = "QR name already exists";
                header("Location: index.php");
                exit();
            }

            $qr_text = urlencode($_POST['name']);

            //Using Google Chart API
            $qr_url = "https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$qr_text&choe=UTF-8";
            $qr_image = file_get_contents($qr_url);

            //Save in local
            $file_name = $name . ".png";
            $file_path = 'images/' . $file_name;
            
            if (file_put_contents($file_path, $qr_image)) {
                $_SESSION['generatedImg'] = $file_path;
                header('Location: index.php?image=' . $fiel_path);
            } else {
                $_SESSION['error'] = "QR code generation failed";
                header("Location: index.php");
                exit();
            }

        } else {
            $_SESSION['error'] = "QR name field is required";
            header("Location: index.php");
            exit();
        }
    }

?>