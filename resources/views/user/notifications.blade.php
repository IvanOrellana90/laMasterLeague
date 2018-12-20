@extends('layouts.master')

@section('main')
    <!-- Page -->
    <div class="page">
        <div class="page-content">
            <!-- Panel -->
            <div class="panel">
                <div class="panel-body" id="test-list">
                    <form class="page-search-form mb-20" role="search">
                        <div class="input-search input-search-dark">
                            <i class="input-search-icon wb-search" aria-hidden="true"></i>
                            <input type="text" class="form-control search" id="inputSearch" name="search" placeholder="Buscar..">
                            <button type="button" class="input-search-close icon wb-close" aria-label="Close"></button>
                        </div>
                    </form>
                    <ul class="list-group list">
                        @foreach(auth()->user()->notifications as $notification)
                            <li class="list-group-item">
                                @include('layouts.notifications.'.snake_case(class_basename($notification->type)))
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <!-- End Panel -->
        </div>
    </div>
    <!-- End Page -->
@endsection

@section('js-page')
    <script src="//cdnjs.cloudflare.com/ajax/libs/list.js/1.5.0/list.min.js"></script>
    <script>
        var notList = new List('test-list', {
            valueNames: ['name','date']
        });
    </script>
@endsection
