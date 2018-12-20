<div class="page-content">
    <div class="panel">
        <div class="panel-body" id="test-list">
            <form class="page-search-form" role="search">
                <div class="input-search input-search-dark">
                    <i class="input-search-icon wb-search" aria-hidden="true"></i>
                    <input type="text" class="form-control search" id="inputSearch" name="search" placeholder="Buscar">
                    <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
                </div>
            </form>

            <div class="nav-tabs-horizontal nav-tabs-animate" data-plugin="tabs">
                <div class="tab-content">
                    <div class="tab-pane active animation-slide-left" id="apuestas" role="tabpanel">
                        <ul class="list-group">
                            @if($group->messages->count() == 0)
                                <li>
                                    No se han ingresado comentarios, se el primero!
                                </li>
                            @endif
                            @foreach($group->messages as $message)
                            <li class="list-group-item">
                                <div class="media">
                                    <div class="pr-20">
                                        <a class="avatar" href="{{ route('user', $message->user->id) }}">
                                            <img class="img-fluid" src="{{ URL::to('img/avatars') }}/{{ $message->user->avatar->img }}"
                                                 alt="...">
                                        </a>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="mt-0 mb-5">
                                            {{ $message->user->name }}
                                            <small>{{ date('d-m-Y', strtotime($message->created_at)) }}</small>
                                        </h5>
                                        <div class="profile-brief">"{{ $message->content }}"</div>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="slidePanel-comment">
                        <form method="post" action="{{ route('message.store') }}">
                            <textarea class="maxlength-textarea form-control mb-sm mb-20" name="content" rows="4"></textarea>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <input hidden name="group_id" value="{{ $group->id }}">
                            <button class="btn btn-primary" type="submit">Comentar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>