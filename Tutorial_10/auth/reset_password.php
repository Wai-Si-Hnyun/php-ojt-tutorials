<?php
    session_start();

    $email = $_GET['email'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        require_once '../db.php';
        $db = new DB();
        $db->resetPassword();
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
        <form action="/auth/reset_password.php" method="POST" class="card">
            <div class="card-header">
                <h1 class="fs-3">Reset Password</h1>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email"
                        class="form-control" value="<?php echo $email; ?>">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" placeholder="********"
                        id="password" class="form-control
                        <?php echo empty($_SESSION['error']['password']) ? '' : 'is-invalid'; ?>">
                    <div class="invalid-feedback">
                        <?php echo $_SESSION['error']['password']; ?>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="confirm_password" class="form-label">Confirm Password</label>
                    <input type="password" name="confirm_password" placeholder="********" 
                        id="confirm_password" class="form-control
                        <?php echo empty($_SESSION['error']['confirm_password']) 
                            ? '' : 'is-invalid'; ?>">
                    <div class="invalid-feedback">
                        <?php echo $_SESSION['error']['confirm_password']; ?>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" name="reset_password" class="btn btn-primary float-end">
                    Reset Password
                </button>
            </div>
        </div>
    </div>
</body>
</html>

<?php else: ?>
    <?php header('Location: /index.php'); ?>
<?php endif; ?>