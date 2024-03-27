<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $first_name;
    public $last_name;
    public $email;
    public $company;
    public $phone;
    public $job_title;
    public $yours_messenger;

    public function __construct($first_name, $last_name, $email, $company, $phone, $job_title, $yours_messenger)
    {
        $this->first_name = $first_name;
        $this->last_name = $last_name;
        $this->email = $email;
        $this->company = $company;
        $this->phone = $phone;
        $this->job_title = $job_title;
        $this->yours_messenger = $yours_messenger;
    }

    public function build()
    {
        return $this->view('contact');
    }
}
