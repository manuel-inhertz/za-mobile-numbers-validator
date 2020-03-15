# ZA Mobile Numbers Validator

This application allows to test numbers and to check if they are real South Africa mobile numbers.

# Getting started

## Installation

Please check the official laravel installation guide for server requirements before you start. [Official Documentation](https://laravel.com/docs/5.4/installation#installation)


Clone the repository

    git clone git@github.com:manuel-inhertz/za-mobile-numbers-validator.git

Switch to the repo folder

    cd za-mobile-numbers-validator

Install all the dependencies using composer

    composer install

Copy the example env file and make the required configuration changes in the .env file

    cp .env.example .env

Generate a new application key

    php artisan key:generate

Install front-end dependencies and compile assets (requires NPM)

    npm install && npm run dev

Run the database migrations (**Set the database connection in .env before migrating**)

    php artisan migrate

Start the local development server

    php artisan serve

You can now access the server at http://localhost:8000


To do the test online, just use the file South_African_Mobile_Numbers.csv
> Remember that the csv file must be structured as below
```sh
id,sms_phone
103343262,6478342944
103426540,84528784843
103278808,263716791426

```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
