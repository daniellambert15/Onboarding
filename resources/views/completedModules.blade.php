@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
                @include('alerts')
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">Completed Modules</div>
                        <div class="panel-body">
                            @foreach($modules as $module)
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        {{ $module->name }}
                                    </div>

                                    <div class="panel-body">
                                        @foreach($module->questions as $question)
                                            <div class="panel panel-primary">
                                                <div class="panel-heading">
                                                    {{ $question->name }}
                                                </div>

                                                <div class="panel-body">
                                                    <table class="table table-striped">
                                                        <thead>
                                                            <tr>
                                                                <th>Answer</th>
                                                                <th>Submitted</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($question->userAnswer() as $answer)
                                                                <tr>
                                                                    <td>{{ $answer->answer }}</td>
                                                                    <td>{{ $answer->created_at }}</td>
                                                                    <td><a href="/updateUserAnswer/{{ $answer->id }}">Edit</a></td>
                                                                </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection