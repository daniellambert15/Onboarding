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
                            <h3 class="panel-title">{{ $user->name }}</h3>
                        </div>
                        <div class="panel-body">
                            <!-- start tab -->
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Files</h3>
                                </div>
                                <div class="panel-body">
                                    <p>Here are a list of the users files</p>
                                    @foreach($files as $file)
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">{{ $file->name }}</h3>
                                            </div>
                                            <div class="panel-body">{{ $file->description }}<br />
                                            @foreach($user->userFile($file->id) as $userFile)
                                                <p>
                                                    <a class="btn @if($userFile->approved == 1) btn-success @else btn-danger @endif"
                                                       href="{{ asset('storage/'.str_replace('public', '', $userFile->fileLocation)) }}"
                                                       role="button">Click here to download - Submitted: {{ $userFile->created_at }}</a>
                                                    @if($userFile->approved == 0)
                                                        <a
                                                                class="btn btn-info"
                                                                href="/file/approve/{{$user->id}}/{{$userFile->id}}"
                                                        >
                                                            Approve
                                                        </a>
                                                    @else
                                                        <a
                                                                class="btn btn-info"
                                                                href="/file/unapprove/{{$user->id}}/{{$userFile->id}}"
                                                        >
                                                            Unapprove
                                                        </a>
                                                    @endif
                                                </p>
                                            @endforeach
                                        </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- end tab -->
                            <!-- start tab -->
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Modules</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Answer</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user->activities as $activity)
                                            <tr>
                                                <td>{{ $activity->id }}</td>
                                                <td>{{ $activity->activity->description }}</td>
                                                <td>{{ $activity->answer }}</td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end tab -->
                            <!-- start tab -->
                            <div class="panel panel-primary">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Quizzes</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user->quizzes as $quiz)
                                            <tr>
                                                <td>{{ $quiz->id }}</td>
                                                <td>{{ $quiz->quiz->title }}</td>
                                                <td>{{ $quiz->quiz->questions }}</td>
                                                <td>{{ $quiz->answer }}</td>
                                                <td>
                                                    @if($quiz->approved == 0)
                                                        <a
                                                                class="btn btn-info"
                                                                href="/quiz/approve/{{$user->id}}/{{$quiz->id}}"
                                                        >
                                                            Approve
                                                        </a>
                                                    @else
                                                        <a
                                                                class="btn btn-info"
                                                                href="/quiz/unapprove/{{$user->id}}/{{$quiz->id}}"
                                                        >
                                                            Unapprove
                                                        </a>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- end tab -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection