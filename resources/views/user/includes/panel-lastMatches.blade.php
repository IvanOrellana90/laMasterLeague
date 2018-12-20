<div class="panel">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="panel-title-icon icon fa fa-arrow-circle-left" aria-hidden="true"></i>
            Úlitmos encuentros
        </h3>
        <div class="panel-actions panel-actions-keep">

        </div>
    </div>
    <div class="panel-body">
        <ul class="list-group list-group-dividered list-group-full h-300 bets" data-plugin="scrollable">
            <div data-role="container">
                <div data-role="content">
                    @foreach($lastMatches as $match )
                        <li id="{{ $match->id }}" class="list-group-item">
                            <form method="post" action="{{ route('bet.store') }}">
                                <div class="media">
                                    <div class="pr-0 pr-sm-20 align-self-center">
                                        <div class="avatar avatar-online">
                                            <img src="{{ URL::to('img/logos') }}/{{ $match->homeTeam['flag'] }}" alt="...">
                                            @if(!$match->finished)
                                                <i class="bg-blue-700"></i>
                                            @elseif($match->home_score > $match->away_score)
                                                <i></i>
                                            @elseif($match->home_score == $match->away_score)
                                                <i class="bg-yellow-500"></i>
                                            @else
                                                <i class="bg-red-800"></i>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="media-body align-self-center">
                                        <p class="nameHome">{{ $match->homeTeam['name'] }}</p>
                                        <input class="input-score form-control" maxlength="2" disabled name="home_score" value="{{ $user->bets->where('match_id', $match->id)->first()['home_score'] }}">
                                    </div>
                                    <div class="media-body align-self-center">
                                        <p>
                                            <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                            @if($match->stadium_id != null)
                                                {{ $match->stadium->name }}
                                            @elseif($match->homeTeam['stadium_id'] != null)
                                                {{ $match->homeTeam }}
                                            @else
                                                No definido
                                            @endif
                                        </p>
                                        <h6 class="mt-0 mb-5">
                                            {{ date('d-m-Y', strtotime($match->date)) }} <br>
                                            @if($match->finished)
                                                <small>{{ $match->home_score. " - " .$match->away_score }}</small>
                                            @else
                                                <small>{{ date('H:i', strtotime($match->date)) }}</small>
                                            @endif
                                        </h6>
                                        @if($match->finished)
                                            @if(getPuntos($match->id) > 3)
                                                <span class="points badge badge-round badge-success">{{ getPuntos($match->id) }}</span>
                                            @elseif(getPuntos($match->id) > 0)
                                                <span class="points badge badge-round badge-warning bg-yellow-800">{{ getPuntos($match->id) }}</span>
                                            @else
                                                <span class="points badge badge-round badge-danger">{{ getPuntos($match->id) }}</span>
                                            @endif
                                        @endif
                                        <p class="realDate" style="display: none;">{{ $match->date }}</p>
                                    </div>
                                    <div class="media-body align-self-center">
                                        <p class="nameAway">{{ $match->awayTeam['name'] }}</p>
                                        <input class="input-score form-control" maxlength="2" disabled name="away_score" value="{{ $user->bets->where('match_id', $match->id)->first()['away_score'] }}">
                                    </div>
                                    <div class="pr-0 pr-sm-20 align-self-center">
                                        <div class="avatar avatar-online">
                                            <img src="{{ URL::to('img/logos') }}/{{ $match->awayTeam['flag'] }}" alt="...">
                                            @if(!$match->finished)
                                                <i class="bg-blue-700"></i>
                                            @elseif($match->home_score < $match->away_score)
                                                <i></i>
                                            @elseif($match->home_score == $match->away_score)
                                                <i class="bg-yellow-500"></i>
                                            @else
                                                <i class="bg-red-800"></i>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </li>
                    @endforeach
                </div>
            </div>
        </ul>
    </div>
</div>