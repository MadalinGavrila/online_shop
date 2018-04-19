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
        <div class="col-sm-4 col-lg-4 col-md-4">
            <div class="thumbnail">
                <img src="http://placehold.it/320x150" alt="">
                <div class="caption">
                    <h4 class="pull-right">$24.99</h4>
                    <h4><a href="#">First Product</a>
                    </h4>
                    <p>See more snippets like this online store item at <a target="_blank" href="http://www.bootsnipp.com">Bootsnipp - http://bootsnipp.com</a>.</p>
                </div>
                <div class="ratings">
                    <p class="pull-right">15 reviews</p>
                    <p>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                        <span class="glyphicon glyphicon-star"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('footer')
    @include('layouts.partials.front.footer')
@endsection