@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    @include('layouts.partials.delete_modal')

    <h1 class="page-header">
        Roles <small>Update</small>
    </h1>

    <div class="alert alert-info text-center">
        <p><strong>Role:</strong> {{$role->name}}</p>
    </div>

    <div class="col-sm-6">
        <div class="col-sm-8 col-md-offset-2">

            @include('layouts.partials.alerts')

            @include('layouts.partials.form_errors')

            {!! Form::model($role, ['method'=>'PATCH', 'action'=>['Admin\AdminRoleController@update', $role->id]]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update Role', ['class'=>'btn btn-primary col-md-6']) !!}
                </div>

            {!! Form::close() !!}

            {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminRoleController@destroy', $role->id], 'class'=>'form-delete']) !!}

                <div class="form-group">
                    {!! Form::submit('Delete Role', ['class'=>'btn btn-danger col-sm-6']) !!}
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