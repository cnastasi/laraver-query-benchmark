# Laravel Query Benchmark
Just a simple benchmark useful to understand which way is better
in order to import millions of records using Laravel.

The benchmark can be executed using several different algorithms

## Installation

    composer install 
    cp .env.example .env`
    
    # change the .env database configuration
    # create the database

    php artisan migrate
    php artisan key:generate

## Tests
| Example   | Description  | 
|-----------|--------------|
| eloquent1 | Base Eloquent usage from the documentation. The model is instantiated every time. |
| eloquent2 | Same as *eloquent1*, except for the model that is instantiated outside the loop, so just one time.
| eloquent3 | Same as *eloquent2*, wrapped inside a single transaction.
| eloquent4 | Same as *eloquent3*, with multiple transactions. |
| eloquent5 | Instead of the basic Eloquent usage, it's used `Model::insert`  |
| query_builder1 | Multiple inserts, one row every insert. No transactions |
| query_builder1 | Multiple inserts, one row every insert. With transactions |
| query_builder3 | Single insert, all rows |
| query_builder4 | Multiple inserts, a block of rows every insert. No transactions |
| query_builder5 | Multiple inserts, a block of rows every insert. With transactions |
## Usage


### The quick and dirty way
```bash
php artisan benchmark:eloquent1 {samples}
```
```bash
php artisan benchmark:eloquent2 {samples}
```
```bash
php artisan benchmark:eloquent3 {samples}
```
```bash
php artisan benchmark:eloquent4 {samples}
```
```bash
php artisan benchmark:eloquent5 {samples} {chunkSize}
```
```bash
php artisan benchmark:query_builder1 {samples}`
```
```bash
php artisan benchmark:query_builder2 {samples}`
```
```bash
php artisan benchmark:query_builder3 {samples}`
```
```bash
php artisan benchmark:query_builder4 {samples} {chunkSize}`
```
```bash
php artisan benchmark:query_builder5 {samples} {chunkSize}` 
```
