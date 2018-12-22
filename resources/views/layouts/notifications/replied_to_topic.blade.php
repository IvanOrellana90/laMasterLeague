<a class="list-group-item dropdown-item" href="{{ route('forum') }}" role="menuitem">
    <div class="media">
        <div class="pr-10">
            <i class="icon fa fa-comment bg-blue-600 white icon-circle" aria-hidden="true"></i>
        </div>
        <div class="media-body">
            <p class="media-heading name"><span class="blue-500">{{ $notification->data['user']['name'] }}</span> respondió a tu mensaje <br>
                <span class="blue-500">{{ $notification->data['reply']['topic']['title'] }}</span></p>
            <time class="media-meta date" datetime="{{ $notification->created_at }}">{{ date('d-m-Y', strtotime($notification->created_at)) }}</time>
        </div>
    </div>
</a>