@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        SubCategories <small>Create / List</small>
    </h1>

    <div class="col-sm-6">
        <div class="col-sm-8 col-md-offset-2">

            @include('layouts.partials.form_errors')

            {!! Form::open(['method'=>'POST', 'action'=>'Admin\AdminSubCategoryController@store']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name:') !!}
                    {!! Form::text('name', null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('category_id', 'Category:') !!}
                    {!! Form::select('category_id', $categories, null, ['class'=>'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::submit('Create SubCategory', ['class'=>'btn btn-primary btn-block']) !!}
                </div>

            {!! Form::close() !!}
        </div>
    </div>

    <div class="col-sm-6">
        @if(count($subCategories))

            @include('layouts.partials.alerts')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($subCategories as $subCategory)
                        <tr>
                            <td>{{$subCategory->id}}</td>
                            <td><a href="{{route('admin.subCategories.edit', $subCategory->id)}}">{{$subCategory->name}}</a></td>
                            <td><a href="{{route('admin.categories.show', $subCategory->category->id)}}">{{$subCategory->category->name}}</a></td>
                            <td>{{$subCategory->created_at->diffForHumans()}}</td>
                            <td>{{$subCategory->updated_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$subCategories->links()}}
                </div>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p>No SubCategories</p>
            </div>
        @endif
    </div>

@endsection