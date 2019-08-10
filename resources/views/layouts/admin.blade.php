@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="content-wrapper">
            <div class="row form-group">
                <div class="col-lg-3">
                    <div class="card">
                        <div class="card-header text-black font-weight-bold">
                            Admin Menu
                        </div>
                        <ul class="list-group list-group-flush">
                            <a style="text-decoration: none; color: inherit;" href="{{ route('admin.dashboard') }}">
                                <li class="{{ (strpos(Route::currentRouteName(), 'admin.dashboard') !== false) ? 'active-admin-menu' : '' }} list-group-item"
                                    style="cursor:pointer">
                                    {{ __('Admin Dashboard') }}
                                </li>
                            </a>
                            <a style="text-decoration: none; color: inherit;"
                               href="{{ route('memberships_types.index') }}">
                                <li class="{{ (strpos(Route::currentRouteName(), 'memberships_types') !== false) ? 'active-admin-menu' : '' }} list-group-item"
                                    style="cursor:pointer">
                                    {{ __('Memberships Types') }}
                                </li>
                            </a>
                            <li class="list-group-item" style="cursor:pointer">
                                Memberships
                            </li>
                            <li class="list-group-item" style="cursor:pointer">
                                Users Memberships
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">
                    @include('inc.messages')
                    @yield('admin_content')
                </div>
            </div>
        </div>
    </div>
@endsection
