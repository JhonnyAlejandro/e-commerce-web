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
    public $pdfPath;

    public function __construct($pdfPath)
    {
        $this->pdfPath = $pdfPath;
    }

    public function build()
    {
        return $this->subject('Factura de Compra') // Asunto del correo electrónico
            ->view('modules.sales.tanks') // Nombre de la vista para el correo electrónico
            ->attach($this->pdfPath, [
                'as' => 'factura.pdf', // Nombre del archivo adjunto en el correo
                'mime' => 'application/pdf', // Tipo MIME del archivo adjunto
            ]);
    }
}
