<!-- Primer tab TODOS LOS PARTIDOS -->
<ul class="list-group list">
    @php($flag = true)
    @foreach($user->bets->sortBy('created_at') as $bet )
        @php($flag = false)
        <li id="{{ $bet->match['i'] }}" class="list-group-item">
            <div class="media">
                <div class="pr-0 pr-sm-20 align-self-center">
                    <div class="avatar avatar-online">
                        <img src="{{ URL::to('img/logos') }}/{{ $bet->match['homeTeam']['flag'] }}" alt="...">
                        @if(!$bet->match['finished'])
                            <i class="bg-blue-700"></i>
                        @elseif($bet->match['home_score'] > $bet->match['away_score'])
                            <i></i>
                        @elseif($bet->match['home_score'] == $bet->match['away_score'])
                            <i class="bg-yellow-500"></i>
                        @else
                            <i class="bg-red-800"></i>
                        @endif
                    </div>
                </div>
                <div class="media-body align-self-center">
                    <p class="nameHome">{{ $bet->match['homeTeam']['name'] }}</p>
                    <input class="input-score form-control" maxlength="2" name="home_score" value="{{ $bet->home_score }}" disabled>
                </div>
                <div class="media-body align-self-center">
                    <p>
                        <i class="icon icon-color wb-map" aria-hidden="true"></i>
                        {{ $bet->match['homeTeam']['stadium'] }}
                    </p>
                    <h6 class="mt-0 mb-5">
                        {{ date('d-m-Y', strtotime($bet->match->date)) }} <br>
                        @if($bet->match->finished)
                            <small>{{ $bet->match->home_score. " - " .$bet->match->away_score }}</small>
                        @else
                            <small>{{ date('H:i', strtotime($bet->match->date)) }}</small>
                        @endif
                    </h6>
                    @if($bet->match->finished)
                        @if($bet->points > 3)
                            <span class="points badge badge-round badge-success">{{ $bet->points }}</span>
                        @elseif($bet->points > 0)
                            <span class="points badge badge-round badge-warning bg-yellow-800">{{ $bet->points }}</span>
                        @else
                            <span class="points badge badge-round badge-danger">{{ $bet->points }}</span>
                        @endif
                    @endif
                    <p class="realDate" style="display: none;">{{ $bet->match['date'] }}</p>
                    <input type="hidden" name="match_id" value="{{ $bet->match['id'] }}">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="media-body align-self-center">
                    <p class="nameAway">{{ $bet->match['awayTeam']['name'] }}</p>
                    <input class="input-score form-control" maxlength="2" name="away_score" value="{{ $bet->away_score }}" disabled>
                </div>
                <div class="pr-0 pr-sm-20 align-self-center">
                    <div class="avatar avatar-online">
                        <img src="{{ URL::to('img/logos') }}/{{ $bet->match['awayTeam']['flag'] }}" alt="...">
                        @if(!$bet->match['finished'])
                            <i class="bg-blue-700"></i>
                        @elseif($bet->match['home_score'] < $bet->match['away_score'])
                            <i></i>
                        @elseif($bet->match['home_score'] == $bet->match['away_score'])
                            <i class="bg-yellow-500"></i>
                        @else
                            <i class="bg-red-800"></i>
                        @endif
                    </div>
                </div>
            </div>
        </li>
    @endforeach
    @if($flag)
        <li class="list-group-item">
            <p>El usuario no ha ingresado apuestas todavía</p>
        </li>
    @endif
</ul>