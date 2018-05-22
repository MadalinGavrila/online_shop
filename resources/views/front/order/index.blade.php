@extends('layouts.front')

@section('title', 'Order')

@section('navbar')
    @include('layouts.partials.front.navbar')
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12 col-sm-offset-2 col-md-12 col-md-offset-2">

            <h3 class="text-center">Order</h3>

            {!! Form::open(['method'=>'POST', 'action'=>'OrderController@store']) !!}

                <div class="col-sm-6 col-md-6">
                    <div class="well">
                        <h4 class="text-center">Shipping address</h4>
                        <hr />

                        <div class="form-group {{$errors->has('address1') ? 'has-error' : ''}}">
                            {!! Form::label('address1', 'Address line 1:') !!}
                            {!! Form::text('address1', null, ['class'=>'form-control']) !!}

                            @if($errors->has('address1'))
                                <span class="help-block">{{$errors->first('address1')}}</span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('address2') ? 'has-error' : ''}}">
                            {!! Form::label('address2', 'Address line 2:') !!}
                            {!! Form::text('address2', null, ['class'=>'form-control']) !!}

                            @if($errors->has('address2'))
                                <span class="help-block">{{$errors->first('address2')}}</span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('country') ? 'has-error' : ''}}">
                            <div class="col-xs-7 col-sm-7 col-md-7 row">
                                {!! Form::label('country', 'Country:') !!}
                                {!! Form::text('country', null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="clearfix"></div>

                            @if($errors->has('country'))
                                <span class="help-block">{{$errors->first('country')}}</span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('city') ? 'has-error' : ''}}">
                            <div class="col-xs-7 col-sm-7 col-md-7 row">
                                {!! Form::label('city', 'City:') !!}
                                {!! Form::text('city', null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="clearfix"></div>

                            @if($errors->has('city'))
                                <span class="help-block">{{$errors->first('city')}}</span>
                            @endif
                        </div>

                        <div class="form-group {{$errors->has('postal_code') ? 'has-error' : ''}}">
                            <div class="col-xs-5 col-sm-5 col-md-5 row">
                                {!! Form::label('postal_code', 'Postal Code:') !!}
                                {!! Form::text('postal_code', null, ['class'=>'form-control']) !!}
                            </div>
                            <div class="clearfix"></div>

                            @if($errors->has('postal_code'))
                                <span class="help-block">{{$errors->first('postal_code')}}</span>
                            @endif
                        </div>

                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="well">
                        <h4 class="text-center">Cart summary</h4>
                        <hr />

                        <table class="table">
                            @foreach($cart->all() as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->quantity}}</td>
                                </tr>
                            @endforeach
                        </table>

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

                        <h4 class="text-center">Payment</h4>
                        <hr />

                        <div id="payment"></div>

                        <div class="form-group">
                            {!! Form::submit('Place order', ['class'=>'btn btn-success']) !!}
                        </div>

                    </div>
                </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

@section('scripts')

    <script src="https://js.braintreegateway.com/js/braintree-2.32.1.min.js"></script>

    <script>

        $.ajax({
            url: '{{route('braintree.token')}}',
            type: 'get',
            dataType: 'json'
        }).success(function(data){
            braintree.setup(data.token, 'dropin', {
                container: 'payment'
            });
        });

    </script>

@endsection