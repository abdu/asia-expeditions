<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Http\Request;

class RegisterCustomer extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public $tour;

    // public function __construct(ProgramTour $tour)
    // {
    //     //
    //     $this->tour = $tour;
    // }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $request)
    {

        return $this->from(config('app.email'))
                    ->view('emails.registercustomer')
                    ->with([
                        'email' => $request->email,
                        'password' => $request->password
                    ]);
           
        // return $this->view('view.name');
    }
}
