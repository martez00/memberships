@extends('layouts.admin')

@section('admin_content')
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-black font-weight-bold">
                    Memberships
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <a class="btn btn-success" style="margin-bottom:5px;"
                               href="{{route('memberships.create')}}">[+]
                                {{ __('Create new membership') }}</a>
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
                                                    <th style="width:5%"></th>
                                                    <th style="width:5%"></th>
                                                </tr>
                                                @foreach($memberships as $membership)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('memberships.show', $membership->id) }}">{{ $membership->name }}</a>
                                                        </td>
                                                        <td>{{ $membership->description }}</td>
                                                        <td>{{ $membership->price }}</td>
                                                        <td>{{ $membership->type->name }}</td>
                                                        <td align="center"><a class="btn btn-sm btn-primary"
                                                                              href="{{route('memberships.edit', $membership->id)}}">{{ __('Edit') }}</a>
                                                        </td>
                                                        <td align="center">
                                                            <form action="{{ route('memberships.destroy', $membership->id) }}"
                                                                  method="POST"
                                                                  onsubmit="return confirm('{{ __('Do you really want to delete?') }}');"
                                                                  style="display: inline-block;">
                                                                <input type="hidden" name="_method" value="DELETE">
                                                                <input type="hidden" name="_token"
                                                                       value="{{ csrf_token() }}">
                                                                <input type="submit" class="btn btn-sm btn-danger"
                                                                       value="{{ __('Delete') }}">
                                                            </form>
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
                                        <div class="alert alert-warning mb-0">There are no created memberships.</div>
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
