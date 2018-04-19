@extends('layouts.front')

@section('title', 'Register')

@section('navbar')
    @include('layouts.partials.front.navbar')
@endsection

@section('content')

    <div class="col-sm-6 col-md-offset-5">

        <div class="panel panel-default">
            <div class="panel-heading">Register
                <a class="pull-right" href="{{route('login')}}">Login</a>
            </div>
            <div class="panel-body">
                <form method="POST" action="{{route('register')}}">
                    @csrf

                    <div class="form-group">
                        <label for="first_name">First Name:
                            <span class="errors">{{$errors->has('first_name') ? $errors->first('first_name') : ''}}</span>
                        </label>
                        <input type="text" name="first_name" value="{{old('first_name')}}" class="form-control" id="first_name" placeholder="Enter first name" />
                    </div>

                    <div class="form-group">
                        <label for="last_name">Last Name:
                            <span class="errors">{{$errors->has('last_name') ? $errors->first('last_name') : ''}}</span>
                        </label>
                        <input type="text" name="last_name" value="{{old('last_name')}}" class="form-control" id="last_name" placeholder="Enter last name" />
                    </div>

                    <div class="form-group">
                        <label for="email">Email address:
                            <span class="errors">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                        </label>
                        <input type="text" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Enter email" />
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

                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </form>
            </div>
        </div>

    </div>

@endsection