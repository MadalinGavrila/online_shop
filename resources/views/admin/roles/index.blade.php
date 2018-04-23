@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Roles <small>Create / List</small>
    </h1>

    <div class="col-sm-6">
        <div class="col-sm-8 col-md-offset-2">

            @include('layouts.partials.form_errors')

            {!! Form::open(['method'=>'POST', 'action'=>'Admin\AdminRoleController@store']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Create Role', ['class'=>'btn btn-primary btn-block']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="col-sm-6">
    @if(count($roles))

        @include('layouts.partials.alerts')

        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Permissions</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{$role->id}}</td>
                        <td><a href="{{route('admin.roles.edit', $role->id)}}">{{$role->name}}</a></td>
                        <td><a href="{{route('admin.roles.show', $role->id)}}">{{$role->permissions->count()}}</a></td>
                        <td>{{$role->created_at->diffForHumans()}}</td>
                        <td>{{$role->updated_at->diffForHumans()}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        <div class="row">
            <div class="col-sm-6 col-sm-offset-5">
                {{$roles->links()}}
            </div>
        </div>
    @else
        <div class="alert alert-success text-center">
            <p>No Roles</p>
        </div>
    @endif
    </div>

@endsection