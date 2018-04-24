@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    @include('layouts.partials.delete_modal')

    <h1 class="page-header">
        SubCategories <small>Update</small>
    </h1>

    <div class="col-sm-6">
        <div class="col-sm-8 col-md-offset-2">

            @include('layouts.partials.form_errors')

            {!! Form::model($subCategory, ['method'=>'PATCH', 'action'=>['Admin\AdminSubCategoryController@update', $subCategory->id]]) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('category_id', 'Category:') !!}
                    {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update SubCategory', ['class'=>'btn btn-primary col-sm-6']) !!}
                </div>

            {!! Form::close() !!}

            @can('delete subcategories')
                {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminSubCategoryController@destroy', $subCategory->id], 'class'=>'form-delete']) !!}

                    <div class="form-group">
                        {!! Form::submit('Delete SubCategory', ['class'=>'btn btn-danger col-sm-6']) !!}
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