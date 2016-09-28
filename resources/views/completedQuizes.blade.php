@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
                @include('alerts')
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">Quizes</div>
                        <div class="panel-body">

                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>
                                            #
                                        </th>
                                        <th>
                                            Name
                                        </th>
                                        <th>
                                            Questions
                                        </th>
                                        <th>
                                            Answer
                                        </th>
                                        <th>
                                            Submitted
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($user->quizzes as $quiz)
                                    <tr>
                                        <td>
                                            {{ $quiz->id }}
                                        </td>
                                        <td>
                                            {{ $quiz->quiz->title }}
                                        </td>
                                        <td>
                                            {{ $quiz->quiz->questions }}
                                        </td>
                                        <td>
                                            <div class="well">{{ $quiz->answer }}</div>
                                        </td>
                                        <td>
                                            {{ $quiz->created_at }}
                                        </td>
                                        <td>
                                            <a href="\userEditQuiz\{{ $quiz->id }}">Edit</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection