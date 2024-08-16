<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        foreach($categories as $category) {
            $tags = $category->tags;
        }
        return view('home.contact-us', compact('categories', 'category', 'tags'));
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
}
