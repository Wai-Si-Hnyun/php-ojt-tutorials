<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once '../db.php';
        $db = new DB();
        $res = $db->forgetPassword();
    }
?>

<?php if (!isset($_SESSION['user'])): ?>
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
    <div class="container col-5 mt-5">
        <div class="alert alert-success alert-dismissible fade 
            <?php echo $res['status'] == 'success' ? 'show' : 'collapse'  ?>" role="alert">
            Mail sent successfully! Please check your email.
            <button type="button" class="btn-close" 
                data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <form action="/auth/forget_password.php" method="POST" class="card">
            <div class="card-header">
                <h1 class="fs-3">Forget Password</h1>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" 
                        name="email" placeholder="name@example.com">
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="/auth/login.php" class="text-decoration-none">Login</a>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </div>
        </form>
    </div>
    <script src="../libs/bootstrap-5.3.0-alpha1-dist/js/bootstrap.min.js"></script>
    <script src="../libs/bootstrap-5.3.0-alpha1-dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php else: ?>
    <?php header('Location: /index.php'); ?>
<?php endif; ?>