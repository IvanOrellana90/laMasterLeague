<a class="list-group-item dropdown-item" href="{{ route('user.profile') }}" role="menuitem">
    <div class="media">
        <div class="pr-10">
            <i class="icon fa fa-trophy bg-yellow-600 white icon-circle" aria-hidden="true"></i>
        </div>
        <div class="media-body">
            <p class="media-heading name">{{ $notification->data['description'] }}<br> Desbloqueaste a <strong>Thierry Henry</strong></p>
            <time class="media-meta date" datetime="{{ $notification->created_at }}">{{ date('d-m-Y', strtotime($notification->created_at)) }}</time>
        </div>
    </div>
</a>