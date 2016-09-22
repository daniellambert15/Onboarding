@extends('layouts.app')

@section('content')
        <div class="container">
            <div class="row">
                @include('layouts.nav')
                <div class="col-md-8">

                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('error') }}
                    </div>
            @endif
            <!-- add calendar from VUE -->
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">{{ $activity->name }}</h3>
                    </div>
                    <div class="panel-body">
                        <p>
                            Q) {{ $activity->description }}
                        </p>

                        <form method="post" action="/submitUserAnswer">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{ $activity->id }}" name="actvity_id">
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
@endsection