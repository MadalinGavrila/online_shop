@extends('layouts.admin')

@section('title', 'Admin')

@section('content')

    <h1 class="page-header">
        Users <small>List</small>
    </h1>

    <div class="col-sm-12">
        @if(count($users))

            @include('layouts.partials.alerts')

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Permissions</th>
                        <th>Status</th>
                        <th>Created</th>
                        <th>Updated</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{$user->id}}</td>
                            <td><a href="{{route('admin.users.edit', $user->id)}}">{{$user->full_name}}</a></td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->roles->first() ? $user->roles->first()->name : 'No Role'}}</td>
                            <td><a href="{{route('admin.users.show', $user->id)}}">{{$user->permissions->count()}}</a></td>
                            <td>
                                @if($user->active)
                                    Active
                                @else
                                    Not Active
                                @endif
                            </td>
                            <td>{{$user->created_at->diffForHumans()}}</td>
                            <td>{{$user->updated_at->diffForHumans()}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row">
                <div class="col-sm-6 col-sm-offset-5">
                    {{$users->links()}}
                </div>
            </div>
        @else
            <div class="alert alert-success text-center">
                <p>No Users</p>
            </div>
        @endif
    </div>

@endsection