<?php

namespace App\Http\Controllers\Auth;

use App\ExtendToken;
use App\Http\Controllers\Controller;
use App\Mail\SendExpiredMail;
use App\UserMembership;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function authenticated(Request $request, $user)
    {
        $userMemberships = UserMembership::where('end_date', '<', date("Y-m-d H:i:s"))->where('status', 'ACTIVE')->where('user_id',  auth()->user()->id)->with('extendTokens')->get();
        foreach($userMemberships as $userMembership){
            $userMembership->status = "EXPIRED";
            $userMembership->save();
            //if membership has a token it means that it was finished earlier, so we can't generate new extend token
            if($userMembership->extendTokens->first()){
                unset($token);
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
