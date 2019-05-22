<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Http\Request;

class ContactUs extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $data;

    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $req)
    {

        return $this->from($req->email)
                    ->view('emails.contactus')
                    ->with(['data' =>'']);
                    // ->with([
                    //     'fullname' => $request->fullname,
                    //     'phone' => $request->phone,
                    //     'email' => $request->email,
                    //     'message' => strip_tags($request->message)
                    // ]);
           
        // return $this->view('view.name');
    }
}
