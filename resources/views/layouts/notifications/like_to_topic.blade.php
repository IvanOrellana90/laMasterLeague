<a class="list-group-item dropdown-item" href="{{ route('forum') }}" role="menuitem">
    <div class="media">
        <div class="pr-10">
            <i class="icon fa fa-thumbs-up bg-blue-600 white icon-circle" aria-hidden="true"></i>
        </div>
        <div class="media-body">
            <p class="media-heading name">Al usuario <span class="blue-500">{{ $notification->data['user']['name'] }}</span>< le gusto tu comentario</p>
            <time class="media-meta date" datetime="{{ $notification->created_at }}">{{ date('d-m-Y', strtotime($notification->created_at)) }}</time>
        </div>
    </div>
</a>