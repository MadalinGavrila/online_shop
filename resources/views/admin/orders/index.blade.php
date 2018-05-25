@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    @include('layouts.partials.delete_modal')

    <h1 class="page-header">
        Orders <small>List</small>
    </h1>

    <div class="col-sm-12">
        @if(count($orders))

            @include('layouts.partials.alerts')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>View</th>
                        <th>Paid</th>
                        <th>Total</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Delete</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->id}}</td>
                            <td><a href="{{route('admin.orders.show', $order->id)}}">View Order</a></td>
                            @if($order->paid)
                                <td><span class="label label-success">Yes</span></td>
                            @else
                                <td><span class="label label-danger">No</span></td>
                            @endif
                            <td>{{number_format($order->total, 2)}} &euro;</td>
                            <td>{{$order->created_at->diffForHumans()}}</td>
                            <td>{{$order->updated_at->diffForHumans()}}</td>
                            <td>
                                @can('delete orders')
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminOrderController@destroy', $order->id], 'class'=>'form-delete']) !!}

                                    <div class="form-group">
                                        {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-xs']) !!}
                                    </div>

                                    {!! Form::close() !!}
                                @endcan
                            </td>
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

@endsection

@section('scripts')

    <script>

        $(document).ready(function(){

            $(".form-delete").on('click', function(e){

                e.preventDefault();

                var form = $(this);

                $("#delete_modal").modal({ backdrop: 'static', keyboard: false }).on('click', '#delete-btn', function(){

                    form.submit();

                });

            });

        });

    </script>

@endsection