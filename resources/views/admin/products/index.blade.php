@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Products <small>List</small>
    </h1>

    <div class="col-sm-12">
        @if(count($products))

            @include('layouts.partials.alerts')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Photos</th>
                        <th>Brand</th>
                        <th>SubCategories</th>
                        <th>Price</th>
                        <th>Stock</th>
                        <th>Visible</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Edit</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><a href="{{route('home.products.show', $product->slug)}}">{{$product->name}}</a></td>
                            <td><a href="{{route('admin.products.showPhotos', $product->id)}}">{{$product->photos->count()}}</a></td>
                            <td>
                                @if($product->brands->first())
                                    <a href="{{route('admin.brands.show', $product->brands->first()->id)}}">{{$product->brands->first()->name}}</a>
                                @else
                                    No Brand
                                @endif
                            </td>
                            <td><a href="{{route('admin.products.show', $product->id)}}">{{$product->subCategories->count()}}</a></td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->stock}}</td>
                            <td>{{$product->visible ? 'Yes' : 'No'}}</td>
                            <td>{{$product->created_at->diffForHumans()}}</td>
                            <td>{{$product->updated_at->diffForHumans()}}</td>
                            <td><a href="{{route('admin.products.edit', $product->id)}}" class="btn btn-primary btn-xs">Edit</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$products->links()}}
                </div>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p>No Products</p>
            </div>
        @endif
    </div>

@endsection