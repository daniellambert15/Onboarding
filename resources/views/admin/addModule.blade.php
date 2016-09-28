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
                            <h3 class="panel-title">Add a question</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="/addModule" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                                </div>

                                <button type="submit" class="btn btn-default">Add Module</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection