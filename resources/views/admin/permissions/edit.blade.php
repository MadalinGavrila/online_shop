@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Permissions <small>Update</small>
    </h1>

    <div class="col-sm-6">
        <div class="col-sm-8 col-md-offset-2">

            @include('layouts.partials.form_errors')

            {!! Form::model($permission, ['method'=>'PATCH', 'action'=>['Admin\AdminPermissionController@update', $permission->id]]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update Permission', ['class'=>'btn btn-primary col-sm-6']) !!}
                </div>

            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminPermissionController@destroy', $permission->id], 'class'=>'form-delete']) !!}

                <div class="form-group">
                    {!! Form::submit('Delete Permission', ['class'=>'btn btn-danger col-sm-6']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection