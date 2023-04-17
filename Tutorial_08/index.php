<?php
    require_once('db.php');
    $db = new DB();
    $posts = $db->index();

    if($_SERVER['REQUEST_METHOD'] == 'GET') {
        if (!empty($_GET['id'])) {
            $db->delete($_GET['id']);
        }
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
        <a href="create.php" class="btn btn-primary mt-5 mb-3">Create</a>
        <div class="card rounded">
            <div class="card-header">
                <h1>Post List</h1>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Is Published</th>
                            <th>Created Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($posts): ?>
                            <?php foreach ($posts as $post): ?>
                            <tr>
                                <th scope="row"><?php echo $post['id'] ?></td>
                                <td><?php echo $post['title'] ?></td>
                                <td>
                                    <?php echo (strlen($post['content']) > 30) 
                                    ? substr($post['content'], 0, 30) . '...' 
                                    : $post['content']; ?>
                                </td>
                                <td>
                                    <?php echo ($post['is_published'] == 1) 
                                        ? 'Published' : 'Unpublished' ?>
                                </td>
                                <td>
                                    <?php echo $db->formatDate($post['created_datetime']); ?>
                                </td>
                                <td>
                                    <a href="detail.php?id=<?php echo $post['id'] ?>" 
                                        class="btn btn-primary">View
                                    </a>
                                    <a href="edit.php?id=<?php echo $post['id'] ?>" 
                                        class="btn btn-success">Edit
                                    </a>
                                    <button onclick="deletePost(<?php echo $post['id']; ?>)"
                                        class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="6" class="text-center">No Post</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        function deletePost(id) {
            var result = confirm('Are you sure to delete?');

            if (result) {
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        location.reload();
                    }
                };
                xhttp.open("GET", "index.php?id=" + id, true);
                xhttp.send();
            }
        }
    </script>
</body>

</html>