@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
            @include('alerts')
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add a Activity</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="/addModuleQuestion" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ $id }}">
                                <div class="form-group">
                                    <label for="name">Activity</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                </div>

                                <div class="form-group">
                                    <label for="question">Guidance</label>
                                    <textarea class="form-control" name="question" >{{ old('question') }}</textarea>
                                </div>

                                <button type="submit" class="btn btn-default">Add Activity</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection