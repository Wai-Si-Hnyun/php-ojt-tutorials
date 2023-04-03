<?php

    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {

        $folderName = $_POST['folder'];
        $image = $_FILES['image'];

        //Store in session for old value
        $_SESSION['folderName'] = $folderName;

        if (!empty($folderName) && !empty($image['name'])) {

            //Validation for extension type of image
            $allowedImgExt = ['jpg', 'jpeg', 'png'];
            $imgExt = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

            if (!in_array($imgExt, $allowedImgExt)) {
                $_SESSION['errors']['image'] = 'Image file extension must be jpg, jpeg or png.';
                header('Location: index.php');
                exit();
            }

            //Validation for size of image
            if ($image['size'] == 0) {
                $_SESSION['errors']['image'] = 'Image file size must be less than 2 MB.';
                header('Location: index.php');
                exit();
            }

            //Save image to folder
            $folderPath = __DIR__ . '/images/' . $folderName;
            if (!is_dir($folderPath)) {
                mkdir($folderPath);
            }

            $imageName = basename($image['name']);
            $targetFile = $folderPath . '/' . $imageName;

            //If the same image name in same folder exist
            if (file_exists($targetFile)) {
                $_SESSION['errors']['image'] = 'Image file already exists. 
                    Change the name of the image.';
                header('Location: index.php');
                exit();
            }

            if (move_uploaded_file($image['tmp_name'], $targetFile)) {
                $_SESSION['result'] = 'Upload Image Successfully!';
                unset($_SESSION['folderName']);
                header('Location: index.php');
            } else {
                $_SESSION['errors']['image'] = 'Upload Image Failed! Try again.';
                header('Location: index.php');
            }

        } else {
            if (empty($folderName)) {
                $_SESSION['errors']['folder'] = 'folder name field is required.';
            }
            if (empty($image['name'])) {
                $_SESSION['errors']['image'] = 'image name field is required.';
            }
            header('Location: index.php');
        }
    }

?>
