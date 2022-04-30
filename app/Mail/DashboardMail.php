<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DashboardMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $msg;
    public $url;
     
    public function __construct($msg,$url)
    {
        $this->msg = $msg;
        $this->url = $url;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        return $this->view('mails.mail',)->subject(config('app.name'));
    }
}
