<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class QueryBuilder2Benchmark extends BenchmarkCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'benchmark:query_builder2 {samples}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Query Builder (DB::table once)';

    protected function executeTest($samples)
    {
        /** @var Builder $query */
        $query = DB::table('users');
    
        DB::beginTransaction();

        for ($i = 0; $i < $samples; $i++) {
            $data = $this->getData($i);
            $query->insert($data);

            if ($i % 100 === 0 && $i <> 0) {
                $this->warn("Inserted {$i} rows");
            }
        }

        DB::commit();
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
