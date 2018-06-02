<a href="{{route('admin.orders.show', $notification->data['order_id'])}}" class="list-group-item">
    <span class="badge">{{$notification->created_at->diffForHumans()}}</span>
    <i class="fa fa-truck"></i> New order created
</a>