@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Brands <small>Products</small>
    </h1>

    <div class="alert alert-info text-center">
        <p>{{$brand->name}}</p>
    </div>

    <div class="col-sm-12">
        @if(count($brand_products))

            @include('layouts.partials.alerts')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Photo</th>
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
                    @foreach($brand_products as $product)
                        <tr>
                            <td>{{$product->id}}</td>
                            <td><a href="">{{$product->name}}</a></td>
                            <td><img height="50" src="{{$product->photos->first() ? $product->photos->first()->path : $product->photoPlaceholder()}}" alt="image" /></td>
                            <td>{{$product->brands->first()->name}}</td>
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
                    {{$brand_products->links()}}
                </div>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p>No Products</p>
            </div>
        @endif
    </div>

@endsection