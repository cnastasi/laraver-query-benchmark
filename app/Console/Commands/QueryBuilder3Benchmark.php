<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class QueryBuilder3Benchmark extends BenchmarkCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'benchmark:query_builder3 {samples}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Query Builder (multirow insert)';

    protected function executeTest($samples)
    {
        /** @var Builder $query */
        $query = DB::table('users');

        $values = [];
        $start  = microtime(true);

        for ($i = 0; $i < $samples; $i++) {
            $values[] = $this->getData($i);
        }

        $end_preparing = microtime(true) - $start;

        $query->insert($values);

        $end_querying = microtime(true) - $start - $end_preparing;

        $this->warn(sprintf(' - preparation: %.3f sec', $end_preparing));
        $this->warn(sprintf(' - query: %.3f sec', $end_querying));
    }

    /**
     * @return int
     */
    protected function reduction()
    {
        return 6;
    }
}
