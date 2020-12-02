# We are happy
## Installation
1. Copy the `.env.example` file to a file named `.env` and change the environment variables to work with your
environment, this file should be in the root of the project
1. Run the `php artisan key:generate` command to generate an app key
1. Create a database named `we_are_happy`
1. Update the `.env` with your database configuration
1. Run the `php artisan migrate` command to create the required tables in your database
1. The `php artisan db:seed` command will seed the database with users, roles and permissions
1. Use the `php artisan serve` command to start a local development server


## API usage
The API will be reachable at `http://localhost:8000/api`

### Auth
To use the API you should use an API token, this token should be used in the `Authorization` header as a `Bearer` token
```
Authorization: Bearer [PLACE TOKEN HERE]
```
For testing purposes you can use the `MANAGER1_TEST_TOKEN` and `EMPLOYEE_1_TEST_TOKEN` 

### Endpoints:
#### Statistics `[GET] /statistics`
##### Roles
- `Manager`
##### Response
```json
{
    "data": {
        "daily_average": 1.1,
        "weekly_average": 1.36,
        "monthly_average": 0.56
    }
}
```

#### Votes `[POST] /votes`
##### Info
An employee can only vote `once every day` (calculated in the timezone that is set in the .env file)
##### Roles
- `Employee`
##### Request
```json
{
    "mood": 2
}
```
##### Response
```json
{
    "data": {
        "mood": 2
    }
}
```
