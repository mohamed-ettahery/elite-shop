<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactFormMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     *
     * @param  array  $data
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    // public function build()
    // {
    //     return $this->subject('New Contact Form Submission')
    //         ->view('emails.contact_form')
    //         ->with([
    //             'name' => $this->data['name'],
    //             'email' => $this->data['email'],
    //             'subject' => $this->data['subject'],
    //             'message' => $this->data['message'],
    //         ]);
    // }
    public function build()
    {
        return $this->subject('New Contact Form Submission')
            ->markdown('emails.contact_form')
            ->with([
                'name' => $this->data['name'],
                'email' => $this->data['email'],
                'subject' => $this->data['subject'],
                'message' => $this->data['message'],
            ]);
    }
}
