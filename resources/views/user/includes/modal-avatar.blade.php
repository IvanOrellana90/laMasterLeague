<div class="modal fade modal-fade-in-scale-up" id="exampleNiftyFadeScale" aria-hidden="true"
     aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
    <div class="modal-dialog modal-simple">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="blocks blocks-100 blocks-xxl-4 blocks-lg-3 blocks-md-2">
                    @foreach($avatars->where('level','>',0) as $avatar)
                        <li>
                            <div class="card card-shadow">
                                @if($avatar->level <= getUserLevel($user->id) && $avatar->level > 0)
                                    <figure class="card-img-top overlay-hover overlay">

                                        <img class="overlay-figure overlay-scale" src="{{ URL::to('img/avatars') }}/{{ $avatar->img }}"
                                             alt="...">

                                        <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                            <a class="icon wb-thumb-up" href="{{ route('changeUserAvatar', $avatar->id) }}">
                                            </a>
                                        </figcaption>
                                    </figure>
                                @else
                                    <figure class="card-img-top overlay-hover overlay">
                                        <img class="overlay-figure overlay-scale" style="opacity: 0.6;" src="{{ URL::to('img/avatars') }}/{{ $avatar->img }}"
                                             alt="...">
                                        <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                            <a class="icon wb-thumb-down" href="">
                                            </a>
                                        </figcaption>
                                    </figure>
                                @endif
                            </div>
                            <div class="card-bottom">
                                <p>
                                    <strong>Nombre:</strong> {{ $avatar->name }} <br>
                                    <strong>Nivel:</strong> @if($avatar->level == 0) - @else {{ $avatar->level }} @endif
                                </p>
                            </div>
                        </li>
                    @endforeach
                        @foreach($avatars->where('achievement_id','!=',null) as $avatar)
                            <li>
                                <div class="card card-shadow">
                                    @if($user->achievements()->where('achievement_id', $avatar->achievement_id)->first()->unlocked_at != null)
                                        <figure class="card-img-top overlay-hover overlay">

                                            <img class="overlay-figure overlay-scale" src="{{ URL::to('img/avatars') }}/{{ $avatar->img }}"
                                                 alt="...">

                                            <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                <a class="icon wb-thumb-up" href="{{ route('changeUserAvatar', $avatar->id) }}">
                                                </a>
                                            </figcaption>
                                        </figure>
                                    @else
                                        <figure class="card-img-top overlay-hover overlay">
                                            <img class="overlay-figure overlay-scale" style="opacity: 0.6;" src="{{ URL::to('img/avatars') }}/{{ $avatar->img }}"
                                                 alt="...">
                                            <figcaption class="overlay-panel overlay-background overlay-fade overlay-icon">
                                                <a class="icon wb-thumb-down" href="">
                                                </a>
                                            </figcaption>
                                        </figure>
                                    @endif
                                </div>
                                <div class="card-bottom">
                                    <p>
                                        <strong>Nombre:</strong> {{ $avatar->name }} <br>
                                        <strong>Nivel:</strong> @if($avatar->level == 0) - @else {{ $avatar->level }} @endif
                                    </p>
                                </div>
                            </li>
                        @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>