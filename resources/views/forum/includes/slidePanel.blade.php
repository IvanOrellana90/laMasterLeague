<header class="slidePanel-header" style="background-color: {{ colorCategory($topic->category) }}">
    <div class="slidePanel-actions" aria-label="actions" role="group">
        <button type="button" class="btn btn-pure btn-inverse slidePanel-close actions-top icon wb-close"
                aria-hidden="true"></button>
    </div>
    <h1>
        {{ $topic->title }}
        @if(Auth::id() == $topic->user->id)
            <a style="color: white;" class="btn btn-icon btn-pure btn-default" href="{{ route('topic.destroy', $topic->id) }}"><i class="icon fa-trash-o" aria-hidden="true"></i></a>
        @endif
    </h1>
</header>
<div class="slidePanel-inner handler">
    <section class="slidePanel-inner-section handler">
        <div class="forum-header">
            <span class="name">{{ $topic->user->name }}</span>
            <span class="time">{{ date('d-m-Y', strtotime($topic->created_at)) }}</span>
        </div>
        <div class="forum-content">
            <p>{!! $topic->content !!}</p>
        </div>
        <div class="forum-metas">
            <div class="float-right">
                @if(doYouLike('topic', $topic->id))
                    <button type="button" class="btn btn-icon btn-pure btn-default">
                        <i class="icon far fa-thumbs-up blue-800" aria-hidden="true"></i>
                    </button>
                @else
                    <button type="button" class="btn btn-icon btn-pure btn-default giveLikeTopic" name="topic_id" value="{{ $topic->id }}" data-url="{{ route('forum.slidePanel', $topic->id) }}" data-toggle="slidePanel">
                        <i class="icon far fa-thumbs-up" aria-hidden="true"></i>
                    </button>
                @endif
                <span class="num btn btn-icon btn-pure btn-default">{{ countLikes('topic', $topic->id) }}</span>
            </div>
            <div class="button-group share">
                Compartir:
                <a href="https://twitter.com/intent/tweet?url=http%3A%2F%2F{{ URL::to('/') }}&text={{ strip_tags($topic->content) }}" target="_blank" class="btn btn-icon btn-pure btn-default">
                    <i class="icon bd-twitter blue-500" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>
    @foreach($topic->replies as $reply)
        <section class="slidePanel-inner-section">
            <div class="forum-header">
                <span class="name">{{ $reply->user->name }}</span>
                <span class="time">{{ date('d-m-Y', strtotime($reply->created_at)) }}</span>
            </div>
            <div class="forum-content">
                <p>{{ $reply->content }}</p>
                <div class="float-right">
                    @if(doYouLike('reply', $reply->id))
                        <button type="button" class="btn btn-icon btn-pure btn-default">
                            <i class="icon far fa-thumbs-up blue-800" aria-hidden="true"></i>
                        </button>
                    @else
                        <button type="button" class="btn btn-icon btn-pure btn-default giveLikeReplie" name="topic_id" value="{{ $reply->id }}" data-url="{{ route('forum.slidePanel', $topic->id) }}" data-toggle="slidePanel">
                            <i class="icon far fa-thumbs-up" aria-hidden="true"></i>
                        </button>
                    @endif
                    <span class="num btn btn-icon btn-pure btn-default">{{ countLikes('reply', $reply->id) }}</span>
                </div>
            </div>
        </section>
    @endforeach
    <div class="slidePanel-comment">
        <form method="post" action="{{ route('reply.store') }}">
            <textarea class="maxlength-textarea form-control mb-sm mb-20" name="content" rows="4"></textarea>
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input hidden name="topic" value="{{ $topic->id }}">
            <button class="btn btn-primary" type="submit">Comentar</button>
        </form>
    </div>
</div>
<script>
    jQuery(document).ready(function(){
        jQuery('.giveLikeTopic').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ route('like.storeAjax') }}",
                method: 'post',
                data: {
                    topic: "topic",
                    topic_id: $(this).val()
                },
                success: function(result){
                    console.log(result);
                    $(this).click();
                },
                error:function(result) {
                    console.log(result);
                }
            });
        });
    });

    jQuery(document).ready(function(){
        jQuery('.giveLikeReplie').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "{{ route('like.storeAjax') }}",
                method: 'post',
                data: {
                    topic: "reply",
                    topic_id: $(this).val()
                },
                success: function(result){
                    console.log(result);
                    $(this).click();
                },
                error:function(result) {
                    console.log(result);
                }
            });
        });
    });
</script>