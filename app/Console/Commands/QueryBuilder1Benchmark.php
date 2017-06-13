<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Support\Facades\DB;

class QueryBuilder1Benchmark extends BenchmarkCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'benchmark:query_builder1 {samples}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Query Builder (DB::table every iteration)';

    protected function executeTest($samples)
    {
        for ($i = 0; $i < $samples; $i++) {
            $data = $this->getData($i);
            DB::table('users')->insert($data);

            if ($i % 100 === 0 && $i <> 0) {
                $this->warn("Inserted {$i} rows");
            }
        }

        $this->warn("Done");
    }

    /**
     * @return int
     */
    protected function reduction()
    {
        return 3;
    }
}
