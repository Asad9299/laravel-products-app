# Laravel Products App

A Laravel-based application with authentication, product management, and user management features.

## Features

- **Authentication System** using Laravel Breeze
- **Role-based Access Control** (Admin & User)
- **Product Management Module** (CRUD operations with pagination)
- **User Management** (Admin can view and delete users)

## Roles and Permissions

### Admin
- Manage products (Create, Read, Update, Delete)
- View all users
- Delete users
- Access all product listings

### Regular User
- View products list
- View individual product details

## Installation

1. Clone the repository:
   ```bash
   git clone https://github.com/Asad9299/laravel-products-app.git
   cd laravel-products-app

2. Install dependencies:
   ```bash
   composer install
   npm install

3. Create and configure the .env file:
   ```bash
   cp .env.example .env

4. Generate application key:
   ```bash
   php artisan key:generate

5. Run migrations and seed the database:
   ```bash
   php artisan migrate --seed

6. Compile frontend assets:
   ```bash 
   npm run dev

## Test User

Use the following credentials to log in as an admin user:

- **Email:** `admin@gmail.com`
- **Password:** `12345678`

## Screenshots
![Products List Page](![image](https://github.com/user-attachments/assets/ca312d68-320f-45ac-bc9f-ed8d0b21317c)

(
