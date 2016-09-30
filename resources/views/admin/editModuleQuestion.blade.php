@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
            @include('alerts')
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Editing: {{ $question->name }}</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="/editModuleQuestion" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $question->id }}">
                                <div class="form-group">
                                    <label for="name">Activity</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $question->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="question">Guidance</label>
                                    <textarea class="form-control" name="question" >{{ $question->question }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-default">Edit Activity</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection