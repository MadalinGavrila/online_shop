<a href="{{route('home.products.show', $notification->data['product_slug'])}}" class="list-group-item" data-notification-id="{{$notification->id}}">
    <span class="badge">{{$notification->created_at->diffForHumans()}}</span>
    <i class="fa fa-comments"></i> New review posted
</a>