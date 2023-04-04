<?php
    require_once('db.php');
    $db = new DB();
    $post = $db->show($_GET['id']);
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
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h1>Post Detail</h1>
            </div>
            <div class="card-body">
                <h3><?php echo $post['title']; ?></h2>
                <?php if($post['is_published'] == 1): ?>
                    <div class="my-3">
                        <span class="fst-italic me-1">Published at</span>
                        <span><?php echo $db->formatDate($post['created_datetime']) ?></span>
                    </div>
                <?php else: ?>
                    <div class="my-3">Unpublished</div>
                <?php endif; ?>
                <p class="text-black-50"><?php echo $post['content']; ?></p>
                <a href="index.php" class="btn btn-secondary">Back</a>
            </div>
        </div>
    </div>
</body>
</html>