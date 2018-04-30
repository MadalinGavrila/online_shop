@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    @include('layouts.partials.delete_modal')

    <h1 class="page-header">
        Brands <small>Update</small>
    </h1>

    <div class="alert alert-info text-center">
        <p><strong>Brand:</strong> {{$brand->name}}</p>
    </div>

    <div class="col-sm-6">
        <div class="col-sm-8 col-md-offset-2">

            @include('layouts.partials.alerts')

            @include('layouts.partials.form_errors')

            {!! Form::model($brand, ['method'=>'PATCH', 'action'=>['Admin\AdminBrandController@update', $brand->id], 'files'=>true]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('photo', 'Photo:') !!}
                    {!! Form::file('photo', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update Brand', ['class'=>'btn btn-primary col-sm-6']) !!}
                </div>

            {!! Form::close() !!}

            @can('delete brands')
                {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminBrandController@destroy', $brand->id], 'class'=>'form-delete']) !!}

                    <div class="form-group">
                        {!! Form::submit('Delete Brand', ['class'=>'btn btn-danger col-sm-6']) !!}
                    </div>

                {!! Form::close() !!}
            @endcan
        </div>
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