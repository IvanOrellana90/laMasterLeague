<div class="panel" id="countriesVistsWidget">
    <div class="panel-heading">
        <h3 class="panel-title"><i class="panel-title-icon icon wb-star" aria-hidden="true"></i>
            Clasificación efectividad
        </h3>
        <div class="panel-actions panel-actions-keep">

        </div>
    </div>
    <div class="panel-body">
        <ul class="list-group list-group-dividered list-group-full h-300" data-plugin="scrollable">
            <div data-role="container">
                <div data-role="content">
                    @foreach($users->sortByDesc('efectividad')->take(10) as $user)
                        <li class="list-group-item">
                            <div class="media">
                                <div class="pr-20">
                                    <a class="avatar avatar-online" href="javascript:void(0)">
                                        <img src="{{ URL::to('img/avatars') }}/{{ $user->avatar->img }}" alt="">
                                    </a>
                                </div>
                                <div class="media-body w-full">
                                    <div>
                                        <span>
                                            <a class="name" href="{{ route('user', $user->id) }}">{{ $user->name }}</a>
                                        </span>
                                    </div>
                                    <small>Nivel: {{ getUserLevel($user->id) }}</small>
                                </div>
                                <div class="media-body w-full">
                                    <div class="float-right">
                                        <span class="progress-percent">{{ $user->efectividad }}%</span>
                                    </div>
                                    <div class="progress progress-xs mb-0">
                                        <div class="progress-bar progress-bar-info bg-blue-600" style="width: {{ $user->efectividad }}%" aria-valuemax="100"
                                             aria-valuemin="0" aria-valuenow="90" role="progressbar">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </div>
            </div>
        </ul>
    </div>
</div>