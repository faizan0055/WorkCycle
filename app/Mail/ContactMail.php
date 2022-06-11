<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($contactdata)
    {
        $this->contact = $contactdata;
        //dd($this->contact['email']);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        //send mail from request email
        return $this
                    //->from($this->contact['email'])
                    ->subject('Contact Mail')
                    ->view('mail.contact_us')
                    ->with('contact',$this->contact);

//        return $this
//            ->from('bc180407881@vu.edu.pk') // Sender mail
//            ->subject('Contact Mail') // Mail subject
//            ->view('mail.contact_us')
//            ->with('contact',$this->contact);
    }
}
