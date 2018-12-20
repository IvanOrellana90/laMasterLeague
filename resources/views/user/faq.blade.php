@extends('layouts.master')

@section('body-class')
    page-faq
@endsection

@section('main')
    <!-- Page -->
    <div class="page">
        <div class="page-content container-fluid">
            <div class="row">
                <div class="col-xl-3 col-md-4">
                    <!-- Panel -->
                    <div class="panel">
                        <div class="panel-body">
                            <div class="list-group faq-list" role="tablist">
                                @foreach($categories as $category)
                                    @if($categories->first() == $category)
                                        <a class="list-group-item list-group-item-action active" data-toggle="tab" href="#{{ $category->category }}"
                                           aria-controls="{{ $category->category }}" role="tab">{{ $category->category }}</a>
                                    @else
                                        <a class="list-group-item" data-toggle="tab" href="#{{ $category->category }}"
                                           aria-controls="{{ $category->category }}" role="tab">{{ $category->category }}</a>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- End Panel -->
                </div>

                <div class="col-xl-9 col-md-8">
                    <!-- Panel -->
                    <div class="panel">
                        <div class="panel-body">
                            <div class="tab-content">
                                @php( $cat = 1 )
                                <!-- Categroy {{ $cat }}-->
                                @foreach($categories as $category)
                                <div class=" tab-pane animation-fade @if($cat == 1) active @endif" id="{{ $category->category }}" role="tabpanel">
                                    <div class="panel-group panel-group-simple panel-group-continuous" id="accordion{{ $cat }}"
                                         aria-multiselectable="true" role="tablist">

                                        @php( $cat++ )
                                        @php( $pre = 1 )
                                        @foreach($faqs->where('category',$category->category) as $faq)
                                        <!-- Question {{ $pre }} -->
                                            <div class="panel">
                                                <div class="panel-heading" id="question-{{ $pre }}-{{ $cat }}" role="tab">
                                                    <a class="panel-title @if($pre != 1) collapsed @endif" id="{{ $category->category }}" aria-controls="answer-{{ $pre }}-{{ $cat }}" @if($pre == 1)aria-expanded="true" @else aria-expanded="false" @endif data-toggle="collapse"
                                                       href="#answer-{{ $pre }}-{{ $cat }}" data-parent="#accordion{{ $cat }}">
                                                        {{ $faq->question }}
                                                    </a>
                                                </div>
                                                <div class="panel-collapse collapse @if($pre == 1) show @endif" id="answer-{{ $pre }}-{{ $cat }}" aria-labelledby="question-{{ $pre }}-{{ $cat }}"
                                                     role="tabpanel">
                                                    <div class="panel-body" style="text-align: justify">
                                                        {!! $faq->answer !!}
                                                    </div>
                                                </div>
                                            </div>
                                        <!-- End Question {{ $pre }} -->
                                        @php( $pre ++)
                                        @endforeach
                                    </div>
                                </div>
                                <!-- End Categroy {{ $cat }} -->
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- End Panel -->
                </div>

            </div>
        </div>
    </div>
    <!-- End Page -->
@endsection

@section('js-page')
    <script src="{{ URL::to('assets/examples/js/pages/faq.js') }}"></script>
@endsection

