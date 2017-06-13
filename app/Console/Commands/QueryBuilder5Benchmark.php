<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class QueryBuilder5Benchmark extends BenchmarkCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'benchmark:query_builder5 {samples} {chunkSize}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Query Builder (multirow insert w chunks & transactions)';

    protected function executeTest($samples)
    {
        DB::beginTransaction();

        /** @var Builder $query */
        $query = DB::table('users');

        $chunkSize = $this->argument('chunkSize');

        $values = [];

        for ($i = 0; $i < $samples; $i++) {
            if ($i % $chunkSize === 0 && $i !== 0) {
                $values = [];
                $query->insert($values);
                $this->warn(sprintf(' - %d rows inserted', $i));
            }

            $values[] = $this->getData($i);
        }

        $query->insert($values);
        $this->warn(sprintf(' - %d rows inserted', $i));

        DB::commit();
    }

    /**
     * @return int
     */
    protected function reduction()
    {
        return 6;
    }
}
