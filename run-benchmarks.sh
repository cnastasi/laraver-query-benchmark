#!/bin/bash

samples=$1

if [ -z "$samples" ]
  then
    echo "missing samples"
    exit
fi

#START BENCHMARKS
php artisan benchmark:eloquent1 $samples
php artisan benchmark:eloquent2 $samples
php artisan benchmark:eloquent3 $samples
php artisan benchmark:query_builder1 $samples
php artisan benchmark:query_builder2 $samples
php artisan benchmark:query_builder3 $samples
php artisan benchmark:query_builder4 $samples 1000
php artisan benchmark:query_builder5 $samples 1000
