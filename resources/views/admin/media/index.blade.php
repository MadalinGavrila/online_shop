@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    @include('layouts.partials.delete_modal')

    <h1 class="page-header">
        Photos <small>List</small>
    </h1>

    <div class="col-sm-12">
        @if(count($photos))

            @include('layouts.partials.alerts')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Photo</th>
                        <th>From</th>
                        @can('delete photos')
                            <th>Delete</th>
                        @endcan
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($photos as $photo)
                        <tr>
                            <td>{{$photo->id}}</td>
                            <td><img height="50" src="{{$photo->path}}" alt="" /></td>
                            <td><a href="{{route($photo->imageable->getRoute(), $photo->imageable->id)}}">{{$photo->imageable->getName()}}</a></td>
                            <td>
                                @can('delete photos')
                                    {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminMediaController@destroy', $photo->id], 'class'=>'form-delete']) !!}

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
                    {{$photos->links()}}
                </div>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p>No Photos</p>
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