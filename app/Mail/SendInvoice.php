<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendInvoice extends Mailable
{
    use Queueable, SerializesModels;
    private $data;
    private $new_data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$new_data)
    {
        //
        $this->data = $data;
        $this->new_data = $new_data;
        
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
     
        
            $tb = ($this->data['invoice_id']);
        return $this
            ->subject("Thông báo xác nhận đơn hàng :  #7939$tb ")
            ->view('mail.notity_invoice')
            ->with([
                'data' => $this->data,
                'new_data' => $this->new_data,
            ]);
    }
}
