@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    @include('layouts.partials.delete_modal')

    <h1 class="page-header">
        Categories <small>Update</small>
    </h1>

    <div class="alert alert-info text-center">
        <p><strong>Category:</strong> {{$category->name}}</p>
    </div>

    <div class="col-sm-6">
        <div class="col-sm-8 col-md-offset-2">

            @include('layouts.partials.alerts')

            @include('layouts.partials.form_errors')

            {!! Form::model($category, ['method'=>'PATCH', 'action'=>['Admin\AdminCategoryController@update', $category->id]]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update Category', ['class'=>'btn btn-primary col-sm-6']) !!}
                </div>

            {!! Form::close() !!}

            @can('delete categories')
                {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminCategoryController@destroy', $category->id], 'class'=>'form-delete']) !!}

                    <div class="form-group">
                        {!! Form::submit('Delete Category', ['class'=>'btn btn-danger col-sm-6']) !!}
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