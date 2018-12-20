<a class="list-group-item dropdown-item" href="{{ route('forum') }}" role="menuitem">
    <div class="media">
        <div class="pr-10">
            <i class="icon fa fa-comment bg-blue-600 white icon-circle" aria-hidden="true"></i>
        </div>
        <div class="media-body">
            <p class="media-heading name"><strong>{{ $notification->data['user']['name'] }}</strong> respondió a tu mensaje <br> <strong>{{ $notification->data['reply']['topic']['title'] }}</strong></p>
            <time class="media-meta date" datetime="{{ $notification->created_at }}">{{ date('d-m-Y', strtotime($notification->created_at)) }}</time>
        </div>
    </div>
</a>