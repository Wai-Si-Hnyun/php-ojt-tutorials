<?php

/**
 * CRUD of posts table class
 */
class DB
{
    /**
     * Variable of database connection
     *
     * @var mixed boolean or mysqli
     */
    protected $connection;

    /**
     * Constructor for database connection
     */
    public function __construct()
    {
        $this->connection = mysqli_connect('localhost', 'root', 'root', 'blog');

        if (!$this->connection) {
            die('Connection failed: ' . mysqli_connect_error());
        }
    }

    /**
     * Fetch all data from posts table in database
     *
     * @return array $data all data from posts table
     */
    public function index()
    {
        $sql = "SELECT * FROM posts";
        $stmt = mysqli_query($this->connection, $sql);
        $posts = mysqli_fetch_all($stmt, MYSQLI_ASSOC);

        if (mysqli_error($this->connection)) {
            die('Error: ' . mysqli_error($this->connection));
        }

        return $posts;
    }

    /**
     * Show a single post
     *
     * @param int $id post id
     * @return array $post data of single post
     */
    public function show($id)
    {
        // query to select data from posts table
        $sql = "SELECT * FROM posts WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);

        //MySQL errors handling
        if (mysqli_stmt_error($stmt)) {
            die('Error: ' . mysqli_stmt_error($stmt));
        }

        //Data fetching
        $result = mysqli_stmt_get_result($stmt);
        $post = mysqli_fetch_assoc($result);

        return $post;
    }

    /**
     * Create a new post
     *
     * @return array $response validation errors, old values
     */
    public function store()
    {
        $response = [];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $is_published = isset($_POST['is_published']) ? 1 : 0;

        //Store for old value
        $response['value']['title'] = $title;
        $response['value']['content'] = $content;
        $response['value']['is_published'] = $is_published;

        if (!empty($title) && !empty($content)) {

            $sql = "INSERT INTO posts (title, content, is_published) VALUES (?, ?, ?)";
            $stmt = mysqli_prepare($this->connection, $sql);
            mysqli_stmt_bind_param($stmt, 'ssi', $title, $content, $is_published);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_error($stmt)) {
                die('Error: ' . mysqli_stmt_error($stmt));
            }

            header('Location: index.php');

        } else {
            if (empty($title)) {
                $response['errors']['title'] = 'Title field is required';
            }
            
            if (empty($content)) {
                $response['errors']['content'] = 'Content field is required';
            }
        }

        return $response;
    }

    /**
     * Update a post
     *
     * @return void
     */
    public function update()
    {
        session_start();

        $id = $_POST['id'];
        $title = $_POST['title'];
        $content = $_POST['content'];
        $is_published = isset($_POST['is_published']) ? 1 : 0;

        //Store for old value
        $_SESSION['value']['title'] = $title;
        $_SESSION['value']['content'] = $content;
        $_SESSION['value']['is_published'] = $is_published;

        if (!empty($title) && !empty($content)) {

            $sql = "UPDATE posts SET title = ?, content = ?, is_published = ? WHERE id = ?";
            $stmt = mysqli_prepare($this->connection, $sql);
            mysqli_stmt_bind_param($stmt, 'ssii', $title, $content, $is_published, $id);
            mysqli_stmt_execute($stmt);

            if (mysqli_stmt_error($stmt)) {
                die('Error: ' . mysqli_stmt_error($stmt));
            }

            unset($_SESSION['value']);
            header('Location: index.php');

        } else {
            if (empty($title)) {
                $_SESSION['errors']['title'] = 'Title field is required';
            }
            
            if (empty($content)) {
                $_SESSION['errors']['content'] = 'Content field is required';
            }

            header('Location: edit.php?id=' . $id);
        }
    }

    /**
     * Delete a post
     *
     * @param integer $id post id
     * @return void
     */
    public function delete($id)
    {
        $sql = "DELETE FROM posts WHERE id = ?";
        $stmt = mysqli_prepare($this->connection, $sql);
        mysqli_stmt_bind_param($stmt, 'i', $id);
        mysqli_stmt_execute($stmt);

        if (mysqli_stmt_error($stmt)) {
            die('Error: ' . mysqli_stmt_error($stmt));
        }

        header('Location: index.php');
    }

    /**
     * Date formatting
     *
     * @param string $date timestramp format
     * @return string $formatted_date formatted date
     */
    public function formatDate($date)
    {
        $date_time = new DateTime($date);
        $formatted_date = $date_time->format('M d, Y');

        return $formatted_date;
    }

}

?>