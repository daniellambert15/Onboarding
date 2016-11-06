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
                            <h3 class="panel-title">Editing: {{ $question->name }}</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="/adminUpdateQuizQuestion" enctype="multipart/form-data">
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ $question->id }}">
                                <input type="hidden" class="form-control" id="qId" name="qId" value="{{ $qId }}">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $question->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <textarea name="question" id="question" rows="10" cols="80">{{ $question->question }}</textarea>
                                    <script>
                                        CKEDITOR.replace( 'question' );
                                    </script>
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