# Library API

This project is a RESTful API for managing a bookstore. It allows users to perform CRUD operations on books, stores, and users. Additionally, it supports associating books with stores and vice versa. The API also provides endpoints for user authentication.

## Features:

### Books API
	- GET    /api/v1/books:                    Retrieve a list of all books.
	- POST   /api/v1/books:                    Create a new book.
	- PUT    /api/v1/books/{id}: 		   Update an existing book.
	- DELETE /api/v1/books/{id}: 		   Delete a book by ID.
	- POST   /api/v1/stores/{id}/attach-books: Attach one or more books to a store.

### Stores API:
	- GET    /api/v1//stores: 		   Retrieve a list of all stores.
	- POST   /api/v1/stores: 		   Create a new store.
	- PUT    /api/v1/stores/{id}: 		   Update an existing store.
	- DELETE /api/v1/stores/{id}: 		   Delete a store by ID.
	- POST   /api/v1/stores/{id}/attach-books: Attach one or more books to a store.

### Users API:
	- GET    /api/v1/users:      Retrieve a list of all users.
	- POST   /api/v1/users:      Create a new user.
	- PUT    /api/v1/users/{id}: Update an existing user.
	- PATCH  /api/v1/users/{id}: Partially update an existing user.
	- DELETE /api/v1/users/{id}: Delete a user by ID.

### Authentication API:
	- POST /api/login:  Authenticate a user and generate a token.
	- POST /api/logout: Revoke the user's token and log them out.

### Testing:

The project includes comprehensive tests for the Books, Stores, and Users APIs. These tests cover various scenarios to ensure the reliability and functionality of the APIs.

To run the tests, execute the following command:

````
php artisan test
````

### Getting Started:
To set up the project locally, follow these steps:

#### Clone the repository:

```
git clone https://github.com/Barrel-R/library.git
```

#### Install dependencies:

```
composer install
```

### Set up your environment variables by copying the .env.example file:

```
cp .env.example .env
```

Update the .env file with your database and other configuration details.

### Generate an application key:

```
php artisan key:generate
```


### Run the database migrations:

```
php artisan migrate
```

### Start the development server:

```
php artisan serve
```


