<div id="conversation" class="conversation active">
    <div class="conversation-header">
        <a class="conversation-more float-right" href="javascript:void(0)">
            <i class="icon wb-more-horizontal" aria-hidden="true"></i>
        </a>
        <a class="conversation-return float-left" data-toggle="site-sidebar" href="javascript:void(0)" title="Chat"
           data-url="{{ route('chat') }}">
            <i class="icon wb-chevron-left" aria-hidden="true"></i>
        </a>
        <div class="conversation-title">{{ $group->name }}</div>
    </div>
    <div class="chats">
        @if($group->messages->count() == 0)
            <div class="chat">
                <p>
                    No se han ingresado comentarios, se el primero!
                </p>
            </div>
        @endif
        @foreach($group->messages as $message)
            @if( Auth::id() != $message->user->id )
                <div class="chat chat-left">
                    <div class="chat-avatar">
                        <a class="avatar" data-toggle="tooltip" href="{{ route('user', $message->user->id) }}" data-placement="left" title="{{ $message->user->name }}">
                            <img src="{{ URL::to('img/avatars') }}/{{ $message->user->avatar->img }}" alt="{{ $message->user->name }}">
                        </a>
                    </div>
                    <div class="chat-body">
                        <div class="chat-content">
                            <p>
                                {{ $message->content }}
                            </p>
                            <time class="chat-time" datetime="2018-06-01">{{ date('d-m-Y', strtotime($message->created_at)) }}</time>
                        </div>
                    </div>
                </div>
            @else
                <div class="chat">
                    <div class="chat-avatar">
                        <a class="avatar" data-toggle="tooltip" href="{{ route('user', $message->user->id) }}" data-placement="right" title="{{ $message->user->name }}">
                            <img src="{{ URL::to('img/avatars') }}/{{ $message->user->avatar->img }}" alt="{{ $message->user->name }}">
                        </a>
                    </div>
                    <div class="chat-body">
                        <div class="chat-content">
                            <p>
                                {{ $message->content }}
                            </p>
                            <time class="chat-time" datetime="2018-06-01">{{ date('d-m-Y', strtotime($message->created_at)) }}</time>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    </div>
    <div class="conversation-reply">
        <form id="groupChatForm">
            <div class="input-group">
                <input required id="groupChatMessage" class="form-control" type="text" placeholder="Escribe algo">
                <span class="input-group-append">
                <button class="btn btn-success mr-20" id="ajaxSubmit" data-url="{{ route('chatMessage', $group->id) }}" data-toggle="site-sidebar">Enviar</button>
            </span>
            </div>
        </form>
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        jQuery('#ajaxSubmit').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ route('message.storeAjax') }}",
                method: 'post',
                data: {
                    content: jQuery('#groupChatMessage').val(),
                    group_id: "{{ $group->id }}",
                },
                success: function(result){
                    console.log(result);
                    jQuery('#groupChatMessage').val("");
                    $(this).click();
                },
                error:function(result) {
                    console.log(result);
                }
            });
        });
    });
</script>
