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
                            <h3 class="panel-title">Editing: {{ $module->name }}</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="/editModule" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="hidden" name="id" value="{{ $module->id }}">
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $module->name }}">
                                </div>

                                <button type="submit" class="btn btn-default">Edit Module</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection