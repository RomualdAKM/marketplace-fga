<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdminAlertStockProductMail extends Mailable
{
    use Queueable, SerializesModels;

    public $product;
    public $admin;

    public function __construct($product, $admin)
    {
        $this->product = $product;
        $this->admin = $admin;
    }

    public function build()
    {
        return $this->view('emails.admin.alert_stock_product')
                    ->subject('Alerte de Stock')
                    ->with([
                        'product' => $this->product,
                        'admin' => $this->admin,
                    ]);
    }
}
