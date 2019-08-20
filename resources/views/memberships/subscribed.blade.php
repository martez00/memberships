@extends('layouts.main')

@section('main_content')
    <section id="intro" class="clearfix">
        <div class="container d-flex h-100">
            <div class="row justify-content-center align-self-center">
                <div class="col-md-6 intro-info order-md-first order-last">
                    <h2 class="mb-0 mt-0"><span style="color:lightgreen">Congratulations!</span></h2>
                        <br>
                        You have successfuly ordered {{ $membership->name }} membership. You'll be able
                        to use it in a few minutes!</h2>
                </div>

                <div class="col-md-6 intro-img order-md-last order-first">
                    <img src="{{ asset('img/success.png') }}" class="img-fluid">
                </div>
            </div>

        </div>
    </section>
@endsection
