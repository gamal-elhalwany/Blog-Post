<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('home.contact-us');
    }

    public function sendContactMail(Request $request)
    {
        $contactContent = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'subject' => 'required|min:3',
            'message' => 'required|min:3',
            'phone' => 'required|numeric',
        ]);

        Mail::to('g@all.com')->send(new ContactMail($contactContent));

        return redirect('/contact-us')->with('success', 'Your Email has been Sent Successfully.');
    }

    public function about_us()
    {
        return view('home.about-us');
    }
}
