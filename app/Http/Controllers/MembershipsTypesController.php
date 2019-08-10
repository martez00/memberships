<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMembershipTypeRequest;
use App\Http\Requests\UpdateMembershipTypeRequest;
use App\MembershipsTypes;
use Illuminate\Http\Request;

class MembershipsTypesController extends Controller
{
    public function index()
    {
        $membershipsTypes = MembershipsTypes::orderBy('id', 'desc')->paginate(10);
        return view('admin.memberships.types.index')->with('membershipsTypes', $membershipsTypes);
    }

    public function create()
    {
        return view('admin.memberships.types.create');
    }

    public function store(StoreMembershipTypeRequest $request)
    {
        $validatedData = $request->validated();
        $membershipType = new MembershipsTypes($validatedData);
        $membershipType->save();
        return redirect()->route('memberships_types.index')->with('success', 'New membership type was succesfully created!');
    }

    public function show($id)
    {
        $membershipTypes = MembershipsTypes::find($id);
        return view('admin.memberships.types.show')->with('membershipsTypes', $membershipTypes);
    }

    public function edit($id)
    {
        $membershipsTypes = MembershipsTypes::find($id);
        return view('admin.memberships.types.edit')->with('membershipsTypes', $membershipsTypes);
    }

    public function update(UpdateMembershipTypeRequest $request, $id)
    {
        $validatedData = $request->validated();
        $membershipsTypes = MembershipsTypes::find($id);
        $membershipsTypes->update($validatedData);
        return redirect()->route('memberships_types.index')->with('success', 'Membership type was succesfully edited!');
    }

    public function destroy($id)
    {
        $membershipsTypes = MembershipsTypes::find($id);
        $membershipsTypes->delete();
        return redirect()->route('memberships_types.index')->with('success', 'Membership type was succesfully deleted!');
    }
}
