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
        <div class="alert alert-success text-center">
            <p>Search: {{request()->query('search')}}</p>
        </div>

        <div class="row">
            <div class="col-sm-3">
                <div class="panel-group">
                    @include('layouts.partials.ordering', [
                        'route' => 'home.search',
                        'route_params' => request()->only('search')
                    ])

                    @include('layouts.partials.filters', [
                        'route' => 'home.search',
                        'route_params' => request()->only('search')
                    ])
                </div>
            </div>

            <div class="col-sm-9">
                <div class="row">
                    @foreach($products as $product)
                        <div class="col-xs-6 col-sm-4 col-lg-4 col-md-4">
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
                                    <p class="pull-right">{{$product->reviews->count()}} reviews</p>
                                    <p>
                                        @for($i = 1; $i <= 5; $i++)
                                            @if($i <= floor($product->reviews->avg('rating')))
                                                <span class="glyphicon glyphicon-star"></span>
                                            @else
                                                <span class="glyphicon glyphicon-star-empty"></span>
                                            @endif
                                        @endfor
                                    </p>
                                </div>
                                <div class="product-buttons clear-left">
                                    @if($product->inStock())
                                        <form class="btn-add-to-cart" method="POST" action="{{route('cart.add', $product->slug)}}">
                                            @csrf
                                            <button type="submit" class="btn btn-link btn-xs">
                                                <span class="glyphicon glyphicon-shopping-cart"></span> Add
                                            </button>
                                        </form>
                                    @else
                                        <p class="btn-add-to-cart">
                                            <button type="button" class="btn btn-link btn-xs">
                                                <span class="label label-danger">Sold Out</span>
                                            </button>
                                        </p>
                                    @endif
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
                        {{$products->appends(request()->query())->links()}}
                    </div>
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