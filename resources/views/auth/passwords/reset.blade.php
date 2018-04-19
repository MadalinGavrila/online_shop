@extends('layouts.front')

@section('title', 'Login')

@section('navbar')
    @include('layouts.partials.front.navbar')
@endsection

@section('content')

    <div class="col-sm-6 col-md-offset-5">

        <div class="panel panel-default">
            <div class="panel-heading">Reset Password</div>
            <div class="panel-body">
                <form method="POST" action="{{route('password.request')}}">
                    @csrf

                    <input type="hidden" name="token" value="{{$token}}" />

                    <div class="form-group">
                        <label for="email">Email address:
                            <span class="errors">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                        </label>
                        <input type="text" name="email" value="{{$email or old('email')}}" class="form-control" id="email" placeholder="Enter email" />
                    </div>

                    <div class="form-group">
                        <label for="password">Password:
                            <span class="errors">{{$errors->has('password') ? $errors->first('password') : ''}}</span>
                        </label>
                        <input type="password" name="password" class="form-control" id="password" placeholder="Enter password" />
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password:</label>
                        <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" placeholder="Confirm password" />
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Reset Password</button>
                </form>
            </div>
        </div>

    </div>

@endsection