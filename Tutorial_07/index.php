<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title>QR Code Generator</title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="libs/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
    <style>
        h1 {
            font-size: 2rem;
        }
    </style>
</head>
<body>
    <div class="container col-10">
        <div class="col-5 mx-auto my-5">
            <div class="card">
                <h1 class="text-center p-3 bg-light">QR Code Generator</h1>
                <form action="generate.php" class="px-3 py-3" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">QR Name</label>
                        <input type="text" class="form-control
                            <?php echo isset($_SESSION['error']) ? "is-invalid" : ""; ?>"
                            name="name" id="name" placeholder="Enter QR Name">
                        <div class="invalid-feedback">
                            <?php echo $_SESSION['error']; ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Generate</button>
                </form>
            </div>
        </div>
        <div class="col-3 mx-auto <?php echo empty($_SESSION['generatedImg']) ? 'collapse' : '' ?>">
            <img src="<?php echo $_SESSION['generatedImg'] ?>" alt="generated_image" class="border">
        </div>
        <div class="card bg-light my-5 rounded">
            <div class="card-header w-100 mt-0">
                <h2 class="">QR Lists</h2>
            </div>
            <div class="card-body px-4 py-5 row row-cols-3 g-4">
                <?php
                    $dir = 'images/';

                    foreach (glob($dir . "*") as $image) {
                        echo '
                            <div class="col">
                                <div class="card">
                                    <img src="' . $image . '" class="card-img-top" alt="' . $image . '">
                                    <p class="text-center">' .basename( $image) . '</p>
                                </div>
                            </div>
                        ';
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>
<?php
    unset($_SESSION['generatedImg']);
    unset($_SESSION['error']);
?>