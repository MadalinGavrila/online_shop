@extends('layouts.front')

@section('title', 'Login')

@section('navbar')
    @include('layouts.partials.front.navbar')
@endsection

@section('content')

    <div class="col-sm-6 col-md-offset-5">

        @include('layouts.partials.alerts')

        <div class="panel panel-default">
            <div class="panel-heading">Login
                <a class="pull-right" href="{{route('register')}}">Register</a>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{route('login')}}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email address:
                            <span class="errors">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                        </label>
                        <input type="text" name="email" class="form-control" id="email" placeholder="Enter email" />
                    </div>

                    <div class="form-group">
                        <label for="password">Password:
                            <span class="errors">{{$errors->has('password') ? $errors->first('password') : ''}}</span>
                        </label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" />
                    </div>

                    <div class="checkbox">
                        <label><input type="checkbox" name="remember" {{old('remember') ? 'checked' : ''}} /> Remember me</label>
                    </div>

                    <button type="submit" class="btn btn-primary">Login</button>

                    <a class="pull-right btn btn-link" href="{{route('password.request')}}">Forgot Your Password?</a>

                    <a class="pull-right btn btn-link" href="{{route('auth.activate.resend')}}">Resend Activation Email</a>
                </form>
            </div>
        </div>

    </div>

@endsection