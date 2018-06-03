@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    @include('layouts.partials.delete_modal')

    <h1 class="page-header">
        Reviews <small>List</small>
    </h1>

    <div class="col-sm-12">
        @if(count($reviews))

            @include('layouts.partials.alerts')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>User</th>
                            <th>Product</th>
                            <th>Body</th>
                            <th>Rating</th>
                            <th>Created</th>
                            <th>Updated</th>
                            @can('delete reviews')
                                <th>Delete</th>
                            @endcan
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($reviews as $review)
                        <tr>
                            <td>{{$review->id}}</td>
                            <td>{{$review->user->full_name}}</td>
                            <td><a href="{{route('home.products.show', $review->product->slug)}}">View Product</a></td>
                            <td>{{$review->body}}</td>
                            <td>{{$review->rating}} stars</td>
                            <td>{{$review->created_at->diffForHumans()}}</td>
                            <td>{{$review->updated_at->diffForHumans()}}</td>
                            <td>
                                @can('delete reviews')
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminReviewController@destroy', $review->id], 'class'=>'form-delete']) !!}

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
                    {{$reviews->links()}}
                </div>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p>No Reviews</p>
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