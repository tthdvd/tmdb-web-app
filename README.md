# TMDB Web App

## About the project

This is a simple web application which show you the top 210 movie according to [The Movie DB](https://themoviedb.org) website.

## Setup

### Install dependencies
For the vendor packages please run the composer install command
```shell
composer install
```
An additional local package - which is located at packages/tthdvd/tmdb - will be installed.

### Frontend
To build the frontend run the following command:
```shell
npm run dev && npm run dev
```
Please notice, sometimes the setup requires run the `npm run dev` command again.

### Sail up!

The easiest experience use [Sail](https://laravel.com/docs/9.x/sail) with docker. Navigate to the root of the project and hit:
```shell
./vendor/bin/sail up
```

## Configure the project's settings 
### .env
If you haven't done already copy the .env.example and generate the app key
```shell
cp .env.example .env && php artisan key:generate
```
You should add the TMDB API key to the .env
```.dotenv
TMDB_API_KEY=
```
### Database

#### Migrate the database
You can simply migrate the database:
```shell
php artisan migrate
```

#### Sync the db
You could run this artisan command for fetch movies from The Movie DB website; 
by default the first 210 of top rated movies will be synchronised. 
```shell
php artisan movie-sync:all
```
### Scheduled task
If you set up cron job for scheduled task, please keep in mind, that the database synchronise will run every day at 02:00.
This you change in Kernel.php:
```php
protected function schedule(Schedule $schedule)
{
     $schedule->command('movie-sync:all')->dailyAt('02:00');
}
```

## Test
For running tests run the following command:
```shell
php artisan test
```

## License

[MIT license](https://opensource.org/licenses/MIT).
