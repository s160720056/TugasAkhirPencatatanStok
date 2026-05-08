<?php

namespace App\Mail;

use App\Models\Pengaturan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class SendEmailReset extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($email,$pin)
    {
        $this->data = [
            'email' => $email,
            'pin' => $pin
        ];
    }
   

    /**
     * Build the message.
     */
    public function build()
    {

        return $this->from('xtrac8996@gmail.com', 'TAPenjualan')
                    ->subject('Reset Password')
                    ->view('page.emails.sendmailReset')
                    ->with('data', $this->data);
    }
    

}
