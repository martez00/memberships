<?php

namespace App\Mail;

use App\UserMembership;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendExpiredMail extends Mailable
{
    use Queueable, SerializesModels;
    public $userMembership;
    public $token;

    /**
     * Create a new message instance.
     *
     * @param UserMembership $userMembership
     * @param $token
     */
    public function __construct(UserMembership $userMembership, $token = null)
    {
        $this->userMembership = $userMembership;
        $this->token = $token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Expired '.$this->userMembership->membership->name.' membership')->view('mails.expired');
    }
}
