<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryEmail extends Mailable
{
     use Queueable,
        SerializesModels;

    public $subject;
    public $send_to;
    public $body;
    public $country;
    public $phone;
    public $email;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $send_to, $body,$country,$phone,$email,$name)
    {
        $this->subject = $subject;
        $this->send_to = $send_to;
        $this->body = $body;
        $this->country = $country;
        $this->phone = $phone;
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@gmail.com')->subject($this->subject)->view('emails.mail_template');
    }
}
