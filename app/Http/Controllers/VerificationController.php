<?php

namespace App\Http\Controllers;
use App\Mail\MerchantMail;
use Mail;
use Illuminate\Http\Request;

class VerificationController extends Controller
{
    public function sendMail($email, $body)
    {
        $email = '';
        $body='';

        Mail::to($email)->send(new MerchantMail($body));
        return back()->with('status','Mail sent successfully');;
    }
}
