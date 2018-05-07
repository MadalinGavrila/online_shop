@extends('layouts.front')

@section('title', 'Products')

@section('navbar')
    @include('layouts.partials.front.navbar')
@endsection

@section('category')
    @include('layouts.partials.front.category')
@endsection

@section('content')

    @include('layouts.partials.photo_modal')

        <div id="carousel-product-photos" class="carousel slide">
            <div class="carousel-inner">
                @foreach($product->photos as $photo)

                    @if(!($loop->index % 4))
                        <div class="item {{$loop->first ? 'active' : ''}}">
                            <div class="row">
                    @endif

                        <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                            <div class="thumbnail">
                                <img class="product-photo" src="{{$photo->path}}" alt="images" />
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
            <a data-slide="prev" href="#carousel-product-photos" class="left carousel-control carousel-control-product">‹</a>
            <a data-slide="next" href="#carousel-product-photos" class="right carousel-control carousel-control-product">›</a>
        </div>

        <div class="thumbnail product">
            <div class="caption-full">
                <h4 class="pull-right product-price"><span class="glyphicon glyphicon-euro"></span> {{$product->price}}</h4>
                <h4><a href="{{route('home.products.show', $product->slug)}}">{{$product->name}}</a></h4>
                <p>{{$product->description}}</p>
                <div class="product-button">
                   <p>
                       <button type="submit" class="btn btn-primary btn-xs">
                           <span class="product-btn-add glyphicon glyphicon-shopping-cart"></span> Add to Cart
                       </button>
                       <span class="product-stock pull-right label label-success">In Stock</span>
                   </p>
                </div>
            </div>
            <div class="ratings">
                <p class="pull-right">1 reviews</p>
                <p>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    4.0 stars
                </p>
            </div>
        </div>

        <div class="well">

            <div class="text-right">
                <a class="btn btn-primary">Leave a Review</a>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-12">
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star"></span>
                    <span class="glyphicon glyphicon-star-empty"></span>
                    Anonymous
                    <span class="pull-right">10 days ago</span>
                    <p>This product was great in terms of quality. I would definitely buy another!</p>
                </div>
            </div>

            <hr>

        </div>

@endsection

@section('footer')
    @include('layouts.partials.front.footer')
@endsection

@section('scripts')

    <script>

        $(document).ready(function(){

            $(".product-photo").on('click', function(){

                var img = $(this).attr("src");

                $(".product-photo-modal").attr("src", img);

                $("#photo_modal").modal();

            });

        });

    </script>

@endsection