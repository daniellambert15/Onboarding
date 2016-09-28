@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
            @include('alerts')
            <!-- add calendar from VUE -->
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">List of files</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Original</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($files as $file)
                                        <tr>
                                            <td>{{ $file->id }}</td>
                                            <td>{{ $file->name }}</td>
                                            <td>{{ $file->description }}</td>
                                            <td>{{ $file->original }}</td>
                                            <td>{{ $file->created_at }}</td>
                                            <td><a href="/removeAdminFile/{{ $file->id }}">Delete</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="/addFiles" class="btn btn-sm btn-primary">upload</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection