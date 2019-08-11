@extends('layouts.admin')

@section('admin_content')
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-black font-weight-bold">
                    Users memberships history
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-lg-12">
                            @if(count($memberships)>0)
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <tr>
                                                    <th style="width:10%">{{ __('Name') }}</th>
                                                    <th style="width:10%">{{ __('User') }}</th>
                                                    <th style="width:10%">{{ __('Price') }}</th>
                                                    <th style="width:10%">{{ __('Status') }}</th>
                                                    <th style="width:30%">{{ __('Start date') }}</th>
                                                    <th style="width:30%">{{ __('End date date') }}</th>
                                                </tr>
                                                @foreach($memberships as $userMembership)
                                                    <tr>
                                                        <td><a href="{{ route('memberships.mainShow', $userMembership->membership->id) }}">{{ $userMembership->membership->name }}</a></td>
                                                        <td>{{ $userMembership->user->name }}</td>
                                                        <td>{{ $userMembership->membership->price }}</td>
                                                        <td>{{ $userMembership->status }}</td>
                                                        <td>{{ $userMembership->start_date }}</td>
                                                        <td>{{ $userMembership->end_date }}</td>
                                                    </tr>
                                                @endforeach
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                @if($memberships->hasPages())
                                    <div class="row form-group justify-content-center">{{$memberships->links()}}</div>
                                @endif
                            @else
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <div class="alert alert-warning mb-0">There are no users memberships.</div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
