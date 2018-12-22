<a class="list-group-item dropdown-item" href="{{ route('groups') }}" role="menuitem">
    <div class="media">
        <div class="pr-10">
            <i class="icon fa fa-users bg-green-600 white icon-circle" aria-hidden="true"></i>
        </div>
        <div class="media-body">
            <p class="media-heading name"><span class="blue-500">{{ $notification->data['user']['name'] }}</span> te invitó a su grupo <br>
                <span class="blue-500">{{ $notification->data['group']['name']}}</span></p>
            <time class="media-meta date" datetime="{{ $notification->created_at }}">{{ date('d-m-Y', strtotime($notification->created_at)) }}</time>
        </div>
    </div>
</a>