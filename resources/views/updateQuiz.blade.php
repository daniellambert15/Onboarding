@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $quiz->quiz->title }}</div>
                        <div class="panel-body">
                            <form method="post" action="/postUpdateQuiz">
                                <div class="well">
                                    Q) {{ $quiz->quiz->questions }}
                                </div>
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $quiz->id }}">

                                <div class="form-group">
                                    <label for="answer">Answer</label>
                                    <textarea  class="form-control" name="answer" style="min-height: 360px" id="answer" placeholder="answer">{{ $quiz->answer }}</textarea>
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