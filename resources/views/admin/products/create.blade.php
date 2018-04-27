@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Products <small>Create</small>
    </h1>

    <div class="col-sm-12">
        <div class="col-sm-8 col-md-offset-2">
            @include('layouts.partials.form_errors')

            {!! Form::open(['method'=>'POST', 'action'=>'Admin\AdminProductController@store', 'files'=>true]) !!}

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('name', 'Name:') !!}
                        {!! Form::text('name', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('brand', 'Brand:') !!}
                        {!! Form::select('brand', [''=>'Select Brand'] + $brands, null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('category', 'Category:') !!}
                        {!! Form::select('category', [''=>'Select Category'] + $categories, null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('subCategory', 'SubCategory:') !!}
                        {!! Form::select('subCategory', [], null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('price', 'Price:') !!}
                        {!! Form::text('price', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('stock', 'Stock:') !!}
                        {!! Form::text('stock', null, ['class'=>'form-control']) !!}
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="form-group">
                        {!! Form::label('photo', 'Photo:') !!}
                        {!! Form::file('photo', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Description:') !!}
                        {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('visible', 'Visible:') !!}
                        {!! Form::select('visible', [0 => 'no', 1 => 'yes'], 0, ['class'=>'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::submit('Create Product', ['class'=>'btn btn-primary btn-block']) !!}
                    </div>
                </div>

            {!! Form::close() !!}
        </div>
    </div>

@endsection

@section('scripts')

    <script>

        $('#category').on('change', function(){
            if($(this).val() != ''){
                var cat_id = $(this).val();
                var _token = $('input[name="_token"]').val();

                $.ajax({
                    url: "{{route('admin.products.ajaxSubCategory')}}",
                    method: "POST",
                    data: {cat_id:cat_id, _token:_token},
                    success:function(result)
                    {
                        $('#subCategory').html(result);
                    }
                });
            }
        });

    </script>

@endsection