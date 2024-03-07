<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function submit(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required',
        ]);

        // Send the email
        Mail::to('getswail@gmail.com')->send(new ContactFormMail($validatedData));

        // Redirect the user or show a success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
