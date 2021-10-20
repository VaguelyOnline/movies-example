# Usage

1. Clone the repo
2. Create a schema in MySQL for the project
3. Copy .env.example to .env
4. Update .env with: (a) name of your DB schema,  (b) the DB username / password.
5. Open a terminal in the project root directory and run:
```
composer install

npm install

php artisan migrate

php artisan db:seed

php artisan serve
```

Navigate to: http://localhost:8000/movies
