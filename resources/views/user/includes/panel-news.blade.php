<div class="panel">
    <div class="panel-heading">
    </div>
    <div class="panel-body">
        <div class="carousel slide h-270" id="exampleCarouselCaptions" data-ride="carousel">
            <ol class="carousel-indicators carousel-indicators-fillin">
                <li class="active" data-slide-to="0" data-target="#exampleCarouselCaptions"></li>
                <li data-slide-to="1" data-target="#exampleCarouselCaptions"></li>
                <li data-slide-to="2" data-target="#exampleCarouselCaptions"></li>
            </ol>
            <div class="carousel-inner" role="listbox">
                @php($cont = 1)
                @foreach($newsDisplay as $news)
                    <div class="carousel-item @if($cont == 1) active @endif">
                        <div class="card-block" style="text-align: justify">
                            <h3 class="card-title">{{ $news->title }}</h3>
                            <p class="card-text">
                                <small>{{ date('d-m-Y', strtotime($news->created_at)) }}</small>
                            </p>
                            <p class="card-text">
                                @if(strlen($news->content) <= 300)
                                {!! $news->content !!}
                                @else()
                                {!! removeUnclosedTags(substr($news->content,0,300)."...") !!}
                                @endif
                            </p>
                        </div>
                        <div class="card-block clearfix">
                            <a class="btn btn-default btn-outline card-link" href="{{ route('forum') }}">LEER MÁS</a>
                            <div class="card-actions float-right">
                                <a href="javascript:void(0)">
                                    <i class="icon wb-heart"></i>
                                    <span>0</span>
                                </a>
                                <a href="javascript:void(0)">
                                    <i class="icon wb-chat"></i>
                                    <span>0</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @php( $cont ++)
                @endforeach
            </div>
            <a class="carousel-control-prev" href="#exampleCarouselCaptions" role="button"
               data-slide="prev">
                <span class="carousel-control-prev-icon wb-chevron-left" aria-hidden="true"></span>
                <span class="sr-only">Anterior</span>
            </a>
            <a class="carousel-control-next" href="#exampleCarouselCaptions" role="button"
               data-slide="next">
                <span class="carousel-control-next-icon wb-chevron-right" aria-hidden="true"></span>
                <span class="sr-only">Siguiente</span>
            </a>
        </div>
    </div>
</div>