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
                        <div class="panel-heading">{{ Auth::user()->name }}'s Completed Tasks</div>
                        <div class="panel-body">
                            @foreach($user->activities as $activity)
                                <div class="panel panel-primary">
                                    <div class="panel-heading">
                                        {{ $activity->activity->name }}
                                    </div>

                                    <div class="panel-body">
                                        <p>
                                            {{ $activity->answer }}
                                        </p>
                                        <a class="btn btn-warning" href="/editActivity/{{ $activity->id }}" role="button">Edit</a>
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