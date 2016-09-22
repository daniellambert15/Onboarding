@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
                @endif
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">{{ Auth::user()->name }}'s Calendar</div>
                        <div class="panel-body">
                            <p>
                                Things to note about the activities calendar:
                                <ul>
                                    <li>You do not need to complete any activities for the month(s) before you signed up.</li>
                                    <li>You cannot complete next months activities.</li>
                                    <li>You cannot complete this months tasks UNTIL you've completed the previous months activities.</li>
                                    <li>You cannot submit the same activity twice.</li>
                                    <li>All activity submissions will go to an administrator for verification.</li>
                                </ul>
                            </p>
                            @foreach($months as $month)
                                <div class="col-xs-6 col-sm-4"  >
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">
                                            {{ $month['month'] }}
                                        </div>

                                        <div class="panel-body">
                                            <ul class="nav nav-pills nav-stacked">
                                                @foreach($month['activities'] as $activity)
                                                    <li role="presentation">
                                                        <a href="/activity/{{ $activity['id'] }}">{{ $activity['name'] }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
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