@extends('layouts.front')

@section('title', 'Home')

@section('navbar')
    @include('layouts.partials.front.navbar')
@endsection

@section('flash_message')
    @include('layouts.partials.alerts')
@endsection

@section('category')
    @include('layouts.partials.front.category')
@endsection

@section('carousel')
    @include('layouts.partials.front.carousel')
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="controls pull-right">
                <a class="left glyphicon glyphicon-chevron-left btn btn-primary btn-xs" href="#products-carousel" data-slide="prev"></a>
                <a class="right glyphicon glyphicon-chevron-right btn btn-primary btn-xs" href="#products-carousel" data-slide="next"></a>
            </div>
        </div>
    </div>
    <div id="products-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            @foreach($products as $product)
                @if(!($loop->index % 4))
                    <div class="item {{$loop->first ? 'active' : ''}}">
                        <div class="row">
                @endif

                <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                    <div class="col-item">
                        <div class="photo">
                            <a href="{{route('home.products.show', $product->slug)}}">
                                <img src="{{$product->photos->first() ? $product->photos->first()->path : $product->photoPlaceholder()}}" class="img-responsive" alt="images" />
                            </a>
                        </div>
                        <div class="info">
                            <div class="row">
                                <div class="details col-sm-12">
                                    <p class="name">{{$product->name}}</p>
                                    <p class="price"><span class="glyphicon glyphicon-euro"></span> {{$product->price}}</p>
                                </div>
                            </div>
                            <div class="separator clear-left">
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
                </div>

                @if(!($loop->iteration % 4))
                        </div>
                    </div>
                @endif

                @if($loop->count % 4)
                    @if($loop->last)
                        </div>
                    </div>
                    @endif
                @endif
            @endforeach
        </div>
    </div>

@endsection

@section('footer')
    @include('layouts.partials.front.footer')
@endsection