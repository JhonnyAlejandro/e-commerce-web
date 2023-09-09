<?php

namespace App\Http\Controllers;
use App\Mail\ContactanosMailable;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function contact(Request $request)
    {
        $message = array(
            "first_name"    => $request->first_name,
            "last_name"  => $request->last_name,
            "email"  => $request->email,
            "phone" => $request->phone,
            "message" => $request->message,
        );
        Mail::to($request->email)->send(new ContactanosMailable($message));

        return redirect()->back();
    }
}
