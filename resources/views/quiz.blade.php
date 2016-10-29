@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
                @include('alerts')
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $quiz->title }}</div>
                        <div class="panel-body">
                            <form method="post" action="/postQuiz">
                                <div class="well">
                                    Q) {!! $quiz->questions !!}
                                </div>
                                {{ csrf_field() }}
                                <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                                <div class="form-group">
                                    <label for="answer">Answer</label>
                                    <textarea  class="form-control" name="answer" style="min-height: 360px" id="answer" placeholder="answer">{{ $quiz->answers }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-default">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection