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
                            <li class="{{ (Route::currentRouteName() == 'admin.dashboard') ? 'active-admin-menu' : '' }} list-group-item" style="cursor:pointer">
                                <a style="text-decoration: none; color: inherit;" href="{{ route('admin.dashboard') }}">
                                    {{ __('Admin Dashboard') }}
                                </a>
                            </li>
                            <li class="{{ (Route::currentRouteName() == 'memberships_types.index') ? 'active-admin-menu' : '' }} list-group-item" style="cursor:pointer">
                                <a style="text-decoration: none; color: inherit;" href="{{ route('memberships_types.index') }}">
                                    {{ __('Memberships Types') }}
                                </a>
                            </li>
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
                    @yield('admin_content')
                </div>
            </div>
        </div>
    </div>
@endsection