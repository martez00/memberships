@extends('layouts.user')

@section('user_content')
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="d-lg-flex align-items-center">
                <div>
                    <h3 class="text-dark font-weight-bold mb-2">Hi, {{ Auth::user()->name }}!</h3>
                    <h6 class="font-weight-normal mb-2">This is a dashboard of your user.</h6>
                </div>
            </div>
        </div>
    </div>
@endsection
