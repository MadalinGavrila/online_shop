@extends('layouts.front')

@section('title', 'Cart')

@section('navbar')
    @include('layouts.partials.front.navbar')
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12 col-sm-offset-2 col-md-12 col-md-offset-2">

            <h3 class="text-center">Shopping Cart</h3>

            @if($cart->itemCount())
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cart->all() as $product)
                            <tr>
                                <td>
                                    <img height="50" src="{{$product->photos->first() ? $product->photos->first()->path : $product->photoPlaceholder()}}" alt="image" />
                                    <a href="{{route('home.products.show', $product->slug)}}">{{$product->name}}</a>
                                </td>
                                <td>
                                    <form action="{{route('cart.update', $product->slug)}}" method="POST" class="form-inline">
                                        @csrf
                                        <select name="quantity" class="form-control input-sm">
                                            @for($i = 1; $i <= $product->stock; $i++)
                                                <option value="{{$i}}" {{$i == $product->quantity ? 'selected' : ''}}>{{$i}}</option>
                                            @endfor
                                            <option value="0">None</option>
                                        </select>
                                        <input type="submit" value="Update" class="btn btn-default btn-sm" />
                                    </form>

                                    <span class="errors">{{session()->has('quantity_exceeded_' . $product->id) ? session('quantity_exceeded_' . $product->id) : ''}}</span>
                                </td>
                                <td>{{number_format($product->price, 2)}} &euro;</td>
                                <td>
                                    <form action="{{route('cart.remove', $product->slug)}}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-link btn-xs">
                                            <span class="glyphicon glyphicon-trash"></span>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="col-sm-4 col-sm-offset-8 col-md-4 col-md-offset-8">
                    <div class="row">
                        <div class="well">
                            <h4 class="text-center">Cart summary</h4>

                            <table class="table">
                                <tr>
                                    <td>Sub total</td>
                                    <td>{{number_format($cart->subTotal(), 2)}} &euro;</td>
                                </tr>
                                <tr>
                                    <td>Shipping</td>
                                    <td>{{number_format($cart->shipping(), 2)}} &euro;</td>
                                </tr>
                                <tr>
                                    <td class="success">Total</td>
                                    <td class="success">{{number_format($cart->total(), 2)}} &euro;</td>
                                </tr>
                            </table>

                            @if(auth()->check())
                                <a href="{{route('order')}}" class="btn btn-success">Checkout</a>
                            @else
                                <p class="alert alert-info">To Checkout you need to <a href="{{route('login')}}">login</a> or <a href="{{route('register')}}">register</a>.</p>
                            @endif

                        </div>
                    </div>
                </div>
            @else
                <div class="alert alert-success text-center">
                    <p><span class="glyphicon glyphicon-shopping-cart"></span> Your Shopping Cart is Empty</p>
                </div>
            @endif

        </div>
    </div>

@endsection