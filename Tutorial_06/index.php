<?php
    session_start();

    //Delete Image
    if (isset($_GET['image'])) {
        $image = $_GET['image'];
        unlink($image);
        $_SESSION['result'] = 'Delete Image Successfully!';
        header('Location: index.php');
    }

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>Image Upload</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="libs/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <style>
        .card-img {
            overflow: hidden;
            height: 220px;
        }
    </style>
</head>
<body>
    <div class="container col-10">
        <div class="col-5 mx-auto my-5">
            <div class="bg-info p-2 my-3 rounded text-primary
                <?php echo empty($_SESSION['result']) ? 'collapse' : '' ?>">
                <?php echo $_SESSION['result']; ?>
            </div>
            <div class="card">
                <h1 class="text-center p-3 bg-light">Upload Image</h1>
                <form action="upload.php" class="px-3 py-3" method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="folder" class="form-label">Folder Name</label>
                    <input type="text" class="form-control
                    <?php echo isset($_SESSION['errors']['folder']) ? "is-invalid" : ""; ?>"
                    value="<?php echo !empty($_SESSION['folderName']) ? $_SESSION['folderName'] : ""; ?>"
                    name="folder" id="folder">
                    <div class="invalid-feedback">
                        <?php echo $_SESSION['errors']['folder']; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Choose Image</label>
                    <input type="file" name="image" id="image" class="form-control
                    <?php echo isset($_SESSION['errors']['image']) ? "is-invalid" : ""; ?>
                    ">
                    <div class="invalid-feedback">
                        <?php echo $_SESSION['errors']['image']; ?>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100">Upload</button>
                </form>
            </div>
        </div>
        <div class="row row-cols-3 g-4 p-4 bg-light my-5 rounded">
            <?php

                $imgDir = "images";
                $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($imgDir));

                foreach ($iterator as $file) {
                    if (preg_match('/\.(jpg|jpeg|png)$/i', $file->getFilename())) {
                        $imagePath = $file->getPathname();
                        $imageName = $file->getFilename();
                        $imageUrl = $_SERVER['HTTP_HOST'] . '/' . $imagePath;

                        echo '
                            <div class="col">
                                <div class="card h-100 d-flex flex-column">
                                    <img src="' . $imagePath . '" class="card-img card-img-top"
                                        alt="' . $imageName . '">
                                    <div class="card-body d-flex flex-column flex-grow-1">
                                        <h5 class="card-title text-primary">' . $imageName . '</h5>
                                        <p class="card-text text-primary">' . $imageUrl . '</p>
                                        <a href="index.php?image=' . $imagePath . '" 
                                            class="btn btn-danger w-100 mt-auto">Delete</a>
                                    </div>
                                </div>
                            </div>
                        ';
                    }
                }
            ?>
        </div>
        </div>
    </div>
</body>
</html>

<?php
unset($_SESSION['errors']);
unset($_SESSION['result']);
unset($_SESSION['folderName']);
?>
