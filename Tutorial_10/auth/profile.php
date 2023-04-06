<?php
    session_start();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once('../db.php');
        $db = new DB();
        $res = $db->update();
    }
?>

<?php if (isset($_SESSION['user'])): ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog</title>
    <link rel="stylesheet" href="../css/reset.css">
    <link rel="stylesheet" href="../libs/bootstrap-5.3.0-alpha1-dist/css/bootstrap.min.css">
</head>
<body>
    <header class="bg-light py-2">
        <div class="container d-flex justify-content-between">
            <a href="/index.php" class="text-decoration-none text-dark"><h1 class="fs-3">Home</h1></a>
            <div class="dropdown">
                <?php if (isset($_SESSION['user']['img'])): ?>
                <img src="../images/<?php echo $_SESSION['user']['img']; ?>" alt="user" 
                    class="rounded-circle dropdown-toggle" width="50" height="50" 
                    data-bs-toggle="dropdown" style="cursor: pointer;"
                    aria-expanded="false" id="userProfileDropdown">
                <?php else: ?>
                <img src="../images/user.png" alt="user" class="rounded-circle dropdown-toggle"
                    width="50" height="50" data-bs-toggle="dropdown" style="cursor: pointer;"
                    aria-expanded="false" id="userProfileDropdown">
                <?php endif; ?>
                <div class="dropdown-menu" aria-labelledby="userProfileDropdown">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="/index.php?method=logout">Logout</a>
                </div>
            </div>
        </div>
    </header>
    <div class="container col-6 mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="fs-2">My Profile Setting</h2>
            </div>
            <div class="card-body">
                <form action="profile.php" method="POST" enctype="multipart/form-data">
                    <div class="d-flex mb-3">
                        <?php if (isset($_SESSION['user']['img'])): ?>
                        <img src="../images/<?php echo $_SESSION['user']['img']; ?>" alt="user image" 
                            width="100" height="100" class="rounded-circle border me-4">
                        <?php else: ?>
                        <img src="../images/user.png" alt="user image" width="100" height="100"
                            class="rounded-circle border me-4">
                        <?php endif; ?>
                        <input type="file" name="image" id="image" class="d-none">
                        <button type="button" class="btn h-25 align-self-center 
                            btn-outline-info rounded-5" id="fileUploadBtn">
                            Upload
                        </button>
                    </div>
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" placeholder="name" id="name" 
                            class="form-control 
                                <?php echo empty($res['error']['name']) ? '' : 'is-invalid' ?>" 
                            value="<?php echo $_SESSION['user']['name']; ?>">
                        <div class="invalid-feedback">
                            <?php echo $res['error']['name']; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" placeholder="name@example.com" id="email"
                            class="form-control 
                                <?php echo empty($res['error']['email']) ? '' : 'is-invalid' ?>"
                            value="<?php echo $_SESSION['user']['email']; ?>">
                        <div class="invalid-feedback">
                            <?php echo $res['error']['email']; ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <button class="btn btn-primary float-end">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="../libs/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="../libs/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/script.js"></script>
</body>
</html>
<?php else: ?>
    <?php header('Location: /auth/login.php'); ?>
<?php endif; ?>