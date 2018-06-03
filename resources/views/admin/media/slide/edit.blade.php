@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    @include('layouts.partials.delete_modal')

    <h1 class="page-header">
        Slides <small>Update</small>
    </h1>

    <div class="col-sm-4">

        @include('layouts.partials.alerts')

        {!! Form::model($slide, ['method'=>'PATCH', 'action'=>['Admin\AdminSlideController@update', $slide->id], 'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('visible', 'Visible:') !!}
                {!! Form::select('visible', [0 => 'no', 1 => 'yes'], null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Update Slide', ['class'=>'btn btn-primary col-sm-6']) !!}
            </div>

        {!! Form::close() !!}

        @can('delete photos')
            {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminSlideController@destroy', $slide->id], 'class'=>'form-delete']) !!}

                <div class="form-group">
                    {!! Form::submit('Delete', ['class'=>'btn btn-danger col-sm-6']) !!}
                </div>

            {!! Form::close() !!}
        @endcan
    </div>

    <div class="col-sm-8">
        <img class="img-responsive" src="{{$slide->photo}}" alt="image">
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