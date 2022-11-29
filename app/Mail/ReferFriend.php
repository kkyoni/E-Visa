<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ReferFriend extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $send_to;
    public $body;
    public $link;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $send_to, $body, $link)
    {
        $this->subject = $subject;
        $this->send_to = $send_to;
        $this->body = $body;
        $this->link = $link;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('admin@gmail.com')->subject($this->subject)->view('emails.refer_template');
    }

}
