<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Illuminate\Http\Request;
use App\User;

class CustomerPaid extends Mailable
{
    
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(Request $req)
    {
        return $this->from(User::getUser()->email)
            ->view('emails.customer_paid')
            ->with([
                'name' => User::getUser()->first_name .' '. User::getUser()->middle_name.' '. User::getUser()->last_name,
                'invoice' => $req->vpc_AuthorizeId,
                'phone' => User::getUser()->phone_number,
                'email' => User::getUser()->email,                    
            ]);
    }
}
