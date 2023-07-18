<?php

namespace App\Console\Commands;

use App\Notifications\LikeReviewReply;
use App\PushNotification;
use App\User;
use Illuminate\Console\Command;
use Throwable;

class PushCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:pushnotification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $users = User::all();
        foreach ($users as $user) {
            try {
                $data = ['userName' => 'testy', 'businessName' => 'test'];
                $user->notify(new LikeReviewReply($data));
            } catch (Throwable $e) {
                report($e);
            }
        }
    }
}
