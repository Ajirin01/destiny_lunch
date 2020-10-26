<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class sendMeNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        return $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from("hhoollaaggookkee.space@gmail.com")
                            ->to("taiyoo4real@gmail.com")
                            ->subject('Subject: Course Registration request')
                            ->view('email.sendMeNotification')
                            ->with('email',$this->data);
    }
}
