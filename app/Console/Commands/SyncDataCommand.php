<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Services\SyncService;

class SyncDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = '
        app:sync-data
        {--entity=all : all|incomes|orders|sales|stocks}
    ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(SyncService $syncService)
    {
        $syncService->sync($this->option('entity'));
    }
}
