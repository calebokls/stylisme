<?php

namespace App\Http\Controllers;

use App\Http\Requests\Contact\ContactRequest;
use App\Mail\ContactMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function contact()
    {
        return view('contact.contact');
    }

    public function sendContact(ContactRequest $request)
    {
        Mail::send(new ContactMail($request->validated()));
        return to_route('index')->with('success','Votre message a été envoyé avec succès');
    }
}
