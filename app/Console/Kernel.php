<?php

namespace App\Console;

use App\Console\Commands\Eloquent1Benchmark;
use App\Console\Commands\Eloquent2Benchmark;
use App\Console\Commands\Eloquent3Benchmark;
use App\Console\Commands\QueryBuilder1Benchmark;
use App\Console\Commands\QueryBuilder2Benchmark;
use App\Console\Commands\QueryBuilder3Benchmark;
use App\Console\Commands\QueryBuilder4Benchmark;
use App\Console\Commands\QueryBuilder5Benchmark;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        Eloquent1Benchmark::class,
        Eloquent2Benchmark::class,
        Eloquent3Benchmark::class,
        QueryBuilder1Benchmark::class,
        QueryBuilder2Benchmark::class,
        QueryBuilder3Benchmark::class,
        QueryBuilder4Benchmark::class,
        QueryBuilder5Benchmark::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
