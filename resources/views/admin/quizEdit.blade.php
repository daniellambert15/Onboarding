@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- add calendar from VUE -->
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Editing: {{ $quiz->title }}</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="/adminUpdateQuiz" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $quiz->id }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ $quiz->title }}">
                                </div>

                                <div class="form-group">
                                    <label for="questions">Questions</label>
                                    <textarea class="form-control" name="questions" >{{ $quiz->questions }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="answers">Answers</label>
                                    <textarea class="form-control" name="answers" >{{ $quiz->answers }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-default">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection