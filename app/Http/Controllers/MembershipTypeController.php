<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMembershipTypeRequest;
use App\Http\Requests\UpdateMembershipTypeRequest;
use App\MembershipType;

class MembershipTypeController extends Controller
{
    public function index()
    {
        $membershipsTypes = MembershipType::orderBy('id', 'desc')->paginate(10);
        return view('admin.memberships.types.index')->with('membershipsTypes', $membershipsTypes);
    }

    public function create()
    {
        return view('admin.memberships.types.create');
    }

    public function store(StoreMembershipTypeRequest $request)
    {
        $validatedData = $request->validated();
        $membershipType = new MembershipType($validatedData);
        $membershipType->save();
        return redirect()->route('memberships_types.index')->with('success', 'New membership type was succesfully created!');
    }

    public function show($id)
    {
        $membershipType = MembershipType::find($id);
        return view('admin.memberships.types.show')->with('membershipType', $membershipType);
    }

    public function edit($id)
    {
        $membershipType = MembershipType::find($id);
        return view('admin.memberships.types.edit')->with('membershipType', $membershipType);
    }

    public function update(UpdateMembershipTypeRequest $request, $id)
    {
        $validatedData = $request->validated();
        $membershipType = MembershipType::find($id);
        $membershipType->update($validatedData);
        return redirect()->route('memberships_types.index')->with('success', 'Membership type was succesfully edited!');
    }

    public function destroy($id)
    {
        $membershipType = MembershipType::find($id);
        $membershipType->delete();
        return redirect()->route('memberships_types.index')->with('success', 'Membership type was succesfully deleted!');
    }
}
