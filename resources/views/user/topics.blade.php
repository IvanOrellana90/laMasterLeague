@if($user->topics->count() == 0)
    <li class="list-group-item">
        <p>El usuario no ha ingresado mensajes todavía</p>
    </li>
@endif
<table class="table is-indent mt-5 tableMensajes">
    <tbody class="list">
    @foreach($user->topics as $topic)
        <tr data-url="{{ route('forum.slidePanel', $topic->id) }}" data-toggle="slidePanel" >
            <td class="cell-60 responsive-hide">
                <a class="avatar" href="javascript:void(0)">
                    <img class="img-fluid" src="{{ URL::to('img/avatars') }}/{{ $topic->user->avatar->img }}" alt="...">
                </a>
            </td>
            <td>
                <div class="content">
                    <div class="title">
                        <span class="topic">{{ $topic->title }}</span>
                        <div class="flags responsive-hide">
                            @if(!$topic->active)
                                <i class="locked icon wb-lock" aria-hidden="true"></i>
                            @endif
                        </div>
                    </div>
                    <div class="metas">
                        <span class="author">{{ $topic->user->name }}</span>
                        <span class="started">{{ date('d-m-Y', strtotime($topic->created_at)) }}</span>
                        <span class="category" style="display: none">{{ $topic->category }}</span>
                    </div>
                    <div class="metas">
                        <span class="category"><strong style="color: {{ colorCategory($topic->category) }}">{{ $topic->category }}</strong></span>
                    </div>
                </div>
            </td>
            <td class="cell-80 forum-posts">
                                        <span>
                                            <i class="icon wb-inbox" aria-hidden="true"></i>
                                            <span class="badge badge-pill up badge-primary">{{ $topic->replies->count() }}</span>
                                        </span>
            </td>
            <td class="suf-cell"></td>
        </tr>
    @endforeach
    </tbody>
</table>