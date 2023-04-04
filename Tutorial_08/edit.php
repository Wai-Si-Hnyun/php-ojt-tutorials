<?php
    session_start();
    require_once('db.php');
    $db = new DB();
    $post = $db->show($_GET['id']);
    
    //get data from session
    $errors['title'] = isset($_SESSION['errors']['title']) ? $_SESSION['errors']['title'] : '';
    $errors['content'] = isset($_SESSION['errors']['content']) ? $_SESSION['errors']['content'] : '';
    $value['title'] = isset($_SESSION['value']['title']) ? $_SESSION['value']['title'] : '';
    $value['content'] = isset($_SESSION['value']['content']) ? $_SESSION['value']['content'] : '';

    //unset the session data
    unset($_SESSION['value']);
    unset($_SESSION['errors']);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $db->update();
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
    <div class="container">
        <div class="card mt-5">
            <div class="card-header">
                <h1>Edit Post</h1>
            </div>
            <div class="card-body">
                <form action="edit.php" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                        <input type="text" name="title" id="title" 
                            placeholder="<?php echo $post['title'] ?>"
                            value="<?php echo empty($value['title']) 
                                    ? "" 
                                    : $value['title'] ?>"
                            class="form-control 
                            <?php echo empty($errors['title']) ? "" : "is-invalid" ?>">
                        <div class="invalid-feedback">
                            <?php echo $errors['title'] ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content" rows="5" cols="8"
                            placeholder="<?php echo $post['content'] ?>"
                            class="form-control 
                            <?php echo empty($errors['content']) ? "" : "is-invalid" ?>"
                            ><?php echo empty($value['content']) 
                                    ? "" 
                                    : $value['content'] ?></textarea>
                        <div class="invalid-feedback">
                            <?php echo $errors['content'] ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" name="is_published"
                            id="isPublished" class="form-check d-inline-block me-2"
                            <?php echo ($post['is_published'] == 1) ? "checked" : null ?>
                        >
                        <span>Publish</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <a href="index.php" class="btn btn-secondary">Back</a>
                        <button type="submit" class="btn btn-primary">Create</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>