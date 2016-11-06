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
                            <h3 class="panel-title">Quiz List</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>Description</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($quizzes as $quiz)
                                    <tr>
                                        <td>{{ $quiz->id }}</td>
                                        <td>{{ $quiz->name }}</td>
                                        <td>{!! $quiz->description !!}</td>
                                        <td>{{ $quiz->created_at }}</td>
                                        <td>
                                            <a href="/sendQuizUser/{{ $user->id }}/{{ $quiz->id }}" class="btn btn-primary"
                                               onclick="return confirm('Are you sure you want to send {{ $quiz->name }} to {{ $user->name }}?');"
                                               >SEND</a>
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