<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewPublisherCredentials extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $email;
    public $password;

    public function __construct($name, $email, $password)
    {
        $this->name = $name;
        $this->email = $email;
        $this->password = $password;
    }

    public function build()
    {
        return $this->view('emails.new-publisher-credentials')
                    ->subject('Tus credenciales de acceso');
    }
}