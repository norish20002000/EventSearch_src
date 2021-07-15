<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\CsvEventBankController;

class CsvEventBankCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:importCsvEventBankPress';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command importCsvEventBankPress';

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
     * @return mixed
     */
    public function handle()
    {
        CsvEventBankController::importCsvEventBankPress();

    }
}
