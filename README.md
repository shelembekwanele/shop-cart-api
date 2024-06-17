# Shopping Cart API

This is a Shopping Cart API built with Laravel. The API provides functionality for user authentication, product management, and shopping cart management.

## Table of Contents

-   [Installation](#installation)
-   [API Endpoints](#api-endpoints)
    -   [Public Routes](#public-routes)
    -   [Protected Routes](#protected-routes)
-   [Authentication](#authentication)
-   [Usage](#usage)

## Installation

1. Clone the repository:

    ```sh
    git clone https://github.com/your-repository/shopping-cart-api.git
    cd shopping-cart-api
    ```

2. Install dependencies:

    ```sh
    composer install
    ```

3. Set up environment variables:

    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

4. Configure your database in the `.env` file.

5. Run migrations:

    ```sh
    php artisan migrate
    ```

6. Start the development server:
    ```sh
    php artisan serve
    ```

## API Endpoints

### Public Routes

-   **User Authentication**

    -   `POST /register`: Register a new user
    -   `POST /login`: Login an existing user

-   **Product Routes**
    -   `GET /products`: Retrieve a list of all products
    -   `GET /products/{id}`: Retrieve a specific product by ID

### Protected Routes

These routes require authentication via Sanctum.

-   **Product Management**

    -   `POST /products`: Create a new product
    -   `PUT /products/{id}`: Update an existing product by ID
    -   `DELETE /products/{id}`: Delete a product by ID

-   **Cart Management**
    -   `GET /cart`: Retrieve the current user's cart
    -   `POST /cart/{id}`: Add a product to the cart by product ID
    -   `DELETE /cart/{id}`: Remove a product from the cart by product ID

## Authentication

This API uses Laravel Sanctum for authentication. To access protected routes, you must include a valid token in the `Authorization` header of your requests.

Example:

```http
Authorization: Bearer your-token-here
```
