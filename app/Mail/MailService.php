<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailService extends Mailable
{
    use Queueable, SerializesModels;

    public $emails = [];
    public $model;
    public $subject;
    public $signature;

    public function __construct($emails, $subject, $view, $model, $signature = null)
    {
        $this->emails = $emails;
        $this->subject = $subject;
        $this->view = $view;
        $this->model = $model;
        $this->signature = $signature;
    }

    public function build()
    {
        return $this->subject($this->subject)
                    ->view('mail.'.$this->view, ['model' => $this->model]);
    }

    public function sendMail(){
        // $emails = $this->emails;

        // \Mail::send('mail.'.$this->view, ['model' => $this->model], function($message) use ($emails)
        // {    
        //     $message->to($emails)->subject('This is test e-mail');    
        // });

        \Mail::to($this->emails)->send($this);

        
    }
}
