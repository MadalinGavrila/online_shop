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

    @if(count($product->photos))
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
    @endif

    <div class="thumbnail product">
        <div class="caption-full">
            <h4 class="pull-right product-price"><span class="glyphicon glyphicon-euro"></span> {{$product->price}}</h4>
            <h4><a href="{{route('home.products.show', $product->slug)}}">{{$product->name}}</a></h4>
            <p>{{$product->description}}</p>
            <div class="product-button">
                <p>
                    @if($product->outOfStock())
                        <div class="text-center">
                            <span class="product-stock label label-danger">Sold Out</span>
                        </div>
                    @else
                        <form method="POST" action="{{route('cart.add', $product->slug)}}">
                            @csrf

                            <button type="submit" class="btn btn-primary btn-xs">
                                <span class="product-btn-add glyphicon glyphicon-shopping-cart"></span> Add to Cart
                            </button>

                            @if($product->hasLowStock())
                                <span class="product-stock pull-right label label-warning">Low Stock</span>
                            @else
                                <span class="product-stock pull-right label label-success">In Stock</span>
                            @endif
                        </form>
                    @endif
                </p>
            </div>
        </div>
        <div class="ratings">
            <p class="pull-right">{{$reviews->count()}} reviews</p>
            <p>
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= floor($reviews->avg('rating')))
                        <span class="glyphicon glyphicon-star"></span>
                    @else
                        <span class="glyphicon glyphicon-star-empty"></span>
                    @endif
                @endfor
                {{number_format($reviews->avg('rating'), 2)}} stars
            </p>
        </div>
    </div>

    <div class="well">

        @if(auth()->check())

            @include('layouts.partials.form_errors')

            @include('layouts.partials.alerts')

            <div class="text-right">
                <a href="#" class="btn btn-primary" id="open-review-box">Leave a Review</a>
            </div>

            <div class="row" id="post-review-box" style="display: none;">
                <div class="col-sm-12 col-md-12">
                    {!! Form::open(['method'=>'POST', 'action'=>'ReviewController@store']) !!}

                        <input type="hidden" name="product_id" value="{{$product->id}}" />

                        {!! Form::textarea('review', null, ['class'=>'form-control', 'rows'=>2, 'placeholder'=>'Enter your review here...', 'style'=>'resize: vertical;']) !!}

                        <div class="text-right">
                            <div class="ratings star-review">
                                @for($i = 1; $i <= 5; $i++)
                                    <label>
                                        <input type="radio" name="rating" value="{{$i}}" onclick="add({{$i}})" /><span id="star{{$i}}" class="glyphicon glyphicon-star-empty"></span>
                                    </label>
                                @endfor
                            </div>

                            <a href="#" class="btn btn-danger btn-xs" id="close-review-box">
                                <span class="glyphicon glyphicon-remove"></span> Cancel
                            </a>

                            {!! Form::submit('Save', ['class'=>'btn btn-success btn-xs']) !!}
                        </div>

                    {!! Form::close() !!}
                </div>
            </div>

            <hr>
        @endif

        @if($reviews->count())
            @foreach($reviews as $review)
                <div class="row">
                    <div class="col-md-12">
                        @for($i = 1; $i <= 5; $i++)
                           @if($i <= $review->rating)
                                <span class="glyphicon glyphicon-star"></span>
                           @else
                                <span class="glyphicon glyphicon-star-empty"></span>
                           @endif
                        @endfor

                        {{$review->user->full_name}}
                        <span class="pull-right">{{$review->created_at->diffForHumans()}}</span>
                        <p>{{$review->body}}</p>
                    </div>
                </div>

                <hr>
            @endforeach
        @endif

    </div>

@endsection

@section('footer')
    @include('layouts.partials.front.footer')
@endsection

@section('scripts')

    <script>

        // Photo Modal

        $(document).ready(function(){

            $(".product-photo").on('click', function(){

                var img = $(this).attr("src");

                $(".product-photo-modal").attr("src", img);

                $("#photo_modal").modal();

            });

        });

        // Star Rating

        function add(star_number){

            for(var i = 1; i <= 5; i++){
                var star = document.getElementById("star" + i);
                star.className = "glyphicon glyphicon-star-empty";
            }

            for(var i = 1; i <= star_number; i++){
                var star = document.getElementById("star" + i);
                if(star.className == "glyphicon glyphicon-star-empty"){
                    star.className = "glyphicon glyphicon-star";
                }
            }

        }

        // Review Box

        var openReviewBox = $("#open-review-box");
        var postReviewBox = $("#post-review-box");
        var closeReviewBox = $("#close-review-box");

        openReviewBox.click(function(e){
            e.preventDefault();
            postReviewBox.slideDown(400);
            openReviewBox.fadeOut(100);
        });

        closeReviewBox.click(function(e){
            e.preventDefault();
            postReviewBox.slideUp(300, function(){
                openReviewBox.fadeIn(200);
            });
        });

    </script>

@endsection