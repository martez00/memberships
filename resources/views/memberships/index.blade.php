@extends('layouts.main')

@section('main_content')
    <section id="page">
        <div class="container">
            <div class="row form-group">
                <div class="col-lg-3">
                    <div class="card bg-primary text-white mb-3">
                        <div class="card-body">
                            <form action="{{ route('memberships.mainIndex') }}" method="GET">
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <label for="type">{{ __('Membership type') }}</label>
                                        <select class="form-control" id="type_id" name="type_id">
                                            <option value="" selected>All</option>
                                            @foreach($membershipsTypes as $type)
                                                <option value="{{ $type->id }}" {{ (((request()->get('type_id') == $type->id)) ? 'selected': '') }}>{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input type="text" class="form-control" name="name"
                                               id="name" value="{{ request()->get('name') }}">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="description">{{ __('Description') }}</label>
                                        <input type="text" class="form-control" name="description"
                                               id="description" value="{{ request()->get('description') }}">
                                    </div>
                                    <div class="col-lg-12">
                                        <label for="price">{{ __('Price') }}</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend search-panel">
                                                <button type="button" class="btn btn-default dropdown-toggle"
                                                        data-toggle="dropdown">
                                                    <span id="search_concept">@if(request()->get('price_param')) {{ $priceSearchParams[request()->get('price_param')] }} @else
                                                            Filter by @endif</span>
                                                </button>
                                                <ul class="dropdown-menu" role="menu">
                                                    @foreach($priceSearchParams as $key => $value)
                                                        <li class="dropdown-item"><a href="#{{ $key }}">{{ $value }}</a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                            <input type="hidden" name="price_param" value="{{ request()->get('price_param') }}" id="search_param">
                                            <input type="text" class="form-control" name="price"
                                                   id="price" value="{{ request()->get('price') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row form-group mb-1">
                                    <div class="col-lg-12">
                                        <button type="submit" class="btn btn-block btn-outline-light" id="search">
                                            Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-sm-12">
                    <div class="card pb-0 pt-3">
                        <div class="card-body">
                            <div class="row form-group">
                                <div class="col-lg-12">
                                    @if(count($memberships)>0)
                                        <div class="row form-group mb-0">
                                            <div class="col-lg-12">
                                                <div class="table-responsive">
                                                    <table class="table table-hover table-striped mb-0">
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
                                            <div class="row form-group justify-content-center mt-3 mb-0">{{$memberships->appends(request()->query())->links()}}</div>
                                        @endif
                                    @else
                                        <div class="row form-group mb-0">
                                            <div class="col-lg-12">
                                                <div class="alert alert-warning mb-0">There are no created memberships
                                                    which match you criterias.
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
    </section>
@endsection

@section('main_scripts')
    <script>
        $(document).ready(function (e) {
            $('.search-panel .dropdown-menu').find('a').click(function (e) {
                e.preventDefault();
                var param = $(this).attr("href").replace("#", "");
                var concept = $(this).text();
                $('.search-panel span#search_concept').text(concept);
                $('.input-group #search_param').val(param);
            });
        });
    </script>
@endsection
