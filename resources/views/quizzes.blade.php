@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
                @include('alerts')
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">Quizzes</div>
                        <div class="panel-body">
                            @if(count($user->quizzes) > 0)
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
                                                Description
                                            </th>
                                            <th>
                                                actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($user->quizzes->where('submitted', null) as $quiz)
                                            <tr>
                                                <td>
                                                    {{ $quiz->id }}
                                                </td>
                                                <td>
                                                    {{ $quiz->quiz->name }}
                                                </td>
                                                <td>
                                                    {!! $quiz->quiz->description !!}
                                                </td>
                                                <td>
                                                    <a href="/quiz/{{ $quiz->id }}">Take quiz</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p>
                                    Sorry no quizzes to display
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
