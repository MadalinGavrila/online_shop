@extends('layouts.front')

@section('title', 'Login')

@section('navbar')
    @include('layouts.partials.front.navbar')
@endsection

@section('content')

    <div class="col-sm-6 col-md-offset-5">

        @if(session('status'))
            <div class="alert alert-success text-center">
                {{session('status')}}
            </div>
        @endif

        <div class="panel panel-default">
            <div class="panel-heading">Reset Password</div>
            <div class="panel-body">
                <form method="POST" action="{{route('password.email')}}">
                    @csrf

                    <div class="form-group">
                        <label for="email">Email address:
                            <span class="errors">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                        </label>
                        <input type="text" name="email" value="{{old('email')}}" class="form-control" id="email" placeholder="Enter email" />
                    </div>

                    <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
                </form>
            </div>
        </div>

    </div>

@endsection