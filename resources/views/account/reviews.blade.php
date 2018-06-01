@extends('layouts.front')

@section('title', 'Account')

@section('navbar')
    @include('layouts.partials.front.navbar')
@endsection

@section('content')

    @include('layouts.partials.delete_modal')

    <div class="row">
        <div class="col-sm-12 col-sm-offset-2 col-md-12 col-md-offset-2">

            <div class="panel panel-default">
                <div class="panel-heading">
                    <div>
                        <span>Reviews</span>

                        <a href="{{route('account')}}" class="pull-right btn btn-primary btn-xs account-profile-btn"><span class="glyphicon glyphicon-user"></span> Profile</a>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="col-md-12 col-sm-12">
                        <div class="well text-center">{{$user->full_name}}</div>

                        @include('layouts.partials.alerts')

                        @if($reviews->count())
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Product</th>
                                        <th>Review</th>
                                        <th>Rating</th>
                                        <th>Created</th>
                                        <th>Delete</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($reviews as $review)
                                        <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td><a href="{{route('home.products.show', $review->product->slug)}}">View Product</a></td>
                                            <td>{{$review->body}}</td>
                                            <td>{{$review->rating}} stars</td>
                                            <td>{{$review->created_at->toDayDateTimeString()}}</td>
                                            <td>
                                                {!! Form::open(['method'=>'DELETE', 'action'=>['Account\AccountController@destroy_review', $review->id], 'class'=>'form-delete']) !!}

                                                    <div class="form-group">
                                                        {!! Form::submit('Delete', ['class'=>'btn btn-danger btn-xs']) !!}
                                                    </div>

                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div class="row">
                                <div class="col-sm-6 col-sm-offset-5">
                                    {{$reviews->links()}}
                                </div>
                            </div>
                        @else
                            <div class="alert alert-success text-center">
                                <p>No Reviews</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

        </div>
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