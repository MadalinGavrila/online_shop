@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    @include('layouts.partials.delete_modal')

    <h1 class="page-header">
        Notifications <small>List</small>
    </h1>

    <div class="col-sm-12">
        @if(count($notifications))

            @include('layouts.partials.alerts')

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Type</th>
                            <th>Mark As Read</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($notifications as $notification)
                        <tr>
                            <td>@include('admin.notifications.partials.' . snake_case(class_basename($notification->type)))</td>
                            <td>
                                @if(!$notification->read_at)
                                    {!! Form::open(['method'=>'PATCH', 'action'=>['Admin\AdminNotificationsController@update', $notification->id]]) !!}

                                        <div class="form-group">
                                            {!! Form::submit('Mark As Read', ['class'=>'notification-button btn btn-primary btn-xs']) !!}
                                        </div>

                                    {!! Form::close() !!}
                                @else
                                    <div class="notification-button">
                                        <span class="glyphicon glyphicon-ok"></span> Seen
                                    </div>
                                @endif
                            </td>
                            <td>
                                {!! Form::open(['method'=>'DELETE', 'action'=>['Admin\AdminNotificationsController@destroy', $notification->id], 'class'=>'form-delete']) !!}

                                    <div class="form-group">
                                        {!! Form::submit('Delete', ['class'=>'notification-button btn btn-danger btn-xs']) !!}
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
                    {{$notifications->links()}}
                </div>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p>No Notifications</p>
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