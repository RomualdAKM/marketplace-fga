<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;
    public $pdfContent;
    public $shop;

    public function __construct($order, $pdfContent, $shop)
    {
        $this->order = $order;
        $this->pdfContent = $pdfContent;
        $this->shop = $shop;
    }

    public function build()
    {
        return $this->view('emails.invoice')
                    ->subject('Facture pour votre commande #' . $this->order->id)
                    ->attachData($this->pdfContent, 'facture.pdf', [
                        'mime' => 'application/pdf',
                    ]);
    }
}