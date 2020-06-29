<?php

namespace App\Console\Commands;

use App\Http\Controllers\MakeController;
use Illuminate\Console\Command;

class getMakesData extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:makes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get Car Makes';

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
     * @return int
     */
    public function handle()
    {
        MakeController::getMakes();
    }
}
