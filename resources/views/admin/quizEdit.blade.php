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

                                    <textarea name="questions" id="questions" rows="10" cols="80">{{ $quiz->questions }}</textarea>
                                    <script>
                                        // Replace the <textarea id="editor1"> with a CKEditor
                                        // instance, using default configuration.
                                        CKEDITOR.replace( 'questions' );
                                    </script>
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