# Photo-Gallery REST API Backend
Backend for photo gallery application to create and store photo albums.

I have created a very basic frontend for it in Vue JS. 

## Installation

### Backend

1. Install composer https://getcomposer.org/download/

2. Pull Laravel/php project from git provider.

3. Create a database locally of extension .db

4. Rename .env.example file to .env and fill the database information.
DB_CONNECTION=sqlite
DB_DATABASE=[absolute path of the database]

5. Run ``` composer install ```

6. Run ```php artisan migrate``` to run migrations

7. Run ```php artisan key:generate``` to set application key

8. Run ```php artisan serve``` to run the application

### Frontend

1. Run ```npm install``` for npm dependencies

2. Run ```npm run dev``` to compile JS files

## REST Endpoints
The following REST endpoints are available upon deployment of the photo gallery app:

### User
| HTTP Verb        | URL           | Description  | Status Codes |
| ------------- |-------------|:-----| ----|
| `GET` | `http://localhost:8000/users` | Obtains a list of all the users| <ul><li>`200 OK`</li></ul> |
| `GET` | `http://localhost:8000/user/{id}` | Obtains the user information corresponding to the supplied user ID | <ul><li>`200 OK` if user exists</li><li>`404 Not Found` if user does not exist</li></ul> |
| `POST` | `http://localhost:8000/register` | Creates a new user based on the user information contained in the request body | <ul><li>`201 Created` if user successfully created</li></ul> |
| `PUT` | `http://localhost:8000/users/{id}` | Updates an existing user with the data contained in the request body | <ul><li>`200 OK` if user succesfully updated</li><li>`404 Not Found` if user does not exist</li><li>`403 ` if not permitted</li></ul> |
| `DELETE` | `http://localhost:8000/users/{id}` | Deletes an existing user that corresponds to the supplied user ID | <ul><li>` No Content` if user succesfully deleted</li><li>`404 Not Found` if user does not exist</li><li>`403` if not permitted</li></ul> |



### Album
| HTTP Verb        | URL           | Description  | Status Codes |
| ------------- |-------------|:-----| ----|
| `GET` | `http://localhost:8000/albums` | Obtains a list of all the albums| <ul><li>`200 OK`</li></ul> |
| `GET` | `http://localhost:8000/albums/{id}` | Obtains the album information corresponding to the supplied album ID | <ul><li>`200 OK` if album exists</li><li>`404 Not Found` if album does not exist</li></ul> |
| `POST` | `http://localhost:8000/albums/{id}/` | Creates a new album based on the album information contained in the request body | <ul><li>`201 Created` if user successfully created</li><li>`403` if not permitted</li></ul> |
| `PUT` | `http://localhost:8000/albums/{id}` | Updates an existing album with the data contained in the request body | <ul><li>`200 OK` if album succesfully updated</li><li>`404 Not Found` if album does not exist</li><li>`403 ` if not permitted</li></ul> |
| `DELETE` | `http://localhost:8000/albums/{id}` | Deletes an existing album that corresponds to the supplied album ID | <ul><li>` No Content` if album succesfully deleted</li><li>`404 Not Found` if album does not exist</li><li>`403` if not permitted</li></ul> |

### Photo
| HTTP Verb        | URL           | Description  | Status Codes |
| ------------- |-------------|:-----| ----|
| `GET` | `http://localhost:8000/photos` | Obtains a list of all the photos| <ul><li>`200 OK`</li></ul> |
| `GET` | `http://localhost:8000/photos/{id}` | Obtains the photo information corresponding to the supplied photo ID | <ul><li>`200 OK` if photo exists</li><li>`404 Not Found` if photo does not exist</li></ul> |
| `POST` | `http://localhost:8000/photos/{id}/` | Creates a new photo based on the photo information contained in the request body | <ul><li>`201 Created` if user successfully created</li><li>`403` if not permitted</li></ul> |
| `PUT` | `http://localhost:8000/photos/{id}` | Updates an existing photo with the data contained in the request body | <ul><li>`200 OK` if photo succesfully updated</li><li>`404 Not Found` if photo does not exist</li><li>`403 ` if not permitted</li></ul> |
| `DELETE` | `http://localhost:8000/photos/{id}` | Deletes an existing photo that corresponds to the supplied photo ID | <ul><li>` No Content` if photo succesfully deleted</li><li>`404 Not Found` if photo does not exist</li><li>`403` if not permitted</li></ul> |


