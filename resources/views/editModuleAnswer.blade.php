@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row">
                @include('layouts.nav')
                <div class="col-md-8">
                @include('alerts')
            <!-- add calendar from VUE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Edit answer</h3>
                    </div>
                    <div class="panel-body">
                        <form method="post" action="/updateUserAnswer">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $answer->id }}" name="id">
                            <div class="form-group">
                                <label for="answer">Answer</label>
                                <textarea class="form-control" name="answer">{{ $answer->answer }}</textarea>
                            </div>
                            <button type="submit" class="btn btn-default">Update</button>
                        </form>

                    </div>
                </div>
        </div>
    </div>
@endsection