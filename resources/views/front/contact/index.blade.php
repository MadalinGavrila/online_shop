@extends('layouts.front')

@section('title', 'Contact')

@section('navbar')
    @include('layouts.partials.front.navbar')
@endsection

@section('content')

    <div class="col-sm-10 col-sm-offset-3">

        <div class="row">

            <h3 class="text-center">Contact</h3>

            <div class="col-sm-6">
                <iframe width="100%" height="300" frameborder="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d182320.95131005836!2d25.954551749402746!3d44.43798529365475!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40b1f93abf3cad4f%3A0xac0632e37c9ca628!2sBucure%C8%99ti!5e0!3m2!1sro!2sro!4v1524322040586"></iframe>
            </div>

            <div class="col-sm-6">
                @include('layouts.partials.alerts')

                {!! Form::open(['method'=>'POST', 'action'=>'ContactController@sendMail']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!} <span class="errors">{{$errors->has('name') ? $errors->first('name') : ''}}</span>
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('email', 'Email:') !!} <span class="errors">{{$errors->has('email') ? $errors->first('email') : ''}}</span>
                        {!! Form::text('email', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('message', 'Message:') !!} <span class="errors">{{$errors->has('message') ? $errors->first('message') : ''}}</span>
                        {!! Form::textarea('message', null, ['class'=>'form-control', 'rows'=>3]) !!}
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-send"></span> Send Message</button>
                    </div>

                {!! Form::close() !!}
            </div>

        </div>

    </div>

@endsection