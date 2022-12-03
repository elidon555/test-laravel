<?php

namespace App\Http\Controllers;

use App\Events\SendEmailEvent;
use App\Models\User;
use App\Notifications\SendMail;
use Illuminate\Http\Request;
use App\Http\Requests\MailFormRequest;
use Notification;

class MailFormController extends Controller
{
    /**
     * Store a new email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(MailFormRequest $request)
    {
        $inputs = $request->validated();
        event(new SendEmailEvent($inputs));
        return response()->json();
    }
}
