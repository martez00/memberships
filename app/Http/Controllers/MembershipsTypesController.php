<?php

namespace App\Http\Controllers;

use App\MembershipsTypes;
use Illuminate\Http\Request;

class MembershipsTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $membershipsTypes = MembershipsTypes::orderBy('id', 'desc')->paginate(10);
        return view('admin.memberships.types.index')->with('membershipsTypes', $membershipsTypes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.memberships.types.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\MembershipsTypes  $membershipsTypes
     * @return \Illuminate\Http\Response
     */
    public function show(MembershipsTypes $membershipsTypes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\MembershipsTypes  $membershipsTypes
     * @return \Illuminate\Http\Response
     */
    public function edit(MembershipsTypes $membershipsTypes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\MembershipsTypes  $membershipsTypes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MembershipsTypes $membershipsTypes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\MembershipsTypes  $membershipsTypes
     * @return \Illuminate\Http\Response
     */
    public function destroy(MembershipsTypes $membershipsTypes)
    {
        //
    }
}
