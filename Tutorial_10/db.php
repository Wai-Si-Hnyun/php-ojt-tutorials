<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once 'vendor/autoload.php';

session_start();

class DB
{
     /**
     * Variable of database connection
     *
     * @var mixed boolean or mysqli object
     */
    protected $connection;

    /**
     * Constructor for database connection
     */
    public function __construct()
    {
        //db connection
        $this->connection = new mysqli('localhost', 'root', 'Aeiou6453!', 'blog');

        if ($this->connection->connect_error) {
            die('Connection failed: ' . $this->connection->connect_error);
        }

    }

    //Getter method for the protected variable
    public function getConnection()
    {
        return $this->connection;
    }

    public function login()
    {
        $response = [];

        //Store the data from POST request
        $email = $_POST['email'];
        $password = $_POST['password'];

        //Store for old values
        $response['old'] = $_POST;

        //Validate the input
        $result = $this->validateInputLogin($email, $password);

        if ($result['status'] == 'success') {

            //Set session variables
            $_SESSION['user'] = $result['user'];
            header('Location: /index.php');
            exit();

        } else {
            $response['error'] = $result['error'];
        }

        return $response;

    }

    /**
     * Function for register user
     *
     * @return array $response Response of the function
     */
    public function register()
    {
        $response = [];

        //Store the data from POST request
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        $address = $_POST['address'];

        //Store for old values
        $response['old'] = $_POST;

        //Validate the input
        $result = $this->validateInputRegister($name, $email, $phone, $password, $address);

        if ($result['status'] == 'success') {
            //Hash the password
            $password = password_hash($password, PASSWORD_BCRYPT);

            //Insert the data into database
            $sql = "INSERT INTO users (name, email, phone, password, address) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('sssss', $name, $email, $phone, $password, $address);
            $stmt->execute();

            if ($stmt->error) {
                die('Error: ' . $stmt->error);
            }

            header('Location: login.php');
            exit();

        } else {
            $response['error'] = $result['error'];
        }

        return $response;
    }

    /**
     * Function to update user data
     *
     * @return array $response Response of the function
     */
    public function update()
    {
        $response = [];

        //Store the data from POST request
        $name = $_POST['name'];
        $email = $_POST['email'];
        $img = $_FILES['image'];

        $userId = $_SESSION['user']['id'];
        
        //Validate the input
        $result = $this->validateInputUpdate($name, $email, $userId);

        if ($result['status'] == 'success') {
            if (!empty($img['name'])) {
                $result = $this->validateImage($img);

                if ($result['status'] == 'success') {

                    //Store in local
                    $imgName = $this->storeImage($img, $userId);
                   
                    //Update the database
                    $sql = "UPDATE users SET name = ?, email = ?, img = ? WHERE id = ?";
                    $stmt = $this->connection->prepare($sql);
                    $stmt->bind_param('sssi', $name, $email, $imgName, $userId);

                } else {
                    $response['error'] = $result['error'];
                    return $response;
                }
            } else {
                //Update the database
                $sql = "UPDATE users SET name = ?, email = ? WHERE id = ?";
                $stmt = $this->connection->prepare($sql);
                $stmt->bind_param('ssi', $name, $email, $userId);
            }

            $stmt->execute();
            $this->updateSessionValues($userId);
            header('Location: /index.php');
        } else {
            $response['error'] = $result['error'];
        }

        return $response;
    }

    /**
     * function to handle forget password
     * 
     * @return array $result Response of the function
     */
    public function forgetPassword()
    {
        $result = [];

        //Store the data from POST request
        $email = $_POST['email'];

        //Validate the input
        $res = $this->validateEmail($email);

        if ($res) {
            $this->sendMail($email);
            $result['status'] = 'success';
        } else {
            $result['error'] = 'Email does not exist';
        }

        return $result;

    }

