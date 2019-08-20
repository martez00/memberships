@extends('layouts.main')

@section('main_content')
    <section id="intro" class="clearfix">
        <div class="container d-flex h-100">
            <div class="row justify-content-center align-self-center">
                <div class="col-md-6 intro-info order-md-first order-last">
                    <h2>Online programming<br>courses for <span>beginners!</span></h2>
                    <div>
                        <a href="{{ route('memberships.mainIndex') }}" class="btn-get-started scrollto">Get Started</a>
                    </div>
                </div>

                <div class="col-md-6 intro-img order-md-last order-first">
                    <img src="{{ asset('img/intro-img.svg') }}" alt="" class="img-fluid">
                </div>
            </div>

        </div>
    </section>
    <section id="about" class="section-bg">

        <div class="container">
            <div class="row">

                <div class="col-lg-5 col-md-6">
                    <div class="about-img">
                        <img src="{{ asset('img/about-img.png') }}" alt="">
                    </div>
                </div>

                <div class="col-lg-7 col-md-6">
                    <div class="about-content">
                        <h2>About Us</h2>
                        <h3>The most popular online coding school in East Europe since 2012!</h3>
                        <p>pCourses was founded in 2012 by two Stanford Computer Science professors who wanted to share
                            their knowledge and skills with the world. Professors Daphne Koller and Andrew Ng put their
                            courses online for anyone to take – and taught more learners in a few months than they could
                            have in an entire lifetime in the classroom.</p>
                        <p>Since then, we’ve built a platform where anyone, anywhere can learn and earn credentials from
                            the world’s top universities and education providers.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="pricing" class="wow fadeInUp">

        <div class="container">

            <header class="section-header">
                <h3>Latest courses</h3>
                <p>This is our latest courses. Enroll them and you'll reach the sky!</p>
            </header>

            <div class="row flex-items-xs-middle flex-items-xs-center">
                @forelse($memberships as $membership)
                    <div class="col-xs-12 @if(sizeof($memberships) == 1) col-lg-12 @elseif(sizeof($memberships) == 2) col-lg-6 @else col-lg-4 @endif">
                        <div class="card">
                            <div class="card-header">
                                <h3><span class="currency">€</span>{{ $membership->price }}<span
                                            class="period">/month</span></h3>
                            </div>
                            <div class="card-block">
                                <h4 class="card-title">
                                    <a href="{{ route('memberships.mainShow', $membership->id) }}">{{ $membership->name }}</a>
                                </h4>
                                <ul class="list-group">
                                    {{ $membership->description }}
                                </ul>
                                <a href="#" class="btn">Choose Plan</a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-xs-12 col-lg-12">
                        <div class="card">
                            <div class="alert alert-warning m-0">Sorry, but currently there are no memberships! Please visit
                                our
                                website
                                later!
                            </div>
                        </div>
                    </div>
                @endforelse

            </div>
        </div>

    </section>
@endsection
