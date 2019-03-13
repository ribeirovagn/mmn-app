<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\BinaryClosureController;


class BinaryClosure extends Command {

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'binary:closure';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fechamento binario';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct() {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {
        $closureController = new BinaryClosureController();
        return $closureController->store();
    }

}
