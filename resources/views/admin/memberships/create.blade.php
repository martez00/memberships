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
                    Create new membership
                </div>
                <div class="card-body">
                    <form action="{{ route("memberships.store") }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                                   required>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <input type="text" id="description" name="description" class="form-control"
                                   value="{{ old('description') }}">
                        </div>
                        <div class="form-group">
                            <label for="price">{{ __('Price') }}</label>
                            <input type="text" id="price" name="price" class="form-control" value="{{ old('price') }}">
                        </div>
                        <div class="form-group">
                            <label for="type_id">{{ __('Type') }}</label>
                            <select name="type_id" id="type_id" class="form-control">
                                @foreach($membershipsTypes as $id => $name)
                                    <option value="{{ $id }}" {{ (old('type_id') == $id) ? 'selected' : '' }}>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" value="{{ trans('Save') }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
