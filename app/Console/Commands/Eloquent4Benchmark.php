<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;

class Eloquent4Benchmark extends BenchmarkCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'benchmark:eloquent4 {samples} {chunkSize}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eloquent (multirow insert w chunks & transactions)';

    protected function executeTest($samples)
    {
        $chunkSize = $this->argument('chunkSize');
        
        DB::beginTransaction();
        
        $user = new User();

        for ($i = 0; $i < $samples; $i++) {
            $data = $this->getData($i);
    
            $user->name     = $data['name'];
            $user->email    = $data['email'];
            $user->password = $data['password'];
    
            $user->save();
            
            if ($i % $chunkSize === 0 && $i !== 0) {
                DB::commit();
                
                $this->warn(sprintf(' - %d rows inserted', $i));
            }
        }

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
