@extends('layouts.admin')

@section('admin_content')
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-black font-weight-bold">
                    Users memberships history
                </div>
                <div class="card-body">
                    <form action="{{ route('users_memberships.index') }}" method="GET">
                        <div class="row form-group">
                            <div class="col-lg-4">
                                <label for="status">{{ __('Status') }}</label>
                                <select class="form-control" id="status" name="status">
                                    @foreach($membershipsStatusArr as $key => $value)
                                        <option value="{{ $value['name'] }}" {{ (((request()->get('status') === $value['name']) || (!request()->get('status') && $value['name'] === 'ALL')) ? 'selected': '') }}>{{ $value['text'] }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-lg-4">
                                <label for="expiration_in_minutes">{{ __('Membership exp. in minutes') }}</label>
                                <input type="text" class="form-control" name="expiration_in_minutes"
                                       id="expiration_in_minutes" value="{{ request()->get('expiration_in_minutes') }}">
                            </div>
                            <div class="col-lg-4">
                                <label for="search">&nbsp;</label>
                                <button type="submit" class="btn btn-block btn-primary" id="search">Search</button>
                            </div>
                        </div>
                    </form>
                    <div class="row form-group">
                        <div class="col-lg-2">
                            <a data-toggle="collapse" href="#searchLink" class="btn btn-outline-info " role="button"
                               aria-expanded="false"
                               aria-controls="searchLink">
                                [+] Search link</a>
                            </a>
                        </div>

                        <div class="col-lg-6">
                            <div class="collapse" id="searchLink">
                                <input type="text" id="search_save_url" class="form-control" value="{{ request()->fullUrl() }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="collapse" id="searchLink">
                                <button class="btn btn-block btn-success" onclick="copySearchUrl()">
                                    Copy to clipboard
                                </button>
                            </div>
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
                                                    <th style="width:10%">{{ __('Name') }}</th>
                                                    <th style="width:10%">{{ __('User') }}</th>
                                                    <th style="width:10%">{{ __('Price') }}</th>
                                                    <th style="width:10%">{{ __('Status') }}</th>
                                                    <th style="width:30%">{{ __('Start date') }}</th>
                                                    <th style="width:30%">{{ __('End date date') }}</th>
                                                </tr>
                                                @foreach($memberships as $userMembership)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('memberships.mainShow', $userMembership->membership->id) }}">{{ $userMembership->membership->name }}</a>
                                                        </td>
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
                                    <div class="row form-group justify-content-center">{{ $memberships->appends(request()->query())->links()}}</div>
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
    <script>
        function copySearchUrl(){
            var copyText = $("#search_save_url");
            copyText.select();
            document.execCommand("copy");
        }
    </script>
@endsection
