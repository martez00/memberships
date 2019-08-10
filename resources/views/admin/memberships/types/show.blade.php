@extends('layouts.admin')

@section('admin_content')
    <div class="row form-group">
        <div class="col-sm-12">
            <a class="btn btn-danger btn-sm" href="{{ url()->previous() }}">Back</a>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-black font-weight-bold">
                    Membership type card
                </div>
                <div class="card-body">
                    <input type="hidden" id="id" name="id" value=" {{ $membershipsTypes->id }}">
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name" class="form-control"
                               value="{{$membershipsTypes->name}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <input type="text" id="description" name="description"
                               value="{{$membershipsTypes->description}}" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
