# Laravel project

This is a sample Laravel project that demonstrates the use of the Laravel framework for CRUD process.

## Requirement

- PHP >= 7.3
- Composer
- MySQL
- npm

## Installation

Follow these steps to set up the Laravel project:

1. Clone the repository:

```bash
    git clone https://github.com/Wai-Si-Hnyun/php-ojt-tutorials
    cd php-ojt-tutorials/Assignment_01
```

2. Install the dependencies:

```bash
    composer install
```

3. Install NPM packages:

```bash
    npm install
```

4. Copy the .env.example file to .env:

```bash
    cp .env.example .env
```

5. Set the application key:

```bash
    php artisan key:generate
```

6. Configure the database connection in the .env file:

```php
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=your_database_name
    DB_USERNAME=your_database_user
    DB_PASSWORD=your_database_password
```

7. Run the database migrations

```bash
    php artisan migrate
```

8. Start the development server:

```bash
    php artisan serve
```

## Extra Features

<ul>
    <li>Import CSV to Database</li>
    <li>Export students data from Database to CSV file</li>
</ul>

Now, you should be able to access the Laravel project at http://127.0.0.1:8000.

