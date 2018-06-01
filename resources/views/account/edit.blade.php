@extends('layouts.front')

@section('title', 'Account')

@section('navbar')
    @include('layouts.partials.front.navbar')
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12 col-sm-offset-2 col-md-12 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div>
                        <span>Account Update</span>

                        <a href="{{route('account.password')}}" class="pull-right btn btn-danger btn-xs account-change-password-btn"><span class="glyphicon glyphicon-lock"></span> Change Password</a>

                        <a href="{{route('account')}}" class="pull-right btn btn-primary btn-xs account-profile-btn"><span class="glyphicon glyphicon-user"></span> Profile</a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-md-6 col-sm-6">
                        <h2>{{$user->full_name}}</h2>

                        @if($user->roles->first())
                            <p>{{$user->roles->first()->name}}</p>
                        @endif

                        <hr>

                        <ul class="list-unstyled">
                            <li><p><span class="glyphicon glyphicon-envelope"></span> {{$user->email}}</p></li>
                        </ul>

                        <hr>

                        <p>Date Of Joining: {{$user->created_at->toFormattedDateString()}}</p>
                    </div>

                    <div class="col-md-6 col-sm-6">
                        <div class="well">
                            {!! Form::model($user, ['method'=>'POST', 'action'=>'Account\AccountController@update']) !!}

                                <div class="form-group{{$errors->has('first_name') ? ' has-error' : ''}}">
                                    {!! Form::label('first_name', 'First Name:') !!}
                                    {!! Form::text('first_name', null, ['class'=>'form-control']) !!}

                                    @if($errors->has('first_name'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('first_name')}}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{$errors->has('last_name') ? ' has-error' : ''}}">
                                    {!! Form::label('last_name', 'Last Name:') !!}
                                    {!! Form::text('last_name', null, ['class'=>'form-control']) !!}

                                    @if($errors->has('last_name'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('last_name')}}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{$errors->has('email') ? ' has-error' : ''}}">
                                    {!! Form::label('email', 'Email:') !!}
                                    {!! Form::text('email', null, ['class'=>'form-control']) !!}

                                    @if($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('email')}}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    {!! Form::submit('Update', ['class'=>'btn btn-primary btn-block']) !!}
                                </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection