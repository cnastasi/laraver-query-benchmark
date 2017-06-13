# Laravel Query Benchmark

## Installation

- `composer install` 

- `cp .env.example .env`

- change the .app database configuration

- create the database

- `php artisan migrate`

- `php artisan key:generate`

## Usage
`php artisan benchmark:eloquent1 {samples}`

`php artisan benchmark:eloquent2 {samples}`

`php artisan benchmark:eloquent3 {samples}`

`php artisan benchmark:query_builder1 {samples}`

`php artisan benchmark:query_builder2 {samples}`

`php artisan benchmark:query_builder3 {samples}`

`php artisan benchmark:query_builder4 {samples} {chunkSize}`

`php artisan benchmark:query_builder5 {samples} {chunkSize}` 
