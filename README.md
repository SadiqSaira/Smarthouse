#Smart Home App

The core functionality of this full stack application is to allow users to manage their smart homes and the smart devices within.

The app allows users to create multiple _Homes_ and _Rooms_ within each home. Each room then can hold several types of _Devices_: _Speakers_, _Thermostats_, _Alarms_ and _Lights_.

## Architecture and Technologies

The tech stack used for this project:

-   Laravel
-   Inertia
-   Vue
-   PHPUnit
-   MySQL
-   Tailwind

## Approach to Architecture

In order to ensure a clean, modular architecture, we decided to separate the functionality of the application into different layers, each handling individual aspects. We first introduced the _Service_ layer for business logic operations, and then quickly realised we also needed to add a _Repository_ layer for database interactions, thus adding another level of decoupling and ensuring easy maintanance and scalability. This separation of concerns is also useful for unit testing purposes.

## Features:

-   view, edit, add and delete Homes
-   view, edit, add and delete Rooms
-   view, edit, add and delete Devices
-   view device settings

While we haven't finished implementing all the funcitonalities from above, we have completed the basic architecture to do so (added the relevant migrations for all models, accounting for the Polymorphic Relationships between the _Devices_ parent model and the various child models for each _Device Type_)

Currently the Vue front end is completed for the topmost level of the application, the Homes (referred to as Locations within our code). This means users can View, Add, Edit, Delete their Homes in the app.

## Endpoints:

The various endpoints for our application can be viewed in the `web.php` file inside the `routes` directory.

## To spin up the project locally:

1. Make sure to install dependencies run:
   `composer install`
   `npm install`

2. Run: `php artisan key:generate`

3. Rename `.env.example` to `.env`

4. Set up your database in `.env`

```

DB_HOST=localhost
DB_DATABASE=
DB_USERNAME=
DB_PASSWORD=

```

5. Start the back end with:
   `php artisan serve`

6. Start the front end with:
   `npm run dev`

## To run the tests:

`php artisan test` or `./vendor/bin/phpunit tests`
