<!-- nav-tabs -->

<div class="site-sidebar-tab-content tab-content">
    <div class="tab-pane fade active show" id="sidebar-userlist">
        <div>
            <div>
                <h5 class="clearfix">GRUPOS
                </h5>
                <form class="my-20" role="search">
                    <div class="input-search input-search-dark">
                        <i class="input-search-icon wb-search" aria-hidden="true"></i>
                        <input type="text" class="form-control" id="inputSearchGroup" placeholder="Buscar">
                        <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
                    </div>
                </form>

                <div class="list-group" id="filterGroup">
                    @foreach($user->groupsBelong as $group)
                        <a class="list-group-item" data-url="{{ route('chatMessage', $group->id) }}" data-toggle="site-sidebar">
                            <div class="media" style="cursor: pointer;">
                                <div class="pr-20">
                                    <div class="avatar avatar-sm">
                                        <img src="{{ URL::to('img/avatars') }}/{{ $group->user->avatar->img }}" alt="..." />
                                    </div>
                                </div>
                                <div class="media-body">
                                    <h5 class="mt-0 mb-5">
                                        <object>
                                            <a class="mt-0 mb-5" href="{{ route('group', $group->id) }}">{{ $group->name }}</a>
                                        </object>
                                    </h5>
                                    <small>{{ $group->tournament->name }}</small>
                                </div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function(){
        $("#inputSearchGroup").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#filterGroup .list-group-item").filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>