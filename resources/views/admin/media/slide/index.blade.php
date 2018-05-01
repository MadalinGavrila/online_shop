@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Slides <small>Create / List</small>
    </h1>

    <div class="col-sm-4">
        @include('layouts.partials.form_errors')

        {!! Form::open(['method'=>'POST', 'action'=>'Admin\AdminSlideController@store', 'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('photo', 'Photo:') !!}
                {!! Form::file('photo', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('visible', 'Visible:') !!}
                {!! Form::select('visible', [0 => 'no', 1 => 'yes'], 0, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Create Slide', ['class'=>'btn btn-primary btn-block']) !!}
            </div>

        {!! Form::close() !!}
    </div>

    <div class="col-sm-8">
        @if(count($slides))

            @include('layouts.partials.alerts')

            <div class="row">
                @foreach($slides as $slide)
                    <div class="col-md-4">
                        <div class="thumbnail">
                            <a href="{{route('admin.media.slide.edit', $slide->id)}}">
                                <img src="{{$slide->photo}}" alt="images" style="width:100%">
                                <div class="caption">
                                    <p class="text-center {{$slide->visible ? 'text-success' : 'text-danger'}}">Visible: {{$slide->visible ? 'Yes' : 'No'}}</p>
                                </div>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$slides->links()}}
                </div>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p>No Slides</p>
            </div>
        @endif
    </div>

@endsection