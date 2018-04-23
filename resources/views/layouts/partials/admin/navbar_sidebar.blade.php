<div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav side-nav">
        <li class="{{Request::is('admin') ? 'active' : ''}}">
            <a href="{{route('admin')}}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
        </li>
        @can('crud roles')
            <li class="{{Request::is('admin/roles*') ? 'active' : ''}}">
                <a href="{{route('admin.roles.index')}}"><i class="fa fa-exclamation-triangle"></i> Roles</a>
            </li>
        @endcan
        @can('crud permissions')
            <li class="{{Request::is('admin/permissions*') ? 'active' : ''}}">
                <a href="{{route('admin.permissions.index')}}"><i class="fa fa-exclamation-triangle"></i> Permissions</a>
            </li>
        @endcan
        @can('crud users')
            <li class="{{Request::is('admin/users*') ? 'active' : ''}}">
                <a href="{{route('admin.users.index')}}"><i class="fa fa-users"></i> Users</a>
            </li>
        @endcan
        <li>
            <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="demo" class="collapse">
                <li>
                    <a href="">Dropdown Item</a>
                </li>
            </ul>
        </li>
    </ul>
</div>