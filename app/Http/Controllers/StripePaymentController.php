<?php

namespace App\Http\Controllers;

use App\Membership;
use App\UserMembership;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Stripe;

class StripePaymentController extends Controller
{
    public function stripePost(Request $request, $id)
    {
        $membership = Membership::find($id);
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        Stripe\Charge::create([
            "amount" => $membership->price * 100,
            "currency" => "eur",
            "source" => $request->stripeToken,
            "description" => $membership->description
        ]);

        $userMembership = new UserMembership(
            [
                'user_id' => auth()->user()->id,
                'membership_id' => $membership->id,
                'status' => "ACTIVE",
                'start_date' => Carbon::now(),
                'end_date' => Carbon::now()->addMinutes(5),
            ]
        );
        $userMembership->save();

        return redirect()->route('user.memberships', auth()->user()->id)->with('success', 'Membership was succesfully subscribed!');;
    }
}
