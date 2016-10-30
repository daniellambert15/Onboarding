@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
                @include('alerts')
                <div class="tab-content">

                    @if($module == null)

                        <div class="panel panel-default">
                            <div class="panel-heading">No Modules</div>
                            <div class="panel-body">
                                No Modules to display this month
                            </div>
                        </div>
                    @else
                        <div class="panel panel-default">
                            <div class="panel-heading">{{ $module->name }}</div>
                            <div class="panel-body">
                                <ul class="nav nav-pills nav-stacked">
                                    @foreach($module->questions as $question)
                                        <li  class="{{ (Auth::user()->completedQuestion($question))
                                        ? 'bg-success' : 'bg-danger' }}">

                                            <a href="/{{ (Auth::user()->completedQuestion($question))
                                        ? 'updateUserAnswer' : 'moduleQuestion' }}/{{ Auth::user()->
                                        completedQuestionId($question->id) }}">
                                                {{ $question->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection