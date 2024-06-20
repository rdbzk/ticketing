<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Setup instructions

1. Copy the provided `.env` file to the root of the project

2. Create an SQLite database file in the `database` directory
```bash
touch database/database.sqlite
```

3. Installer Composer dependencies
```bash
composer install
```

4. Run database migrations with seeding
```bash
php artisan migrate:fresh --seed
```

5. Start the localhost server
```bash
php artisan serve
```

# Running the application

This project uses Laravel Sanctum for authentication. **You should first authenticate to the API in order to get an API token**.

Assuming that `http://127.0.0.1:8000` is your localhost domain, on Postman, run a **POST** request to this endpoint:

```bash
http://127.0.0.1:8000/api/login
```

Which will give you an access token:

```json
{
    "access_token": "1|FvX45hbA5WKsMdlpOIS4FWsloztkWfCnglJvd2eE9ec47727"
}
```

Copy this value and use it as a Bearer token in the `Authorization` header of your requests:

```
Accept: application/json
Authorization: Bearer {access_token}
```

## Available endpoints

The API uses a RESTful architecture and has the following endpoints:

### Create a flight reservation

**POST** http://127.0.0.1:8000/api/flights/{flight_id}/flight-reservations

The `flight_id` is the ID of the flight you want to reserve, that you can pick from the `flights` table: `1` or `2`.
You should send a JSON payload with the following structure:

```json
// Any string between 7 and 9 characters
{
    "passenger_passport_id": "A291837189"
}
```

### Delete a flight reservation

**DELETE** http://127.0.0.1:8000/api/flight-reservations/{flight_reservation_id}

The `flight_reservation_id` is the ID of the reservation you want to delete, that you can pick from the response after
creating a flight reservation.
