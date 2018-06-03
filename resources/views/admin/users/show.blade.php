@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Users <small>Permissions</small>
    </h1>

    <div class="alert alert-info text-center">
        <p><strong>User:</strong> {{$user->full_name}}</p>
    </div>

    <div class="col-sm-6">
        <div class="col-sm-8 col-md-offset-2">

            @include('layouts.partials.form_errors')

            {!! Form::open(['method'=>'POST', 'action'=>['Admin\AdminUserController@givePermission', $user->id]]) !!}

                <div class="form-group">
                    {!! Form::label('permission', 'Permission:') !!}
                    {!! Form::select('permission', $permissions, null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Add Permission', ['class'=>'btn btn-primary btn-block']) !!}
                </div>

            {!! Form::close() !!}

        </div>
    </div>

    <div class="col-sm-6">
        @if(count($user_permissions))

            @include('layouts.partials.alerts')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Remove</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($user_permissions as $permission)
                        <tr>
                            <td>{{$permission->name}}</td>
                            <td>
                                {!! Form::open(['method'=>'POST', 'action'=>['Admin\AdminUserController@withdrawPermission', $user->id]]) !!}

                                    <input type="hidden" name="permission" value="{{$permission->name}}" />

                                    <div class="form-group">
                                        {!! Form::submit('Remove', ['class'=>'btn btn-danger btn-xs']) !!}
                                    </div>

                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$user_permissions->links()}}
                </div>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p>No Permissions</p>
            </div>
        @endif
    </div>

@endsection