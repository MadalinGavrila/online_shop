@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Payments <small>List</small>
    </h1>

    <div class="col-sm-12">
        @if(count($payments))

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Order</th>
                        <th>Failed</th>
                        <th>Transaction Id</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($payments as $payment)
                        <tr>
                            <td>{{$payment->id}}</td>
                            <td><a href="{{route('admin.orders.show', $payment->order->id)}}">View Order</a></td>
                            @if($payment->failed)
                                <td><span class="label label-danger">Yes</span></td>
                                <td><span class="label label-danger">Failed</span></td>
                            @else
                                <td><span class="label label-success">No</span></td>
                                <td>{{$payment->transaction_id}}</td>
                            @endif
                            <td>{{$payment->created_at->diffForHumans()}}</td>
                            <td>{{$payment->updated_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$payments->links()}}
                </div>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p>No Payments</p>
            </div>
        @endif
    </div>

@endsection