    /**
     * Function to handle password reset
     * 
     * @return void
     */
    public function resetPassword()
    {
        unset($_SESSION['error']);

        //Store the data from POST request
        $email = $_POST['email'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if (!empty($password) && !empty($confirmPassword)) {
            //Validate the input
            if (strlen($password) < 8) {
                $_SESSION['error']['password'] = 'Password must be at least 8 characters';
                header('Location: /auth/reset_password.php?email=' . $email);
                exit();
            }

            if (strlen($password) > 50) {
                $_SESSION['error']['password'] = 'Password must be less than 50 characters';
                header('Location: /auth/reset_password.php?email=' . $email);
                exit();
            }

            if ($password !== $confirmPassword) {
                $_SESSION['error']['confirm_password'] = 'Password does not match';
                header('Location: /auth/reset_password.php?email=' . $email);
                exit();
            }

            //Store the new password
            $hashValue = password_hash($password, PASSWORD_BCRYPT);

            $sql = "UPDATE users SET password = ? WHERE email = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('ss', $hashValue, $email);
            $stmt->execute();

            if ($stmt->error) {
                die('Error: ' . $stmt->error);
            } else {
                unset($_SESSION['error']);
                header('Location: /auth/login.php');
            }
        } else {
            if (empty($password)) {
                $_SESSION['error']['password'] = 'Password field is required';
            }

            if (empty($confirmPassword)) {
                $_SESSION['error']['confirm_password'] = 'Confirm password field is required';
            }

            header('Location: /auth/reset_password.php?email=' . $email);
        }

    }

    /**
     * Function to store user profile image
     *
     * @param object $image image object 
     * @param int $userId user id
     * @return string $imgName name of the image
     */
    private function storeImage($image, $userId)
    {
        //Check if the user has an image
        $sql = "SELECT img FROM users WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        //Delete the old image
        if ($user['img'] !== null) {
            unlink(__DIR__ . '/images/' . $user['img']);
        }

        //Store the new image
        $imgExt = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));
        $imgName = uniqid() . '.' . $imgExt;
        $imgPath = __DIR__ . '/images/' . $imgName;

