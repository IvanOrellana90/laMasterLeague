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
                <button type="button" class="btn btn-icon btn-pure btn-default">
                    <i class="icon wb-thumb-up" aria-hidden="true"></i>
                    <span class="num">{{ $topic->likes }}</span>
                </button>
            </div>
            <div class="button-group share">
                Compartir:
                <a href="https://twitter.com/intent/tweet?url=http%3A%2F%2F{{ URL::to('/') }}&text={{ strip_tags($topic->content) }}" target="_blank" class="btn btn-icon btn-pure btn-default">
                    <i class="icon bd-twitter" aria-hidden="true"></i>
                </a>
            </div>
        </div>
    </section>
    @foreach($topic->replies as $replie)
        <section class="slidePanel-inner-section">
            <div class="forum-header">
                <span class="name">{{ $replie->user->name }}</span>
                <span class="time">{{ date('d-m-Y', strtotime($replie->created_at)) }}</span>
            </div>
            <div class="forum-content">
                <p>{{ $replie->content }}</p>
                <div class="float-right">
                    <button type="button" class="btn btn-icon btn-pure btn-default">
                        <i class="icon wb-thumb-up" aria-hidden="true"></i>
                        <span class="num">{{ $replie->likes }}</span>
                    </button>
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