@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
            @include('alerts')
            <!-- add calendar from VUE -->
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Editing: {{ $quiz->name }}</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="/adminUpdateQuiz" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $quiz->id }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $quiz->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="description">Quiz Description</label>
                                    <textarea name="description" id="description" rows="10" cols="80">{{ $quiz->description }}</textarea>
                                    <script>
                                        CKEDITOR.replace( 'description' );
                                    </script>
                                </div>

                                <button type="submit" class="btn btn-default">Update</button>
                            </form>
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">Questions</h3>
                        </div>
                        <div class="panel-body">
                            @foreach($quiz->questions as $question)
                                <div class="form-group">
                                    <label>{{ $question->name }}</label>
                                    <p>{!! $question->question !!}</p>
                                    <a href="/updateQuizQuestion/{{$question->id}}/{{ $quiz->id }}" class="btn btn-primary">Update</a>
                                    <a onclick="return confirm('Are you sure you want to remove this question?')" href="/destroyQuestion/{{$question->id}}/{{ $quiz->id }}" class="btn btn-danger">delete</a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <h3 class="panel-title">New Question</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="/adminAddQuizQuestion" enctype="multipart/form-data">
                                <div class="form-group">
                                    {{ csrf_field() }}
                                    <label for="newName">Name</label>
                                    <input type="hidden" value="{{ $quiz->id }}" name="id">
                                    <input type="text" name="newName" class="form-control" id="newName" />
                                    <label for="newQuestion">Question</label>
                                    <textarea name="newQuestion" id="newQuestion" rows="10" cols="80"></textarea>
                                    <script>
                                        CKEDITOR.replace( 'newQuestion' );
                                    </script>
                                </div>
                                <button type="submit" class="btn btn-default">Add Question</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection