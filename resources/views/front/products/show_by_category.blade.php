@extends('layouts.front')

@section('title', 'Products')

@section('navbar')
    @include('layouts.partials.front.navbar')
@endsection

@section('category')
    @include('layouts.partials.front.category')
@endsection

@section('content')

    @if(count($products))
        <div class="col-sm-3">

        </div>

        <div class="col-sm-9">
            <div class="row">
                @foreach($products as $product)
                    <div class="col-xs-4 col-sm-4 col-lg-4 col-md-4">
                        <div class="thumbnail products">
                            <div class="product-photo">
                                <a href="{{route('home.products.show', $product->slug)}}">
                                    <img src="{{$product->photos->first() ? $product->photos->first()->path : $product->photoPlaceholder()}}" alt="images" />
                                </a>
                            </div>
                            <div class="product-info">
                                <p class="product-name">{{$product->name}}</p>
                                <p class="product-price"><span class="glyphicon glyphicon-euro"></span> {{$product->price}}</p>
                            </div>
                            <div class="ratings">
                                <p class="pull-right">10 reviews</p>
                                <p>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                    <span class="glyphicon glyphicon-star"></span>
                                </p>
                            </div>
                            <div class="product-buttons clear-left">
                                <p class="btn-add-to-cart">
                                    <span class="glyphicon glyphicon-shopping-cart"></span> Add
                                </p>
                                <p class="btn-details">
                                    <a href="{{route('home.products.show', $product->slug)}}">Details</a>
                                </p>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                    {{$products->links()}}
                </div>
            </div>

        </div>
    @else
        <div class="alert alert-success text-center">
            <p>No Products</p>
        </div>
    @endif

@endsection

@section('footer')
    @include('layouts.partials.front.footer')
@endsection