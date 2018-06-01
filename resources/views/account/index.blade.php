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
                        <span>Account</span>

                        <a href="{{route('account.password')}}" class="pull-right btn btn-danger btn-xs account-change-password-btn"><span class="glyphicon glyphicon-lock"></span> Change Password</a>

                        <a href="{{route('account.edit')}}" class="pull-right btn btn-primary btn-xs account-edit-btn"><span class="glyphicon glyphicon-cog"></span> Edit</a>
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

                        @include('layouts.partials.alerts')

                        <div class="well">
                            <a href="{{route('account.orders')}}"><span class="glyphicon glyphicon-shopping-cart"></span> Orders <span class="badge">{{$user->orders->count()}}</span></a>
                        </div>

                        <div class="well">
                            <a href="{{route('account.reviews')}}"><span class="glyphicon glyphicon-comment"></span> Reviews <span class="badge">{{$user->reviews->count()}}</span></a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection