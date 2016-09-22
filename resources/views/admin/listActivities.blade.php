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
            <!-- add calendar from VUE -->
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Activity List</h3>
                        </div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Month</th>
                                        <th>Description</th>
                                        <th>Created</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($activities as $activity)
                                        <tr>
                                            <td>{{ $activity->id }}</td>
                                            <td>{{ $activity->name }}</td>
                                            <td>{{ substr($activity->month,0,-12) }}</td>
                                            <td>{{ $activity->description }}</td>
                                            <td>{{ $activity->created_at }}</td>
                                            <td>
                                                <a href="/editAdminActivity/{{ $activity->id }}">Edit</a>
                                                <a href="/removeAdminActivity/{{ $activity->id }}" onclick="return confirm('Are you sure you want to delete this activity?');">Delete</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="/addActivity" class="btn btn-sm btn-primary">Add Activity</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection