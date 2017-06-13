<?php

namespace App\Console\Commands;

use App\User;

class Eloquent1Benchmark extends BenchmarkCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'benchmark:eloquent1 {samples}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eloquent (new every iteration)';

    protected function executeTest($samples)
    {
        for ($i = 0; $i < $samples; $i++) {
            $user = new User();

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
    }

    /**
     * @return int
     */
    protected function reduction()
    {
        return 3;
    }
}
