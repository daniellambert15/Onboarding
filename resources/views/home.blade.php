@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        @include('layouts.nav')
        @if(Auth::user()->is_admin OR Auth::user()->stage1 OR Auth::user()->stage2 OR Auth::user()->stage3 )
            <div class="col-md-8">
        @else
            <div class="col-md-12">
        @endif
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
                        <div class="panel-heading">Welcome</div>
                        <div class="panel-body">
                            <p>Welcome {{ Auth::user()->name }}</p>

                            @if(Auth::user()->stage1)
                                <p>
                                    This is your dashboard, please click on the left hand navigation links to start.
                                </p>
                                @else
                                <p>
                                    Thank you for signing up,
                                    you'll get a call shortly to explain the next steps.
                                </p>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection