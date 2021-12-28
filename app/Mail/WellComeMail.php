<?php
namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
class WellComeMail extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
                ->from('faizan055ali@gmail.com') // Sender mail
                ->subject('WellCome Mail') // Mail subject
                ->view('mail.message')
                ->with('data',$this->data)  // View file resource/views/mail/index
                ; 
    }
}