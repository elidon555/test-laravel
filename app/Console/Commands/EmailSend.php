<?php

namespace App\Console\Commands;

use App\Events\SendEmailEvent;
use App\Mail\SendMail;
use App\Models\User;
use Illuminate\Support\MessageBag;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;

class EmailSend extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:send {email} {text} {date}';

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
    public function handle()
    {
        $inputs = [
            'email'=>$this->argument('email'),
            'email_text'=>$this->argument('text'),
            'date'=>$this->argument('date'),
        ];
        $validator = Validator::make($inputs, [
            'email'=>'required|email',
            'email_text'=>'required',
            'date' => 'required|date_format:Y-m-d'
        ]);
        if ($validator->fails()) {
            dd($validator->messages()->getMessages());
        }
        event(new SendEmailEvent($inputs));
    }
}
