<p align="left">
    <img src="public/images/vehicle_api_logo.png" width="128" alt="Product Api Logo">
</p>


# Vehicle Management REST API

### Built using **Laravel 12.10** and **PHP 8.3**

## About

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


## Single Table Inheritance (STI) / Entity-Attribute Separation:

### Due to vehicles are very different (cars, trucks, motorcycles and so on...), multiple tables are justified. Otherwise, for simple projects, one big table could be enough.

- Multiple Tables (vehicles, cars, trucks, etc.)
- More scalable for big projects
- Better normalization (no null columns)
- Cleaner, specific structures
- Better separation of concerns

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
git clone https://github.com/adorjan-szasz/vehicle-api.git

cd vehicle-api
```

### Step 2: Install dependencies

Run the following command to install all the required PHP dependencies:

```bash
composer install
```

### Step 3: Set up the environment file

Copy the .env.example file to .env:

```bash
cp .env.example .env
```

### Step 4: Configure environment settings

In the .env file, configure your database and other settings:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=vehicle_api
DB_USERNAME=
DB_PASSWORD=
```

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

### Fetch a paginated list of vehicles.

#### Query Parameters:

quantity (optional): The number of vehicles to return. Defaults to 15.

page (optional): The page number to fetch. Defaults to 1.

#### Example request:

GET `/api/v1/vehicles?quantity=20&page=1`

#### Response:

```json
{
    "total": 50,
    "per_page": 20,
    "current_page": 1,
    "last_page": 3,
    "first_page_url": "http://localhost/api/v1/vehicles?page=1&quantity=20",
    "last_page_url": "http://localhost/api/v1/vehicles?page=3&quantity=20",
    "next_page_url": "http://localhost/api/v1/vehicles?page=2&quantity=20",
    "prev_page_url": null,
    "path": "http://localhost/api/v1/vehicles",
    "from": 1,
    "to": 20,
    "data": [
        {
            "type": "CAR",
            "make": "Toyota",
            "model": "Corolla",
            "year": 2020,
            "price": 25000,
            "engine": "Petrol",
            "fuel_type": "Gasoline",
            "color": "Red"
        },
        {
            "type": "MOTORCYCLE",
            "make": "Harley-Davidson",
            "model": "Cruiser",
            "year": 2021,
            "price": 15000,
            "engine": "Petrol",
            "fuel_type": "Gasoline",
            "color": "Black"
        },
        // ...
    ]
}
```

### Error Handling

* 400 Bad Request: Returned if required parameters are missing or invalid.

* 404 Not Found: Returned if no vehicles are found for the requested query.

* 500 Internal Server Error: General server error.

### Code Structure

* Controllers: VehicleController handles the main API logic and vehicle generation.

* Models: Vehicle types (Car, Motorcycle, Truck, etc.) are defined in the App\Models directory, with a base Vehicle model.

* Factories: Used for generating random vehicle data.

* Seeders: Populate the database with initial random vehicle data.

* Migrations: Define database structure for the models.

#### Database Migrations

The migrations create the required tables for storing vehicle data, including types, prices, engine details, and other attributes.

### Testing

The project uses PHPUnit for unit and feature testing. You can run the tests with the following command:

```bash
php artisan test
```

The tests cover basic functionality, including data generation, pagination, and error handling.

### License

#### This project is licensed under the MIT License. See the LICENSE file for more information.
