@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Orders <small>Detail</small>
    </h1>

    <div class="alert alert-info text-center">
        <p><strong>Order:</strong> {{$order->hash}}</p>
    </div>

    <div class="row">
        <div class="col-sm-12">

            <div class="row">
                <div class="col-sm-6">
                    <h4>Shipping to:</h4>

                    <strong>User:</strong> {{$order->user->full_name}} <br />
                    <strong>Address:</strong> {{$order->address->address1}} <br />
                    @if($order->address->address2)
                        {{$order->address->address2}} <br />
                    @endif
                    <strong>Country:</strong> {{$order->address->country}} <br />
                    <strong>City:</strong> {{$order->address->city}} <br />
                    <strong>Postal Code:</strong> {{$order->address->postal_code}}
                </div>

                <div class="col-sm-6">
                    <h4>Products:</h4>

                    @foreach($order->products as $product)
                        <a href="{{route('home.products.show', $product->slug)}}">{{$product->name}} <span class="badge">x {{$product->pivot->quantity}}</span></a> <br />
                    @endforeach
                </div>
            </div>

            <hr />

            <div class="row">
                <div class="col-sm-6">
                    <h4>Order total:</h4>

                    {{number_format($order->total, 2)}} &euro;
                </div>

                <div class="col-sm-6">
                    <h4>Payment:</h4>

                    @if($order->payment->failed)
                        <span class="label label-danger">Failed</span>
                    @else
                        <strong>Transaction Id:</strong> {{$order->payment->transaction_id}}
                    @endif
                </div>
            </div>

        </div>
    </div>

@endsection