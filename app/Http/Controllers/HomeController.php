<?php

namespace App\Http\Controllers;

use App\Membership;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $memberships = Membership::orderBy('id', 'desc')->limit(3)->get();
        return view('pages.home')->with('memberships', $memberships);
    }

    public function forbidden()
    {
        return view('pages.403');
    }

    public function admin()
    {
        return view('admin.dashboard');
    }

    public function user()
    {
        return view('user.dashboard');
    }
}
