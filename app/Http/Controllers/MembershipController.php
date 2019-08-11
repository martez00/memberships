<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMembershipRequest;
use App\Http\Requests\UpdateMembershipRequest;
use App\Membership;
use App\MembershipType;
use App\UserMembership;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::orderBy('id', 'desc')->paginate(10);
        return view('admin.memberships.index')->with('memberships', $memberships);
    }
    public function mainIndex()
    {
        $memberships = Membership::orderBy('id', 'desc')->paginate(10);
        $membershipsTypes = MembershipType::all();
        return view('memberships.index')->with('memberships', $memberships)->with('membershipsTypes', $membershipsTypes);
    }

    public function indexByType($id)
    {
        $membershipByType = Membership::where('type_id', $id)->orderBy('id', 'desc')->paginate(10);
        $membershipsTypes = MembershipType::all();
        return view('memberships.index')->with('memberships', $membershipByType)->with('membershipsTypes', $membershipsTypes);
    }

    public function create()
    {
        $membershipsTypes = MembershipType::pluck('name', 'id');
        $membershipsTypes->prepend('...', '-1');
        return view('admin.memberships.create')->with('membershipsTypes', $membershipsTypes);
    }

    public function store(StoreMembershipRequest $request)
    {
        $membership = new Membership($request->all());
        $membership->save();
        return redirect()->route('memberships.index')->with('success', 'New membership was succesfully created!');
    }

    public function show($id)
    {
        $membership = Membership::find($id);
        return view('admin.memberships.show')->with('membership', $membership);
    }

    public function mainShow($id)
    {
        $membership = Membership::find($id);
        return view('memberships.show')->with('membership', $membership);
    }

    public function edit($id)
    {
        $membership = Membership::find($id);
        $membershipsTypes = MembershipType::pluck('name', 'id');
        $membershipsTypes->prepend('...', '-1');
        return view('admin.memberships.edit')->with('membership', $membership)->with('membershipsTypes', $membershipsTypes);
    }

    public function update(UpdateMembershipRequest $request, $id)
    {
        $membership = Membership::find($id);
        $membership->update($request->all());
        return redirect()->route('memberships.index')->with('success', 'Membership was succesfully edited!');
    }

    public function destroy($id)
    {
        $membership = Membership::find($id);
        $membership->delete();
        return redirect()->route('memberships.index')->with('success', 'Membership was succesfully deleted!');
    }
    public function showSubscribe($id){
        $membership = Membership::find($id);
        return view('memberships.subscribe')->with('membership', $membership);
    }
}
