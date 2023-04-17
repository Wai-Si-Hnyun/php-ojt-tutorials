<?php
    require_once('db.php');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $db = new DB();
        $data = $db->store();
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
                <h1>Create Post</h1>
            </div>
            <div class="card-body">
                <form action="create.php" method="POST">
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" id="title"
                            value="<?php echo empty($data['value']['title']) 
                                        ? "" : $data['value']['title'] ?>"
                            class="form-control 
                            <?php echo empty($data['errors']['title']) ? "" : "is-invalid" ?>">
                        <div class="invalid-feedback">
                            <?php echo $data['errors']['title'] ?? '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="content" class="form-label">Content</label>
                        <textarea name="content" id="content" rows="5" cols="8"
                            class="form-control 
                            <?php echo empty($data['errors']['content']) ? "" : "is-invalid" ?>
                        "><?php echo empty($data['value']['content']) 
                                ? "" 
                                : $data['value']['content'] ?></textarea>
                        <div class="invalid-feedback">
                            <?php echo $data['errors']['content'] ?? '' ?>
                        </div>
                    </div>
                    <div class="mb-3">
                        <input type="checkbox" name="is_published" 
                            id="isPublished" class="form-check d-inline-block me-2"
                            <?php echo ($data['value']['is_published'] == 1) ? "checked" : null ?> 
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