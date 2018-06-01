@extends('layouts.front')

@section('title', 'Account')

@section('navbar')
    @include('layouts.partials.front.navbar')
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12 col-sm-offset-2 col-md-12 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div>
                        <span>Orders</span>

                        <a href="{{route('account')}}" class="pull-right btn btn-primary btn-xs account-profile-btn"><span class="glyphicon glyphicon-user"></span> Profile</a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-md-12 col-sm-12">
                        <div class="well text-center">{{$user->full_name}}</div>

                        @if($orders->count())
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>View</th>
                                            <th>Total</th>
                                            <th>Paid</th>
                                            <th>Created</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orders as $order)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>
                                                <td><a href="{{route('order.show', $order->hash)}}">View Order</a></td>
                                                <td>{{number_format($order->total, 2)}} &euro;</td>
                                                @if($order->paid)
                                                    <td><span class="label label-success">Yes</span></td>
                                                @else
                                                    <td><span class="label label-danger">No</span></td>
                                                @endif
                                                <td>{{$order->created_at->toDayDateTimeString()}}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-5">
                                    {{$orders->links()}}
                                </div>
                            </div>
                        @else
                            <div class="alert alert-success text-center">
                                <p>No Orders</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection