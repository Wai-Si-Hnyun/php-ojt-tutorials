<?php

    require_once('create_table.php');
    require_once('db.php');

    $userTable = new CreateTable();
    $userTable->checkAndCreateTable();

    if (isset($_GET['method']) && $_GET['method'] === 'logout') {
        session_destroy();
        header('Location: index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="libs/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-light py-2">
        <div class="container d-flex justify-content-between">
            <a href="/index.php" class="text-decoration-none text-dark"><h1 class="fs-3">Home</h1></a>
            <?php if(!isset($_SESSION['user'])): ?>
            <div>
                <a href="auth/login.php" class="btn btn-primary me-2">Login</a>
                <a href="auth/register.php" class="btn btn-primary">Register</a>
            </div>
            <?php else: ?>
            <div class="dropdown">
                <?php if (isset($_SESSION['user']['img'])): ?>
                <img src="images/<?php echo $_SESSION['user']['img']; ?>" alt="user" 
                    class="rounded-circle border dropdown-toggle" width="50" height="50" 
                    data-bs-toggle="dropdown" style="cursor: pointer;"
                    aria-expanded="false" id="userProfileDropdown">
                <?php else: ?>
                <img src="images/user.png" alt="user" class="rounded-circle border dropdown-toggle" 
                    width="50" height="50" data-bs-toggle="dropdown" style="cursor: pointer;"
                    aria-expanded="false" id="userProfileDropdown">
                <?php endif; ?>
                <div class="dropdown-menu" aria-labelledby="userProfileDropdown">
                    <a class="dropdown-item" href="/auth/profile.php">Profile</a>
                    <a class="dropdown-item" href="index.php?method=logout">Logout</a>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </header>
    <section class="d-flex justify-content-center align-items-center vh-100">
        <h2 class="fs-1">Welcome From My Website</h2>
    </section>
    <script src="libs/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="libs/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
