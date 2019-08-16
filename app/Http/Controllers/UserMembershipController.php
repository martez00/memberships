<?php

namespace App\Http\Controllers;

use App\ExtendToken;
use App\Http\Requests\ExtendUserMembershipRequest;
use App\Http\Requests\UserMembershipsRequest;
use App\UserMembership;
use Carbon\Carbon;

class UserMembershipController extends Controller
{
    public function index(UserMembershipsRequest $request)
    {
        $membershipsStatusArr = UserMembership::statusList;
        $membershipsStatusArr=['all' => ['name'=>'ALL', 'text' => 'All']] + $membershipsStatusArr;

        $query = UserMembership::query();

        $query->when(request()->has('status') && request()->get('status') !== 'ALL', function ($q) {
            $q->where('user_memberships.status', request()->get('status'));
        });

        $query->when(request()->has('expiration_in_minutes') && request()->get('expiration_in_minutes') !== null, function ($q) {
            $q->where('user_memberships.end_date', '<=', Carbon::now()->addMinutes(request()->get('expiration_in_minutes')));
            $q->where('user_memberships.status', 'ACTIVE');
        });

        $query->whereHas('user')->join('users', 'users.id', '=', 'user_memberships.user_id')->when(request()->has('user_name'), function ($q) {
            $q->where('users.name', 'LIKE', '%'.request()->get('user_name').'%');
        });

        $memberships = $query->with('user')->paginate(10);

        return view('admin.memberships.users_memberships.index', compact('memberships', 'membershipsStatusArr'));
    }

    public function userMemberships($id)
    {
        $memberships = UserMembership::where('user_id', $id)->orderBy('end_date', 'DESC')->paginate(10);
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
