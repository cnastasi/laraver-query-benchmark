<?php

namespace App\Console\Commands;

use App\User;

class Eloquent2Benchmark extends BenchmarkCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'benchmark:eloquent2 {samples}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eloquent (new just once)';

    protected function executeTest($samples)
    {
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
    }

    /**
     * @return int
     */
    protected function reduction()
    {
        return 3;
    }
}
