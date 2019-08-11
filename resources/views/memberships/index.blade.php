@extends('layouts.app')

@section('content')
    <div class="container mt-3">
        <div class="row form-group">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header text-black font-weight-bold">
                        All our memberships
                    </div>
                    <div class="card-body">
                        <div class="row form-group">
                            <div class="col-lg-12">
                                Memberships by type: <a href="{{ route('memberships.mainIndex') }}">All</a>
                                @foreach($membershipsTypes as $type)
                                    <a href="{{ route('memberships.indexByType', $type->id) }}">| {{ $type->name }}</a>
                                @endforeach
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-lg-12">
                                @if(count($memberships)>0)
                                    <div class="row form-group">
                                        <div class="col-lg-12">
                                            <div class="table-responsive">
                                                <table class="table table-hover">
                                                    <tr>
                                                        <th style="width:20%">{{ __('Name') }}</th>
                                                        <th style="width:40%">{{ __('Description') }}</th>
                                                        <th style="width:10%">{{ __('Price') }}</th>
                                                        <th style="width:20%">{{ __('Type') }}</th>
                                                        <th style="width:10%"></th>
                                                    </tr>
                                                    @foreach($memberships as $membership)
                                                        <tr>
                                                            <td>
                                                                <a href="{{ route('memberships.mainShow', $membership->id) }}">{{ $membership->name }}</a>
                                                            </td>
                                                            <td>{{ $membership->description }}</td>
                                                            <td>{{ $membership->price }}</td>
                                                            <td>{{ $membership->type->name }}</td>
                                                            <td align="center">
                                                                @if(Auth::user())
                                                                    @if($membership->isActiveForUser(Auth::user()->id) == 1)
                                                                        <a class="btn btn-sm btn-block btn-success"
                                                                           href="{{ route('user.memberships', Auth::user()->id) }}"
                                                                           role="button">Subscribed</a>
                                                                    @else
                                                                        <a class="btn btn-sm btn-block btn-primary"
                                                                           role="button"
                                                                           href="{{ route('memberships.showSubscribe', $membership->id) }}">Enroll</a>
                                                                    @endif
                                                                @else
                                                                    <a class="btn btn-sm btn-block btn-primary"
                                                                       role="button"
                                                                       href="{{ route('memberships.showSubscribe', $membership->id) }}">Enroll</a>
                                                                @endif
                                                            </td>
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
                                            <div class="alert alert-warning mb-0">There are no created memberships.
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
