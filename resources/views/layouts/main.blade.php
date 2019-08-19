@extends('layouts.app')

@section('app_content')
    <header id="header">
        <div id="topbar">
            <div class="container">
                <div class="social-links">
                    <a href="#" class="twitter"><i class="fa fa-twitter"></i></a>
                    <a href="#" class="facebook"><i class="fa fa-facebook"></i></a>
                    <a href="#" class="linkedin"><i class="fa fa-linkedin"></i></a>
                    <a href="#" class="instagram"><i class="fa fa-instagram"></i></a>
                </div>
            </div>
        </div>

        <div class="container">

            <div class="logo float-left">
                <h1 class="text-light"><a href="{{ url('/') }}"><span>{{ config('app.name', 'pCourses') }}</span></a>
                </h1>
            </div>

            <nav class="main-nav float-right d-none d-lg-block">
                <ul>
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li><a href="#">Courses</a></li>
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