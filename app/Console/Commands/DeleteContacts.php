<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class DeleteContacts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'DeleteContacts:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'laravel cronjobs to delete all the jobs';

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
       \DB::table('contact_us')
            ->truncate();
    }
}
