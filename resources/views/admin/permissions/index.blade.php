@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Permissions <small>Create / List</small>
    </h1>

    <div class="col-sm-6">
        <div class="col-sm-8 col-md-offset-2">

            @include('layouts.partials.form_errors')

            {!! Form::open(['method'=>'POST', 'action'=>'Admin\AdminPermissionController@store']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Create Permission', ['class'=>'btn btn-primary btn-block']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="col-sm-6">
        @if(count($permissions))

            @include('layouts.partials.alerts')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($permissions as $permission)
                        <tr>
                            <td>{{$permission->id}}</td>
                            <td><a href="{{route('admin.permissions.edit', $permission->id)}}">{{$permission->name}}</a></td>
                            <td>{{$permission->created_at->diffForHumans()}}</td>
                            <td>{{$permission->updated_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$permissions->links()}}
                </div>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p>No Permissions</p>
            </div>
        @endif
    </div>

@endsection