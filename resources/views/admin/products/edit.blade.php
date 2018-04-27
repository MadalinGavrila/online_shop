@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    @include('layouts.partials.delete_modal')

    <h1 class="page-header">
        Products <small>Update</small>
    </h1>

    <div class="col-md-3">
        <img src="{{$product->photos->first() ? $product->photos->first()->path : $product->photoPlaceholder()}}" alt="image" class="img-responsive img-rounded" />

        @can('delete products')
            {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminProductController@destroy', $product->id], 'class'=>'form-delete']) !!}

                <div class="form-group">
                    {!! Form::submit('Delete Product', ['class'=>'btn btn-danger btn-block']) !!}
                </div>

            {!! Form::close() !!}
        @endcan
    </div>

    <div class="col-sm-9">
            @include('layouts.partials.form_errors')

            {!! Form::model($product, ['method'=>'PATCH', 'action'=>['Admin\AdminProductController@update', $product->id], 'files'=>true]) !!}

            <div class="col-sm-6">
                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('brand', 'Brand:') !!}
                    {!! Form::select('brand', $brands, $product->brands->first()->id, ['class'=>'form-control']) !!}
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
                    {!! Form::label('visible', 'Visible:') !!}
                    {!! Form::select('visible', [0 => 'no', 1 => 'yes'], null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Description:') !!}
                    {!! Form::textarea('description', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Update Product', ['class'=>'btn btn-primary btn-block']) !!}
                </div>
            </div>

            {!! Form::close() !!}
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