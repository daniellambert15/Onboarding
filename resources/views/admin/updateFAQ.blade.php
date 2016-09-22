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
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <!-- add calendar from VUE -->
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add FAQ</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="/postUpdateAdminFAQ" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $faq->id }}" name="id">
                                <div class="form-group">
                                    <label for="question">Question</label>
                                    <textarea name="question" id="question" class="form-control">{{ $faq->question }}</textarea>
                                </div>

                                <div class="form-group">
                                    <label for="answer">Answer</label>
                                    <textarea name="answer" id="answer" class="form-control">{{ $faq->answer }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-default">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection