@extends('layouts.admin')

@section('admin_content')
    <div class="row form-group">
        <div class="col-sm-12">
            <a class="btn btn-danger btn-sm" href="{{ route("memberships.index") }}">Back</a>
        </div>
    </div>
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-black font-weight-bold">
                     Membership card
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label for="name">{{ __('Name') }}</label>
                        <input type="text" id="name" name="name" class="form-control" value="{{$membership->name}}"
                               disabled>
                    </div>
                    <div class="form-group">
                        <label for="description">{{ __('Description') }}</label>
                        <input type="text" id="description" name="description" class="form-control"
                               value="{{$membership->description}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="price">{{ __('Price') }}</label>
                        <input type="text" id="price" name="price" class="form-control"
                               value="{{$membership->price}}" disabled>
                    </div>
                    <div class="form-group">
                        <label for="type_id">{{ __('Type') }}</label>
                        <input type="text" id="type" name="type" class="form-control"
                               value="{{$membership->type->name}}" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
