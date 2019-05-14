<?php

//namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Http\Request;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }


    public function build(Request $request)
    {
        $customer_name = $request["customer_name"];
        $msg = $request["msg"];
        return $this->view('mail', compact('msg', 'customer_name'))->to($request["to"]);
    }
}
