<?php
    require_once('../db.php');
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $db = new DB();
        $res = $db->register();
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
                <h1 class="fs-4">Register</h1>
            </div>
            <div class="card-body">
                <form action="register.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" name="name" id="name" placeholder="name" 
                            value="<?php echo $res['old']['name'] ?? '' ?>" 
                            class="form-control 
                            <?php echo empty($res['error']['name']) ? '' : 'is-invalid' ?>">
                        <div class="invalid-feedback">
                            <?php echo $res['error']['name'] ?? '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" id="email" placeholder="name@example.com"
                            value="<?php echo $res['old']['email'] ?? '' ?>" 
                            class="form-control
                            <?php echo empty($res['error']['email']) ? '' : 'is-invalid' ?>">
                        <div class="invalid-feedback">
                            <?php echo $res['error']['email'] ?? '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="text" name="phone" id="phone" placeholder="09*********" 
                            value="<?php echo $res['old']['phone'] ?? '' ?>" 
                            class="form-control
                            <?php echo empty($res['error']['phone']) ? '' : 'is-invalid' ?>">
                        <div class="invalid-feedback">
                            <?php echo $res['error']['phone'] ?? '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" placeholder="password"
                            class="form-control
                            <?php echo empty($res['error']['password']) ? '' : 'is-invalid' ?>">
                        <div class="invalid-feedback">
                            <?php echo $res['error']['password'] ?? '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" name="address" id="address"
                            value="<?php echo empty($res['old']['address']) ? '' : $res['old']['address'] ?>" 
                            class="form-control
                            <?php echo empty($res['error']['address']) ? '' : 'is-invalid' ?>">
                        <div class="invalid-feedback">
                            <?php echo $res['error']['address'] ?? '' ?>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mb-3">Register</button>
                    <a href="login.php" class="text-decoration-none d-flex justify-content-center">
                        Already have an account?
                    </a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
<?php else: ?>
    <?php header('Location: /index.php'); ?>
<?php endif; ?>