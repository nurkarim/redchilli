<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrderNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public function __construct($msg)
    {
        $this->data=$msg;
    }

    
    public function build()
    {
        return $this->subject('Order Submit Successfully')->view('mail.orderSubmit',compact('data'));
    }
}
