<div class="panel" id="puntos">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="panel-title-icon icon fa fa-thumbs-down" aria-hidden="true"></i>
            Ranking Yeta
        </h3>
        <div class="panel-actions panel-actions-keep">

        </div>
    </div>
    <div class="panel-body">
        <ul class="list-group list-group-dividered list-group-full h-300" data-plugin="scrollable">
            <div data-role="container">
                <div data-role="content">
                    @php($count = 0)
                    @foreach($users->sortBy('efectividad') as $user)
                        @if(countBetMatchFinished($user->id) > 0 && $count < 10)
                            @php($count++)
                            <li class="list-group-item">
                                <div class="media">
                                    <div class="pr-20">
                                        <a class="avatar avatar-online" href="javascript:void(0)">
                                            <img src="{{ URL::to('img/avatars') }}/{{ $user->avatar->img }}" alt="">
                                        </a>
                                    </div>
                                    <div class="media-body w-full">
                                        <div class="float-right">
                                            <h5 class="mt-0 mb-5 ml-10">
                                                {{ $user->efectividad }}%
                                            </h5>
                                            <small>
                                                Efectividad
                                            </small>
                                        </div>
                                        <div>
                                        <span>
                                            <a class="name" href="{{ route('user', $user->id) }}">{{ $user->name }}</a>
                                        </span>
                                        </div>
                                        <small>Nivel: {{ getUserLevel($user->id) }}</small>
                                    </div>
                                </div>
                            </li>
                        @endif
                    @endforeach
                </div>
            </div>
        </ul>
    </div>
    <div class="ribbon ribbon-clip ribbon-bottom ribbon-warning">
        <span class="ribbon-inner">Top 10</span>
    </div>
</div>