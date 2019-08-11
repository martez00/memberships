@extends('layouts.app')

@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <h1 class="display-4">Our latest memberships</h1>
        <p class="lead">This is our latest courses. Enroll them and you'll reach the sky!</p>
    </div>

    <div class="container">
        <div class="card-deck mb-3 text-center">
            @forelse($memberships as $membership)
                <div class="card mb-4 box-shadow">
                    <div class="card-header">
                        <h4 class="my-0 font-weight-normal"><a
                                    href="{{ route('memberships.mainShow', $membership->id) }}">{{ $membership->name }}</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <h1 class="card-title pricing-card-title">{{ $membership->price }} EUR
                            <small class="text-muted">/ mo</small>
                        </h1>
                        <ul class="list-unstyled mt-3 mb-4">
                            {{ $membership->description }}
                        </ul>
                        @if(Auth::user())
                            @if($membership->isActiveForUser(Auth::user()->id) == 1)
                                <a class="btn btn-lg btn-block btn-success"
                                   href="{{ route('user.memberships', Auth::user()->id) }}" role="button">Subscribed</a>
                            @else
                                <a class="btn btn-lg btn-block btn-primary"
                                   role="button"
                                   href="{{ route('memberships.showSubscribe', $membership->id) }}">Enroll</a>
                            @endif
                        @else
                            <a class="btn btn-lg btn-block btn-primary"
                               role="button"
                               href="{{ route('memberships.showSubscribe', $membership->id) }}">Enroll</a>
                        @endif
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">Sorry, but currently there are no memberships! Please visit our website
                    later!
                </div>
            @endforelse
        </div>
    </div>
@endsection
