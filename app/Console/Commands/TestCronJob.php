<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TestCronJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command is used for cron test!';

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
        \Mail::raw('Hi, This is cron mail test!', function($message) {
            $message->to('max@yopmail.com', 'Max Steve')->subject('Cron Testing Mail from '.\Config::get('app.env'));
        });
        $this->info("Email is Sent.");
    }
}
