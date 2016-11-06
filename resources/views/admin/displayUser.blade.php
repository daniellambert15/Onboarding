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
                                                    Lsat Modified: {{ $userFile->updated_at }}
                                                </p>
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
                                    <h3 class="panel-title">Quizzes</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Answers</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user->quizzes->where('completed', "IS NOT" , null) as $quiz)
                                            <tr>
                                                <td>{{ $quiz->id }}</td>
                                                <td>{{ $quiz->quiz->name }}</td>
                                                <td><div class="well">
                                                    @foreach($quiz->quizAnswers as $answer)
                                                        <p>
                                                            {!! $answer->name !!}<br />
                                                            {!! $answer->answer !!}
                                                        </p>
                                                        @endforeach
                                                </div></td>
                                                <td>{{ $quiz->updated_at }}</td>
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
                                    <h3 class="panel-title">Modules</h3>
                                </div>
                                <div class="panel-body">
                                    <table class="table table-striped">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Answer</th>
                                            <th>Last Updated</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($user->modules as $module)
                                            <tr>
                                                <td>{{ $module->id }}</td>
                                                <td>{!! $module->moduleQuestion->name !!}</td>
                                                <td>{!! $module->answer !!}</td>
                                                <td>{{ $module->updated_at }}</td>
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