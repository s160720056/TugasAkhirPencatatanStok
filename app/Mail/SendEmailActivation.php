<?php

namespace App\Mail;

use App\Models\Pengaturan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class SendEmailActivation extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($email,$pin,$superadmin)
    {
        $this->data = [
            'email' => $email,
            'pin' => $pin,
            'superadmin'=>$superadmin
        ];
    }
   

    /**
     * Build the message.
     */
    public function build()
    {
        
        if ($this->data['superadmin'] == '1') {
            return $this->from('xtrac8996@gmail.com', 'TAPenjualan')
                ->subject('Activation Account')
                ->view('page.emails.sendmailActivationSuperadmin')
                ->with('data', $this->data);
        } else {
            return $this->from('xtrac8996@gmail.com', 'TAPenjualan')
                ->subject('Activation Account')
                ->view('page.emails.sendmailActivation')
                ->with('data', $this->data);
        }
    }
    

}
