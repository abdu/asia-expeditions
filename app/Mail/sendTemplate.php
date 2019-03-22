<?php

namespace App\Mail;

use \App\ProgramTour;
use Illuminate\Http\Request;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;



class sendTemplate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    // public $tour;
    // public function __construct(ProgramTour $programTour)
    // public function __construct(Request $req)
    // {
    //     //
    //     $this->tour = $reqt;
    // }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $req)
    {
        // $programTour = $this->programTour;
        return $this->from('virak@asia-expeditions.com')->view('emails.sendtemplate.sendtemplate')->with(['country' => $req->country]);
    }
}
