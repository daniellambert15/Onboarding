@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
                @include('alerts')
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">Quiz: {{ $quiz->name }}</div>
                        <div class="panel-body">
                            <form method="post" action="/postQuiz">
                                @foreach($quizQuestions as $question)
                                    <input name="qId" type="hidden" value="{{ $question->user_quiz }}">
                                    <input name="answerId[{{ $question->id }}]" type="hidden" value="{{ $question->id }}">
                                    <div class="well">
                                        <div class="form-group">
                                            <label for="answer">{{ $question->name }}</label>
                                            <p>{!! $question->question  !!}</p>
                                            <textarea
                                                    class="form-control"
                                                    id="answer-{{ $question->id }}"
                                                    name="answer-{{ $question->id }}"
                                                    style="min-height: 360px"
                                                    placeholder="answer">{{ $question->answer }}</textarea>
                                            <script>
                                                CKEDITOR.replace( 'answer-{{ $question->id }}' );
                                            </script>
                                        </div>
                                    </div>
                                @endforeach
                                {{ csrf_field() }}
                                <p>
                                    You've now got two choices:
                                    <ol>
                                        <li>Save and Send - This will save your questions, then email them through to the administrator who will review your answers and get back to you shortly.</li>
                                        <li>Save - This will just save your answers so you can revisit/send them at a later date.</li>
                                    </ol>
                                    <div class="form-group">
                                        <select name="choice" class="form-control">
                                            <option value="1" selected>Save and Send</option>
                                            <option value="2">Save now, send later</option>
                                        </select>
                                    </div>
                                </p>
                                <button type="submit"  class="btn btn-default">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection