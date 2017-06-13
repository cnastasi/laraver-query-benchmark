<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Support\Facades\DB;

class Eloquent3Benchmark extends BenchmarkCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'benchmark:eloquent3 {samples}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eloquent (inside a transaction)';

    protected function executeTest($samples)
    {
        DB::beginTransaction();

        $user = new User();

        for ($i = 0; $i < $samples; $i++) {
            $data = $this->getData($i);

            $user->name     = $data['name'];
            $user->email    = $data['email'];
            $user->password = $data['password'];

            $user->save();

            if ($i % 100 === 0 && $i <> 0) {
                $this->warn("Inserted {$i} rows");
            }
        }

        $this->warn("Done");

        DB::commit();
    }

    /**
     * @return int
     */
    protected function reduction()
    {
        return 3;
    }
}
