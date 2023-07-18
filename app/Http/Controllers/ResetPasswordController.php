<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\MerchantMail;
use Mail;

class ResetPasswordController extends Controller
{
    public function sendMail($email,$token)
    {
        $body='';
        $template='emails.MerchantReset';
        $subject='Password Reset Information';

        $url = url(config('app.url') . route('create.password', [
            'token' => $token,
            'email' => $email,
        ], false));

        $body = [
            'url'=>$url,
        ];

        Mail::to($email)->send(new MerchantMail($body, $template,$subject));
        return back()->with('status','Mail sent successfully');;
    }
}
