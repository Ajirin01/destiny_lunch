<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNewsletters extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        return $this->data = $data;
    }

    public function build()
    {
        return $this->from("hhoollaaggookkee.space@gmail.com")
                            ->to($this->data['email'])
                            ->subject('Subject: Newsletter')
                            ->view('newsletter.send')
                            ->with('email',$this->data);
    }
}
