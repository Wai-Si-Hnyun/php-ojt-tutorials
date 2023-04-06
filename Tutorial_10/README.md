# Tutorial 10

## User Authentication And Middleware (Register,Login,Logout,Forget Password,Reset Password,Middleware)
## Table

users
- id (unsigned int, auto increment, primary key)
- name (varchar, length:255)
- email (varchar, length:255 , Not Null, Unique)
- password (varchar, length:255, Not Null)
- phone (varchar, length:255, Not Null)
- img (varchar, length:255, nullable)
- address (text, Not Null)
- created_datetime (timestamp, default value: current timestamp)
- updated_datetime (timestamp, default value: current timestamp)


## Folder Structure
```
.
auth/
├── forget_password.php
├── login.php
├── profile.php
├── register.php
└── reset_password.php
css/
├── reset.css
└── style.css
demo/
└── Tuto_10.png
images/
├── example_01.png
├── example_02.png
└── ...
libs/
create_table.php
db.php
index.php
README.md
```

<hr>

## Register Page Design
![register.png](demo/register.png)

## Login Page Design
![login.png](demo/login.png)

## Forget Password Page Design
![forget_password.png](demo/forget_password.png)

## Reset Password Page Design
![reset_password.png](demo/reset_password.png)

## Home Page Design Without Auth
![home_page_design_with_no_auth.png](demo/home_page_design_with_no_auth.png)

## Home Page Design With Auth
![home_page_design_with_auth.png](demo/home_page_design_with_auth.png)

## Profile Page Design
![profile_page_design.png](demo/profile_page_design.png)

## PHPMailer Setup and Installation

1.Follow these steps to set up and install PHPMailer in your project.

```bash
  composer require phpmailer/phpmailer
```

2.Include PHPMailer in your PHP script:

```php
  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
  require 'vendor/autoload.php';
```
