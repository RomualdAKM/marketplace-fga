<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;
    public $messages = '';
    public $subject = '';
  
    public $name = '';
    public $email = '';
    public $number = '';
    public $shop_name = '';
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($messages,$subject,$name,$email,$number,$shop_name)
    {
        $this->messages = $messages;
        $this->subject = $subject;
       
        $this->name = $name;
        $this->email = $email;
        $this->number = $number;
        $this->shop_name = $shop_name;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Contact Mail '. $this->shop_name,
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            view: 'emails.contact',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
