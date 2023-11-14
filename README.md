# Laravel 9 API Template
PHP Laravel 9/MySQL

Browser I used: Firefox Developer Edition

## TECH REQUIREMENTS
- Apache httpd-2.4.35
- PHP version - PHP 8.0.30
- MySQL version - MySQL 5.7.24

PHP extension requirements for Laravel 9 (uncomment this extension in php.ini file)
- OpenSSL PHP Extension
- PDO PHP Extension
- Mbstring PHP Extension
- Tokenizer PHP Extension
- XML PHP Extension

## INSTALLATIONS
1. Clone the repository
2. Rename .env.example to .env
3. Configure .env file (API_TOKEN, DATABASE CREDENTIALS and etc.)
4. Create the database
5. Run `php artisan migrate` to generate the tables
6. Run `php artisan serve`
7. Browse `http://127.0.0.1:8000`