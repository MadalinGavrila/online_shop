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
                        <span>Change Password</span>

                        <a href="{{route('account.edit')}}" class="pull-right btn btn-primary btn-xs account-edit-btn"><span class="glyphicon glyphicon-cog"></span> Edit</a>

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
                            {!! Form::open(['method'=>'POST', 'action'=>'Account\AccountController@change_password']) !!}

                                <div class="form-group{{$errors->has('password_current') ? ' has-error' : ''}}">
                                    {!! Form::label('password_current', 'Current Password:') !!}
                                    {!! Form::password('password_current', ['class'=>'form-control']) !!}

                                    @if($errors->has('password_current'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('password_current')}}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group{{$errors->has('password') ? ' has-error' : ''}}">
                                    {!! Form::label('password', 'New Password:') !!}
                                    {!! Form::password('password', ['class'=>'form-control']) !!}

                                    @if($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{$errors->first('password')}}</strong>
                                        </span>
                                    @endif
                                </div>

                                <div class="form-group">
                                    {!! Form::label('password_confirmation', 'Confirm Password:') !!}
                                    {!! Form::password('password_confirmation', ['class'=>'form-control']) !!}
                                </div>

                                <div class="form-group">
                                    {!! Form::submit('Change Password', ['class'=>'btn btn-primary btn-block']) !!}
                                </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection