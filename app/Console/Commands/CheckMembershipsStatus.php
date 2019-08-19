<?php

namespace App\Console\Commands;

use App\ExtendToken;
use App\Mail\SendExpiredMail;
use App\UserMembership;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

class CheckMembershipsStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'membership:status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $userMemberships = UserMembership::where('end_date', '<', date("Y-m-d H:i:s"))->where('status', 'ACTIVE')->with('extendTokens')->get();
        foreach($userMemberships as $userMembership){
            $userMembership->status = "EXPIRED";
            $userMembership->save();
            //if membership has a token it means that it was finished earlier, so we can't generate new extend token
            if($userMembership->extendTokens->first()){
                $token = null;
            }
            else {
                $token = str_random(32) . strtotime("now");
                $extendToken = new ExtendToken(
                    [
                        'token' => $token,
                        'user_membership_id' => $userMembership->id
                    ]
                );
                $extendToken->save();
            }
            Mail::to($userMembership->user->email)->send(new SendExpiredMail($userMembership, $token));
        }
    }
}
