@extends('layouts.main')

@section('main_content')
    <section id="intro" class="clearfix">
        <div class="container d-flex h-100">
            <div class="row justify-content-center align-self-center">
                <div class="col-md-6 intro-info order-md-first order-last">
                    <h2><span>{{ $membership->name }}</span><br>{{ $membership->description }}</h2>
                    <div>
                        <a role="button" class="btn-get-started"
                           onclick="initiateStripePayment()">PAY ({{ $membership->price }}€)</a>
                    </div>
                </div>

                <div class="col-md-6 intro-img order-md-last order-first">
                    <img src="{{ asset('img/online-payment.png') }}" alt="" class="img-fluid">
                </div>
            </div>

        </div>
    </section>
@endsection

@section('main_scripts')
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        function initiateStripePayment() {
            $.ajax({
                url: '{{ route('stripe.createSession', $membership->id) }}',
                data: {"_token": '{{ csrf_token() }}'},
                type: 'POST',
                success: function (response) {
                    console.log(response.id);
                    var stripe = Stripe('{{ env('STRIPE_KEY') }}');
                    stripe.redirectToCheckout({
                        sessionId: response.id
                    }).then(function (result) {

                    });
                },
                error: function (response) {

                }
            });
        }
    </script>
@endsection
