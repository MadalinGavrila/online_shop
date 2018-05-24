@extends('layouts.front')

@section('title', 'Order')

@section('navbar')
    @include('layouts.partials.front.navbar')
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12 col-sm-offset-2 col-md-12 col-md-offset-2">

            <h3 class="text-center">Order Summary</h3>

            <div class="row">
                <div class="col-sm-12 col-md-12">

                    <h4>Order #{{$order->id}}</h4>
                    <hr />

                    <div class="row">
                        <div class="col-sm-6 col-md-6">
                            <h4>Shipping to</h4>

                            <strong>Address:</strong> {{$order->address->address1}} <br />
                            @if($order->address->address2)
                                {{$order->address->address2}} <br />
                            @endif
                            <strong>Country:</strong> {{$order->address->country}} <br />
                            <strong>City:</strong> {{$order->address->city}} <br />
                            <strong>Postal Code:</strong> {{$order->address->postal_code}} <br />
                        </div>

                        <div class="col-sm-6 col-md-6">
                            <h4>Products</h4>

                            @foreach($order->products as $product)
                                <a href="{{route('home.products.show', $product->slug)}}">{{$product->name}} <span class="badge">x {{$product->pivot->quantity}}</span></a> <br />
                            @endforeach
                        </div>
                    </div>

                    <hr />

                    <p class="alert alert-success">
                        <strong>Order total:</strong> {{number_format($order->total, 2)}} &euro;
                    </p>

                </div>
            </div>

        </div>
    </div>

@endsection