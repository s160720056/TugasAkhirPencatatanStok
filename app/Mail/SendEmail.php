<?php

namespace App\Mail;

use App\Models\Pengaturan;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;



class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    /**
     * Create a new message instance.
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        $id_toko=session()->get('id_toko');
        $toko=Pengaturan::where('id_toko',$id_toko)->first();
        return $this->from('xtrac8996@gmail.com', $toko->nama_toko)
                    ->subject('Testing Kirim Email')
                    ->view('page.emails.sendmail')
                    ->with('data', $this->data);
    }
    

}
