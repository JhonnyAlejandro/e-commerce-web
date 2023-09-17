<?php

// app/Mail/FacturaEmail.php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class FacturaEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    public $sale;
    public $total_price;
    public $data;

    public function __construct($sale)
    {
        $this->sale = $sale;
    }

    public function build()
    {
        return $this->subject('Factura de Compra') // Asunto del correo electrónico
            ->view('modules.sales.mail_invoice'); // Nombre de la vista para el correo electrónico
    }
}