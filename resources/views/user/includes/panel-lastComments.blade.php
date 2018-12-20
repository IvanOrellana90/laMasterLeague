<div class="panel" id="puntos">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="panel-title-icon icon wb-chat" aria-hidden="true"></i>Últimos comentarios</h3>
        <div class="panel-actions panel-actions-keep">

        </div>
    </div>
    <div class="panel-body">
        <ul class="list-group list-group-dividered list-group-full h-300" data-plugin="scrollable">
            <div data-role="container">
                <div data-role="content">
                    @foreach($topics->take(4) as $topic)
                        <li class="list-group-item">
                            <div class="media comment">
                                <div class="pr-20">
                                    <a class="avatar avatar-online" href="javascript:void(0)">
                                        <img src="{{ URL::to('img/avatars') }}/{{ $topic->user->avatar->img }}" alt="">
                                        <i></i>
                                    </a>
                                </div>
                                <div class="media-body comment-body">
                                    <a class="comment-author" href="{{ route('user',$topic->user->id) }}">{{ $topic->user->name }}</a>
                                    <div class="comment-meta">
                                        <span class="date">{{ $topic->created_at }}</span>
                                    </div>
                                    <div class="comment-content">
                                        <a class="comment-author" href="{{ route('forum') }}">
                                            <p>{!! removeUnclosedTags($topic->title." - ".substr($topic->content,0,120)."...") !!}</p>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </div>
            </div>
        </ul>
    </div>
    <div class="ribbon ribbon-clip ribbon-reverse ribbon-bottom ribbon-success">
        <span class="ribbon-inner">Top 10</span>
    </div>
</div>