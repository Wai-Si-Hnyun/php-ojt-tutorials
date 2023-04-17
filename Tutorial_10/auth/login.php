<?php

    require_once('../db.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $db = new DB();
        $data = $db->login();
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
        <div class="card">
            <div class="card-header">
                <h1 class="fs-4">Login</h1>
            </div>
            <div class="card-body">
                <form action="login.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" 
                            placeholder="name@example.com" class="form-control
                                <?php echo empty($data['error']['email']) ? '' : 'is-invalid'; ?>"
                            value="<?php echo empty($data['old']['email']) ? '' : $data['old']['email']; ?>"
                            >
                        <div class="invalid-feedback">
                            <?php echo $data['error']['email'] ?>
                        </div>
                    </div>
                    <div class="mb-1">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" 
                            placeholder="password" class="form-control
                                <?php echo empty($data['error']['password']) ? '' : 'is-invalid'; ?>"
                            >
                        <div class="invalid-feedback">
                            <?php echo $data['error']['password'] ?>
                        </div>
                    </div>
                    <a href="/auth/forget_password.php" class="text-decoration-none">
                        forget password?
                    </a>
                    <button type="submit" class="btn btn-primary w-100 mt-3">Login</button>
                    <div class="d-flex justify-content-center mt-3">
                        <p>Not a member?</p>
                        <a href="register.php" class="text-decoration-none">Sign Up</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php else: ?>
    <?php header('Location: /index.php'); ?>
<?php endif; ?>