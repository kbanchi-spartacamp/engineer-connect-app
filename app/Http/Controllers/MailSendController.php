<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class MailSendController extends Controller
{
    public function send()
    {
        $to = [
            [
                'email' => 'b.keisuke1111@gmail.com',
                'name' => 'Test',
            ]
        ];
        Mail::to($to)->send(new SendMail());
    }
}
