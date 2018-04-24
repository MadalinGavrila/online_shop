@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    @include('layouts.partials.delete_modal')

    <h1 class="page-header">
        Users <small>Update</small>
    </h1>

    <div class="alert alert-info text-center">
        <p>{{$user->full_name}}</p>
    </div>

    <div class="col-sm-6">
        <div class="col-sm-8 col-md-offset-2">

            @include('layouts.partials.form_errors')

            {!! Form::model($user, ['method'=>'PATCH', 'action'=>['Admin\AdminUserController@update', $user->id]]) !!}

                <div class="form-group">
                    {!! Form::label('active', 'Active:') !!}
                    {!! Form::select('active', [0 => 'Not Active', 1 => 'Active'], null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('role', 'Role:') !!}
                    {!! Form::select('role', $roles, $user->roles->first() ? $user->roles->first()->id : null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update User', ['class'=>'btn btn-primary col-sm-6']) !!}
                </div>

            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminUserController@destroy', $user->id], 'class'=>'form-delete']) !!}

                <div class="form-group">
                    {!! Form::submit('Delete User', ['class'=>'btn btn-danger col-sm-6']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        $(document).ready(function(){

            $(".form-delete").on('click', function(e){

                e.preventDefault();

                var form = $(this);

                $("#delete_modal").modal({ backdrop: 'static', keyboard: false }).on('click', '#delete-btn', function(){

                    form.submit();

                });

            });

        });

    </script>

@endsection