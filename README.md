# Photo-Gallery

### Prerequisites

1. Install composer https://getcomposer.org/download/

2. Pull Laravel/php project from git provider.

3. Create a database locally of extension .db

4. Rename .env.example file to .env and fill the database information.
DB_CONNECTION=sqlite
DB_DATABASE=[absolute path of the database]

5. Run ``` composer install ```

6. Run ```php artisan migrate``` to run migrations

7. Run ```npm install``` for npm dependencies

8. Run ```npm run dev``` to compile JS files

9. Run ```php artisan key:generate``` to set application key

10. Run ```php artisan serve``` to run the application
