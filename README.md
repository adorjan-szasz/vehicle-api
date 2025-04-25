# Vehicle API

A powerful and scalable API built using **Laravel 12.10** and **PHP 8.3** to manage and provide information on different
types of vehicles. The API includes features such as **pagination**, **dynamic vehicle generation**, 
and **data randomization**.

This project is designed for developers to easily manage and extend vehicle-related data, supporting various types 
such as **Cars**, **Bikes**, **Trucks**, and more. It is perfect for applications requiring vehicle data such as
vehicle dealerships, vehicle management systems, or any application needing dynamic vehicle information.

## Features

- **Dynamic Vehicle Types**: Supports multiple vehicle types (Cars, Bikes, Trucks) with unique attributes for each.
- **Pagination**: Easily manage large datasets with the ability to paginate vehicle data.
- **Optional Attributes**: Randomly generate optional vehicle attributes, such as **engine type**, **fuel type**, etc., 
for more flexible data generation.
- **Data Seeding**: Provides data seeding to generate random vehicle entries for testing and development.
- **Flexible Filters**: Customize the vehicle query parameters such as `quantity`, `page`, etc.
- **Laravel 12.10 & PHP 8.3**: Built with the latest stable versions of Laravel and PHP.

## Installation

Follow these steps to set up the project locally.

### Prerequisites

- **PHP 8.3** or higher
- **Composer** (for managing PHP dependencies)
- **Laravel 12.10** (install via Composer)
- **MySQL** or any database supported by Laravel
- **Node.js** and **npm** (for front-end assets and Laravel Mix)

### Step 1: Clone the repository

Clone the repository to your local machine using Git.

```bash
git clone https://github.com/yourusername/vehicle-api.git

cd vehicle-api
```

### Step 2: Install dependencies

Run the following command to install all the required PHP dependencies:

```bash
composer install
```

Install Node.js dependencies (for front-end assets):

```bash
npm install
```
### Step 3: Set up the environment file

Copy the .env.example file to .env:

```bash
cp .env.example .env
```

### Step 4: Configure environment settings

In the .env file, configure your database and other settings:

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vehicle_api
DB_USERNAME=
DB_PASSWORD=

### Step 5: Generate the application key

Generate the application key using Artisan:

```bash
php artisan key:generate
```

### Step 6: Run migrations and seed data

Run the database migrations to create the necessary tables and seed data:

```bash
php artisan migrate --seed
```

### Step 7: Run the application

Now, you can run the application locally using Laravel's built-in development server:

```bash
php artisan serve
```

By default, the application will be accessible at http://localhost:8000.

## API Documentation

### Endpoint

GET /api/v1/vehicles
