@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
                @include('alerts')
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ $question->name }}</div>
                        <div class="panel-body">
                            <p>{{ $question->question }}</p>
                            <form method="post" action="/submitModuleAnswer">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $question->id }}" name="id">
                                <div class="form-group">
                                    <label for="answer">Answer</label>
                                    <textarea class="form-control" name="answer"></textarea>
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