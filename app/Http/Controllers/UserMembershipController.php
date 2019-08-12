<?php

namespace App\Http\Controllers;

use App\ExtendToken;
use App\Http\Requests\ExtendUserMembershipRequest;
use App\UserMembership;
use Carbon\Carbon;

class UserMembershipController extends Controller
{
    public function index()
    {
        $memberships = UserMembership::orderBy('end_date', 'DESC')->with('user')->paginate(10);
        return view('admin.memberships.users_memberships.index')->with('memberships', $memberships);
    }

    public function userMemberships($id)
    {
        $memberships = UserMembership::where('user_id', $id)->orderBy('end_date', 'DESC')->with('extendToken')->paginate(10);
        return view('user.memberships.index')->with('memberships', $memberships);
    }

    public function showExtend($token)
    {
        $extendToken = ExtendToken::where('token', $token)->where('used', 0)->get();
        if ($extendToken->first())
            return view('memberships.extend')->with('token', $token);
        else return redirect()->route('home')->with('error', 'That extend token does not exist or is expired!');
    }

    public function extend(ExtendUserMembershipRequest $request)
    {
        $validatedData = $request->validated();
        $tokenCheck = ExtendToken::where('token', $validatedData['token'])->get()->first();
        if ($tokenCheck->used == 1) {
            return redirect()->route('home')->with('error', 'That extend token is expired!');
        } else {
            $tokenCheck->used = 1;
            $tokenCheck->save();
            $userMembership = UserMembership::find($tokenCheck->user_membership_id);

            $userMembership->status = "ACTIVE";
            $userMembership->end_date = Carbon::now()->addMinutes(5);
            $userMembership->save();
            return redirect()->route('home')->with('success', 'Your succesfully used your token!');
        }
    }
}
