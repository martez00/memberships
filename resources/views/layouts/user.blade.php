@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="content-wrapper">
            <div class="row form-group">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header text-black font-weight-bold">
                            User Menu
                        </div>
                        <ul class="list-group list-group-flush">
                            <a style="text-decoration: none; color: inherit;" href="{{ route('user.dashboard') }}">
                                <li class="{{ (strpos(Route::currentRouteName(), 'user.dashboard') !== false) ? 'active-admin-menu' : '' }} list-group-item"
                                    style="cursor:pointer">
                                    {{ __('User Dashboard') }}
                                </li>
                            </a>
                        </ul>
                        <ul class="list-group list-group-flush">
                            <a style="text-decoration: none; color: inherit;" href="{{ route('user.memberships', auth()->user()->id) }}">
                                <li class="{{ (strpos(Route::currentRouteName(), 'user.memberships') !== false) ? 'active-admin-menu' : '' }} list-group-item"
                                    style="cursor:pointer">
                                    {{ __('User memberships history') }}
                                </li>
                            </a>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    @yield('user_content')
                </div>
            </div>
        </div>
    </div>
@endsection
