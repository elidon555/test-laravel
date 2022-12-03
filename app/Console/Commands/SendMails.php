<?php

namespace App\Console\Commands;

use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Console\Command;

class SendMails extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'send:mails';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(): void
    {
        foreach (User::all() as $user){
            $unreadNotifications = $user->unreadnotifications->where('type','App\Notifications\SendMail');
            foreach($unreadNotifications as $notification){
                $data = json_decode($notification->data,true);
                Mail::to($data['email'])->send(new SendMail($data));
            };
            $unreadNotifications->markAsRead();
        };
    }
}
