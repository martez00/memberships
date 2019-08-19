@extends('layouts.app')

@section('app_content')
    <header id="header" class="header-scrolled">
        <div class="container">

            <div class="logo float-left">
                <h1 class="text-light"><a href="{{ url('/') }}"><span>{{ config('app.name', 'pCourses') }}</span></a>
                </h1>
            </div>

            <nav class="main-nav float-right d-none d-lg-block">
                <ul>
                    <li class="{{ (strpos(Route::currentRouteName(), 'home') !== false || Route::currentRouteName() === null) ? 'active-menu' : '' }}"><a href="{{ url('/') }}">Home</a></li>
                    <li class="{{ (strpos(Route::currentRouteName(), 'memberships.mainIndex') !== false) ? 'active-menu' : '' }}"><a href="{{ route('memberships.mainIndex') }}">Courses</a></li>
                    <li><a href="#">Contact Us</a></li>
                    @guest
                        <li>
                            <a role="button" href="{{ route('login') }}">{{ __('Sign in') }}</a>
                        </li>
                    @else
                        <li class="drop-down">
                            <a href="#">{{ Auth::user()->name }}</a>
                            <ul>
                                    @if (Auth::user()->isAdmin())
                                    <li>
                                        <a href="{{ route('admin.dashboard') }}">
                                            {{ __('Admin Dashboard') }}
                                        </a>
                                    </li>
                                    @endif
                                <li>
                                    <a href="{{ route('user.dashboard') }}">
                                        {{ __('User Dashboard') }}
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                          style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </nav>

        </div>
    </header>
    @yield('main_content')
@endsection
