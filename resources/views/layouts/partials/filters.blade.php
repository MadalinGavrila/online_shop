<div class="panel panel-success">
    <div class="panel-heading">FILTERS</div>
    @if(count(array_intersect(array_keys(request()->query()), array_keys($filters))))
        <div class="list-group">
            <a href="{{route($route, $route_params)}}" class="list-group-item list-group-item-warning">&times; Clear all filters</a>
        </div>
    @endif
</div>
@foreach($filters as $key => $map)
    <div class="panel panel-default">
        <div class="panel-heading">{{ucfirst($key)}} Filter</div>
        <div class="list-group">
            @foreach($map as $value => $name)
                <a href="{{route($route, $route_params + array_merge(request()->query(), [$key => $value, 'page' => 1]))}}" class="list-group-item {{request($key) === $value ? 'active' : ''}}">{{$name}}</a>
            @endforeach

            @if(request($key))
                <a href="{{route($route, $route_params + array_except(request()->query(), [$key, 'page']))}}" class="list-group-item list-group-item-info">&times; Clear this filter</a>
            @endif
        </div>
    </div>
@endforeach