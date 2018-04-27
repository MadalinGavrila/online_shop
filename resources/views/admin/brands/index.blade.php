@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Brands <small>Create / List</small>
    </h1>

    <div class="col-sm-4">
        @include('layouts.partials.form_errors')

        {!! Form::open(['method'=>'POST', 'action'=>'Admin\AdminBrandController@store', 'files'=>true]) !!}

            <div class="form-group">
                {!! Form::label('name', 'Name:') !!}
                {!! Form::text('name', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('photo', 'Photo:') !!}
                {!! Form::file('photo', null, ['class'=>'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::submit('Create Brand', ['class'=>'btn btn-primary btn-block']) !!}
            </div>

        {!! Form::close() !!}
    </div>

    <div class="col-sm-8">
        @if(count($brands))

            @include('layouts.partials.alerts')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Products</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($brands as $brand)
                        <tr>
                            <td>{{$brand->id}}</td>
                            <td><a href="{{route('admin.brands.edit', $brand->id)}}">{{$brand->name}}</a></td>
                            <td><img height="50" src="{{$brand->photo ? $brand->photo->path : $brand->photoPlaceholder()}}" alt="image" /></td>
                            <td><a href="{{route('admin.brands.show', $brand->id)}}">{{$brand->products->count()}}</a></td>
                            <td>{{$brand->created_at->diffForHumans()}}</td>
                            <td>{{$brand->updated_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$brands->links()}}
                </div>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p>No Brands</p>
            </div>
        @endif
    </div>

@endsection