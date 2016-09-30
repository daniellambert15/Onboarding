@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
                @include('alerts')
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">List Modules</div>
                        <div class="panel-body">
                                @foreach($modules as $module)
                                    <div class="panel panel-primary">
                                        <div class="panel-heading">{{ $module->name }} - <a   class="btn btn-sm btn-default" href="/admin/editModule/{{ $module->id }}">Edit</a>   <a class="btn btn-sm btn-default" href="admin/deleteModule/{{$module->id}}" onclick="return confirm('Are you sure you want to delete this module?');">Delete</a></div>
                                        <div class="panel-body">
                                            <div class="panel-group">
                                                <table class="table table-striped">
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($module->questions as $question)
                                                        <tr>
                                                            <td>{{ $question->name }}</td>
                                                            <td>
                                                                <a href="/admin/editModuleQuestion/{{$question->id}}">Edit</a> -
                                                                <a href="/admin/removeModuleQuestion/{{$question->id}}" onclick="return confirm('Are you sure you want to remove this activity?');">Remove</a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                                <a href="/admin/addModuleQuestion/{{ $module->id }}" class="btn btn-primary">Add activity</a>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                <a href="/admin/addModule" class="btn btn-default">Add Module</a>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection