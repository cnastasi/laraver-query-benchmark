<?php
/**
 * Created by PhpStorm.
 * User: christian
 * Date: 6/1/17
 * Time: 4:35 PM
 */

namespace App\Console\Commands;


use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

abstract class BenchmarkCommand extends Command
{
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //        DB::enableQueryLog();

        $samples = $this->argument('samples');

        $this->clearDB();

        $time = microtime(true);

        $this->executeTest($samples);

        $reduction   = $this->reduction();
        $elapsed     = microtime(true) - $time;
        $sampleTime  = ($elapsed / $samples) * pow(10, $reduction);
        $memoryUsage = memory_get_usage() / (1024 * 1024);
        $memoryPeak  = memory_get_peak_usage() / (1024 * 1024);

        $this->info(sprintf
            ("%-60s | %.3f sec | %d samples | %.3f x10^-%d sec/sample | %.2f MB | %.2f MB",
                $this->description,
                $elapsed,
                $samples,
                $sampleTime,
                $reduction,
                $memoryUsage,
                $memoryPeak
            )
        );

        //$queryLog = DB::getQueryLog();

        //dd(array_pop($queryLog));
    }

    protected function getData($i)
    {
        return [
            'name'     => "John Smith #{$i}",
            'email'    => "john.smith{$i}@email.com",
            'password' => "pippo"
        ];
    }

    private function clearDB()
    {
        DB::table('users')->truncate();
    }

    /**
     * @param $samples
     */
    protected abstract function executeTest($samples);

    /**
     * @return int
     */
    protected abstract function reduction();
}