        move_uploaded_file($image['tmp_name'], $imgPath);
        return $imgName;
    }

    /**
     * function to validate email
     *
     * @param string $email
     * @param mixed $userId
     * @return boolean
     */
    private function validateEmail($email, $userId = null)
    {
        if ($userId == null) {
            $sql = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('s', $email);
        } else {
            $sql = "SELECT * FROM users WHERE email = ? AND id != ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->bind_param('si', $email, $userId);
        }

        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * function to validate phone number
     *
     * @param string $phone
     * @return boolean
     */
    private function validatePhoneNumber($phone)
    {
        // Regular expression pattern
        $pattern = '/^(\+\d+|\d+)$/';

        // Check if the phone number matches the pattern
        if (preg_match($pattern, $phone)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * function to validate password
     *
     * @param string $password
     * @param string $email
     * @return mixed
     */
    private function checkPasswordEqualOrNot($password, $email)
    {
        $sql = "SELECT * FROM users WHERE email = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param('s', $email);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['password'])) {
            return $user;
        } else {
            return false;
        }
    }

    /**
     * function to validate image
     *
     * @param object $image image object
     * @return array $result
     */
    private function validateImage($image)
    {
        $result = [];
        //Validation for extension type of image
        $allowedImgExt = ['jpg', 'jpeg', 'png'];
        $imgExt = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

        if (!in_array($imgExt, $allowedImgExt)) {
            $result['error']['image'] = 'Image file extension must be jpg, jpeg or png.';
        }

        //Validation for size of image
        if ($image['size'] == 0) {
            $result['error']['image'] = 'Image file size must be less than 2 MB.';
        }

        if (empty($result['error'])) {
            $result['status'] = 'success';
        } else {
            $result['status'] = 'error';
        }

        return $result;
    }

    /**
     * function to validate input fields of register form
     *
     * @param string $name
     * @param string $email
     * @param string $phone
     * @param string $password
     * @param string $address
     * @return array $result
     */
    private function validateInputRegister($name, $email, $phone, $password, $address)
    {
        $result = [];

        //Check required fields
        if (!empty($name) && !empty($email) &&
            !empty($phone) && !empty($password) && !empty($address)) {

            //Check if email already exists
            if ($this->validateEmail($email)) {
                $result['error']['email'] = 'Email already exists';
            }

            //Check if phone is valid
            if (!$this->validatePhoneNumber($phone)) {
                $result['error']['phone'] = 'Phone number is invalid';
            }

            //Check if password is valid
            if (strlen($password) < 8) {
                $result['error']['password'] = 'Password must be at least 8 characters';
            }

            if (strlen($password) > 50) {
                $result['error']['password'] = 'Password must be less than 50 characters';
            }

            //Check if there are no errors
            if (empty($result['error'])) {
                $result['status'] = 'success';
            } else {
                $result['status'] = 'error';
            }

        } else {
            if (empty($name)) {
                $result['error']['name'] = 'Name field is required';
            }

            if (empty($email)) {
                $result['error']['email'] = 'Email field is required';
            }

            if (empty($phone)) {
                $result['error']['phone'] = 'Phone field is required';
            }

            if (empty($password)) {
                $result['error']['password'] = 'Password field is required';
            }

            if (empty($address)) {
                $result['error']['address'] = 'Address field is required';
            }
        }

        return $result;
    }

    /**
     * function to validate input fields of login form
     *
     * @param string $email
     * @param string $password
     * @return array $result
     */
    private function validateInputLogin($email, $password)
    {
        $result = [];

        //Check required fields
        if (!empty($email) && !empty($password)) {

            //Check if email already exists
            if (!$this->validateEmail($email)) {
                $result['error']['email'] = 'Email does not exist';
            }

            //Check if password is valid
            if (!($user = $this->checkPasswordEqualOrNot($password, $email))) {
                $result['error']['password'] = 'Password is invalid';
            }

            //Check if there are no errors
            if (empty($result['error'])) {
                $result['status'] = 'success';
                $result['user'] = $user;
            } else {
                $result['status'] = 'error';
            }

        } else {
            if (empty($email)) {
                $result['error']['email'] = 'Email field is required';
            }

            if (empty($password)) {
                $result['error']['password'] = 'Password field is required';
            }
        }

        return $result;
    }

    /**
     * function to validate input fields of update form
     *
     * @param string $name
     * @param string $email
     * @param int $userId
     * @return array $result
     */
    private function validateInputUpdate($name, $email, $userId)
    {
        $result = [];

        //Check required fields
        if (!empty($name) && !empty($email)){
            //Check if email already exists
            if ($this->validateEmail($email, $userId)) {
                $result['error']['email'] = 'Email already exists';
            }

            //Check if there are no errors
            if (empty($result['error'])) {
                $result['status'] = 'success';
            } else {
                $result['status'] = 'error';
            }
        } else {
            if (empty($name)) {
                $result['error']['name'] = 'Name field is required';
            }

            if (empty($email)) {
                $result['error']['email'] = 'Email field is required';
            }
        }

        return $result;
    }

    /**
     * function to update user data in session
     *
     * @param int $id user id
     * @return void
     */
    private function updateSessionValues($id)
    {
        $sql = "SELECT * FROM users WHERE id = ?";
        $stmt = $this->connection->prepare($sql);
        $stmt->bind_param('i', $id);
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $_SESSION['user'] = $user;
    }

    /**
     * function to send email to user
     *
     * @param string $email
     * @return void
     */
    private function sendMail($email)
    {
        $mail = new PHPMailer(true);
        $resetLink = 'http://localhost:8000/auth/reset_password.php?email=' . $email;

        try {
            // Set mailer to use SMTP
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'waisihnyun07@gmail.com';
            $mail->Password = 'rcebpoorseaynpqi';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            // Set sender and recipient
            $mail->setFrom('blog@example.com', 'Admin');
            $mail->addAddress($email, 'User');

            // Content
            $mail->Subject = 'Password Reset Request';
            $mail->Body    = "Hi,<br><br>We received a request to reset your password. 
                              Please click the link below to reset your password:<br><br>
                              <a href='$resetLink'>Link</a><br><br>
                              If you didn't request a password reset, please ignore this email.<br><br>
                              Regards,<br>Your Website";
            $mail->AltBody = "Hi,\n\nWe received a request to reset your password. 
                              Please copy and paste the link below into your browser 
                              to reset your password:\n\n$resetLink\n\n
                              If you didn't request a password reset, please ignore this email.\n\n
                              Regards,\nYour Website";

            // Send the email
            $mail->send();

        } catch (Exception $e) {
            echo "Failed to send email. Error: {$mail->ErrorInfo}";
        }
    }

}


?>