<?php

namespace App\Console\Commands\Dev;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class Debug extends Command
{

    protected $signature = 'dev:debug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Development debug';
    protected $startId;

    public function handle()
    {
    }
}