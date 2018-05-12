<div class="panel panel-success">
    <div class="panel-heading">ORDER</div>
    <div class="list-group">
        <select class="form-control list-group-item" onchange="window.location.href = this.value;">
            @foreach($ordering as $key => $map)
                @foreach($map as $value => $name)
                    <option {{request($key) === $value ? 'selected' : ''}} value="{{route($route, $route_params + array_merge(request()->query(), [$key => $value, 'page' => 1]))}}">{{$name}}</option>
                @endforeach
            @endforeach
        </select>
    </div>
</div>