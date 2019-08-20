<?php

namespace App\Http\Controllers;

use App\Membership;
use App\StripeSession;
use App\UserMembership;
use http\Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Stripe;

class StripePaymentController extends Controller
{

    public function __construct()
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function createSession(Request $request, $id)
    {
        $membership = Membership::find($id);

        try {
            $session = Stripe\Checkout\Session::create([
                "success_url" => route('memberships.successfulPayment',
                    ['membership_id' => $membership->id, 'user_id' => auth()->user()->id]),
                "cancel_url" => "https://example.com/cancel",
                "payment_method_types" => ["card"],
                "line_items" => [
                    [
                        "name" => $membership->name,
                        "description" => $membership->description,
                        "amount" => $membership->price * 100,
                        "currency" => "eur",
                        "quantity" => 1
                    ]
                ]
            ]);

            $userMembership = new UserMembership(
                [
                    'user_id' => auth()->user()->id,
                    'membership_id' => $membership->id,
                    'status' => "WAITING",
                    'start_date' => null,
                    'end_date' => null,
                ]
            );
            $userMembership->save();

            $stripeSession = new StripeSession(
                [
                    'session_id' => Crypt::encryptString($session->id),
                    'user_membership_id' => $userMembership->id
                ]
            );
            $stripeSession->save();

            $response = $session;
        } catch (Exception $e) {
            $response = $e->getMessage();
        }

        return $response;
    }

    public function successfulPayment($membership_id, $user_id)
    {
        $membership = Membership::find($membership_id);
        return view('memberships.subscribed')->with('membership', $membership);
    }
}
