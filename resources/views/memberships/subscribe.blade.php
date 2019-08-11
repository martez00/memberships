@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-sm-6">
                <div class="card">
                    <div class="card-header text-black font-weight-bold">
                        {{ $membership->name }} | Subscribe it now!
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-lg-12">
                                <b>Membership name:</b> {{ $membership->name }}<br>
                                <b>Membership description:</b> {{ $membership->description }}<br>
                                <b>Membership type:</b> {{ $membership->type->name }}<br>
                                <div class="card p-3 mt-2">
                                    <form role="form" action="{{ route('stripe.post', [$membership->id]) }}"
                                          method="post"
                                          class="require-validation"
                                          data-cc-on-file="false"
                                          data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                                          id="payment-form">
                                        @csrf

                                        <div class='form-row row'>
                                            <div class='col-xs-12 form-group required'>
                                                <label class='control-label'><b>Name on Card</b></label>
                                                <input class='form-control' type='text'>
                                            </div>
                                        </div>

                                        <div class='form-row row'>
                                            <div class='col-xs-12 form-group required'>
                                                <label class='control-label'><b>Card Number</b></label>
                                                <input autocomplete='off' class='form-control card-number'
                                                        type='text'>
                                            </div>
                                        </div>

                                        <div class='form-row row'>
                                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                <label class='control-label'><b>CVC</b></label>
                                                <input autocomplete='off'
                                                       class='form-control card-cvc'
                                                       placeholder='ex. 311'
                                                       size='4'
                                                       type='text'>
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='control-label'><b>Expiration Month</b></label>
                                                <input
                                                        class='form-control card-expiry-month' placeholder='MM' size='2'
                                                        type='text'>
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='control-label'><b>Expiration Year</b></label>
                                                <input
                                                        class='form-control card-expiry-year' placeholder='YYYY'
                                                        size='4'
                                                        type='text'>
                                            </div>
                                        </div>

                                        <div class='form-row row'>
                                            <div class='col-md-12 error form-group d-none'>
                                                <div class='alert-danger alert'>Please correct the errors and try
                                                    again.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <button class="btn btn-primary btn-lg btn-block" type="submit">Pay Now
                                                    ({{ $membership->price }} EUR)
                                                </button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="https://js.stripe.com/v2/"></script>

    <script type="text/javascript">
        $(function () {
            var $form = $(".require-validation");
            $('form.require-validation').bind('submit', function (e) {
                var $form = $(".require-validation"),
                    inputSelector = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs = $form.find('.required').find(inputSelector),
                    $errorMessage = $form.find('div.error'),
                    valid = true;
                $errorMessage.addClass('d-none');

                $('.has-error').removeClass('has-error');
                $inputs.each(function (i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorMessage.removeClass('d-none');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-number').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeResponseHandler);
                }

            });

            function stripeResponseHandler(status, response) {
                if (response.error) {
                    $('.error')
                        .removeClass('d-none')
                        .find('.alert')
                        .text(response.error.message);
                } else {
                    // token contains id, last4, and card type
                    var token = response['id'];
                    // insert the token into the form so it gets submitted to the server
                    $form.find('input[type=text]').empty();
                    $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                    $form.get(0).submit();
                }
            }

        });
    </script>
@endsection
