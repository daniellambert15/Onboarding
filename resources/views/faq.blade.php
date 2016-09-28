@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
                @include('alerts')
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">FAQ</div>
                        <div class="panel-body">
                                <div class="panel-group" id="faqAccordion">
                                    @foreach($faqs as $faq)
                                    <div class="panel panel-primary ">
                                        <div class="panel-heading accordion-toggle question-toggle collapsed" data-toggle="collapse" data-parent="#faqAccordion" data-target="#question{{ $faq->id }}">
                                            <h4 class="panel-title">
                                                <a href="#" class="ing">Q: {{ $faq->question }}</a>
                                            </h4>

                                        </div>
                                        <div id="question{{ $faq->id }}" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p>{{ $faq->answer }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection