@extends('layouts.app')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/login/form-elements.css') }}">
    <link rel="stylesheet" href="{{ asset('css/login/style.css') }}">
@endsection

@section('app_content')
    @yield('auth_content')
@endsection