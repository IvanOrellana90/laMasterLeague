@extends('layouts.master')

@section('body-class')
    dashboard
@endsection

@section('css-plugins')
    <link rel="stylesheet" href="{!! url('') !!}/assets/examples/css/dashboard/v2.css">
    <link rel="stylesheet" href="{!! url('') !!}/assets/examples/css/dashboard/analytics.css">
    <link rel="stylesheet" href="{!! url('') !!}/global/vendor/owl-carousel/owl.carousel.css">
@endsection

@section('main')
    <!-- Page -->
    <div class="page">

        <div class="page-content container-fluid">

            @include('user.includes.alert-special-event')

            <div class="row" data-plugin="matchHeight" data-by-row="true">

                <div class="col-xl-8 col-lg-12">
                    <!-- Panel Bets -->
                        @include('user.includes.panel-bets')
                    <!-- End Panel Bets -->
                </div>
                <div class="col-xl-4 col-lg-6">
                    <!-- Panel Ranking -->
                        @include('user.includes.panel-ranking')
                    <!-- End Panel Followers -->
                </div>
                <div class="col-lg-6">
                    <!-- Panel Ranking -->
                        @include('user.includes.panel-efectividad')
                    <!-- End Panel Followers -->
                </div>
                <div class="col-lg-6 masonry-item">
                    <!-- Panel Last comments -->
                        @include('user.includes.panel-lastComments')
                    <!-- End Panel Last comments -->
                </div>
                <div class="col-xl-4 col-lg-6">
                    <!-- Panel Ranking -->
                        @include('user.includes.panel-rankingYeta')
                    <!-- End Panel Followers -->
                </div>
                <div class="col-xl-8 col-lg-12">
                    <!-- Panel LastMatches -->
                        @include('user.includes.panel-lastMatches')
                    <!-- End Panel LastMatches -->
                </div>
            </div>
        </div>
    </div>
    <!-- End Page -->
@endsection

@section('js-plugins')
    <script src="{!! url('') !!}/global/vendor/chartist/chartist.min.js"></script>
    <script src="{!! url('') !!}/global/vendor/gmaps/gmaps.js"></script>
    <script src="{!! url('') !!}/global/vendor/matchheight/jquery.matchHeight-min.js"></script>
    <script src="{!! url('') !!}/global/vendor/owl-carousel/owl.carousel.js"></script>
@endsection

@section('js-page')
    <script src="{!! url('') !!}/global/js/Plugin/gmaps.js"></script>
    <script src="{!! url('') !!}/global/js/Plugin/matchheight.js"></script>
    <script src="{!! url('') !!}/global/js/Plugin/asscrollable.js"></script>
    <script src="{!! url('') !!}/global/js/Plugin/jquery-appear.js"></script>
    <script src="{!! url('') !!}/global/js/Plugin/owl-carousel.js"></script>
@endsection
