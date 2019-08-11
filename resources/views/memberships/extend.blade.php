@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Extend membership') }}</div>
                    <div class="card-body">
                        <form action="{{ route("user_membership.extend") }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="token">{{ __('Token') }}</label>
                                <input type="text" id="token" name="token" class="form-control" value="{{ $token }}"
                                       readonly style="background-color: lightgrey">
                            </div>
                            <div class="form-group">
                                <input class="btn btn-block btn-primary" type="submit" value="{{ trans('Submit') }}">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
