<div class="page-content" id="matches-list">
    <div class="form-group">
        <div class="input-group">
            <button type="submit" class="input-search-btn">
                <i class="icon wb-search" aria-hidden="true"></i>
            </button>
            <input type="text" class="form-control search" placeholder="Buscar">
        </div>
    </div>
    <div class="documents-wrap categories" data-plugin="animateList" data-child="li">
        <div class="app-documents">
            <ul class="blocks blocks-100 blocks-xxl-4 blocks-lg-3 blocks-sm-2 list" data-plugin="matchHeight">
                @foreach($teams as $team)
                    <li>
                        <div class="category">
                            <h4 class="teamName">{{ $team->name }}</h4>
                            <h6 class="tournament-name tournament">{{ $team->coach }}</h6>
                            <div class="logo-team">
                                <img class="" src="{{ URL::to('img/logos') }}/{{ $team->flag }}" alt="...">
                            </div>
                            <p>
                                <i class="icon icon-color wb-map" aria-hidden="true"></i>
                                @if($team->stadium_id != null)
                                    {{ $team->stadium->name }}
                                @else
                                    No definido
                                @endif
                            </p>
                            <hr>
                            <div class="row no-space">
                                <div class="col-6">
                                    <div class="counter">
                                        <span class="counter-number">{!! getTeamTournamentMatches($tournament->id,$team->id) !!}</span>
                                        <div class="counter-label">Partidos</div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="counter">
                                        <span class="counter-number">{{ getTeamTournamentEfectividad($tournament->id,$team->id) }}%</span>
                                        <div class="counter-label">Efectividad</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
