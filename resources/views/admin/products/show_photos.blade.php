@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    @include('layouts.partials.delete_modal')

    <h1 class="page-header">
        Products <small>Photos</small>
    </h1>

    <div class="alert alert-info text-center">
        <p><strong>Product:</strong> {{$product->name}}</p>
    </div>

    <div class="col-sm-6">
        <div class="col-sm-8 col-md-offset-2">
            @include('layouts.partials.form_errors')

            {!! Form::open(['method'=>'POST', 'action'=>['Admin\AdminProductController@addPhoto', $product->id], 'files'=>true]) !!}

                <div class="form-group">
                    {!! Form::label('photo', 'Photo:') !!}
                    {!! Form::file('photo', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Add Photo', ['class'=>'btn btn-primary btn-block']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="col-sm-6">
        @if(count($productPhotos))

            @include('layouts.partials.alerts')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Photo</th>
                        @can('delete photos')
                            <th>Delete</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($productPhotos as $photo)
                        <tr>
                            <td>{{$photo->id}}</td>
                            <td><img height="50" src="{{$photo->path}}" alt="image" /></td>
                            @can('delete photos')
                                <td>
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminProductController@deletePhoto', $product->id], 'class'=>'form-delete']) !!}

                                        <input type="hidden" name="photo" value="{{$photo->id}}" />

                                        <div class="form-group">
                                            {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-xs']) !!}
                                        </div>

                                    {!! Form::close() !!}
                                </td>
                            @endcan
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$productPhotos->links()}}
                </div>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p>No Photos</p>
            </div>
        @endif
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