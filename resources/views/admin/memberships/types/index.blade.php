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
                                Create new type</a>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-lg-12">
                            @if(count($membershipsTypes)>0)
                                <table class="table-bordered table-primary" style="width:100%">
                                    <tr>
                                        <th style="width:10%">Name</th>
                                        <th style="width:20%">Description</th>
                                        <th style="width:10%"></th>
                                        <th style="width:10%"></th>
                                    </tr>
                                    @foreach($membershipsTypes as $type)
                                        <tr>
                                            <td>{{ $type->name }}</td>
                                            <td>{{ $type->description }}</td>
                                            <td align="center"><a class="btn btn-sm btn-info"
                                                                  href="{{route('memberships_types.edit', ['id' => $type->id])}}">Edit</a>
                                            </td>
                                            <td align="center">
                                                {!! Form::open(['action'=>['MembershipsTypescontroller@destroy', $type->id], 'method'=>'POST']) !!}
                                                {!! Form::hidden('_method', 'DELETE') !!}
                                                {!! Form::submit('Delete', ['class'=>'btn btn-sm btn-danger']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                                <div class="row justify-content-center">{{$membershipsTypes->links()}}</div>
                            @else
                                <div class="alert alert-warning mb-0">There are no created memberships types.</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection