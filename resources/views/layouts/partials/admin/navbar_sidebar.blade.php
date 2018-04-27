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
        <li class="{{Request::is('admin/categories*') ? 'active' : ''}} {{Request::is('admin/subCategories*') ? 'active' : ''}}">
            <a href="javascript:;" data-toggle="collapse" data-target="#categories"><i class="fa fa-tasks"></i> Categories <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="categories" class="collapse">
                <li>
                    <a href="{{route('admin.categories.index')}}"><i class="fa fa-tasks"></i> Categories</a>
                </li>
                <li>
                    <a href="{{route('admin.subCategories.index')}}"><i class="fa fa-tasks"></i> SubCategories</a>
                </li>
            </ul>
        </li>
        <li class="{{Request::is('admin/brands*') ? 'active' : ''}}">
            <a href="{{route('admin.brands.index')}}"><i class="fa fa-copyright"></i> Brands</a>
        </li>
        <li class="{{Request::is('admin/products*') ? 'active' : ''}}">
            <a href="javascript:;" data-toggle="collapse" data-target="#products"><i class="fa fa-list"></i> Products <i class="fa fa-fw fa-caret-down"></i></a>
            <ul id="products" class="collapse">
                <li>
                    <a href="{{route('admin.products.index')}}"><i class="fa fa-list-ul"></i> List Products</a>
                </li>
                <li>
                    <a href="{{route('admin.products.create')}}"><i class="fa fa-plus"></i> Create Products</a>
                </li>
            </ul>
        </li>
    </ul>
</div>