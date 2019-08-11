@extends('layouts.admin')

@section('admin_content')
    <div class="row form-group">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header text-black font-weight-bold">
                    Memberships types
                </div>
                <div class="card-body">
                    <div class="row form-group">
                        <div class="col-lg-12">
                            <a class="btn btn-success" style="margin-bottom:5px;"
                               href="{{route('memberships_types.create')}}">[+]
                                {{ __('Create new type') }}</a>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-12">
                            @if(count($membershipsTypes)>0)
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <div class="table-responsive">
                                            <table class="table table-hover">
                                                <tr>
                                                    <th style="width:20%">{{ __('Name') }}</th>
                                                    <th style="width:60%">{{ __('Description') }}</th>
                                                    <th style="width:10%"></th>
                                                    <th style="width:10%"></th>
                                                </tr>
                                                @foreach($membershipsTypes as $type)
                                                    <tr>
                                                        <td>
                                                            <a href="{{ route('memberships_types.show', $type->id) }}">{{ $type->name }}</a>
                                                        </td>
                                                        <td>{{ $type->description }}</td>
                                                        <td align="center"><a class="btn btn-sm btn-primary"
                                                                              href="{{route('memberships_types.edit', $type->id)}}">{{ __('Edit') }}</a>
                                                        </td>
                                                        <td align="center">
                                                            <form action="{{ route('memberships_types.destroy', $type->id) }}"
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
                                @if($membershipsTypes->hasPages())
                                    <div class="row form-group justify-content-center">{{$membershipsTypes->links()}}</div>
                                @endif
                            @else
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <div class="alert alert-warning mb-0">There are no created memberships types.
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
@endsection
