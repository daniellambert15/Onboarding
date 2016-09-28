@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
                @include('alerts')
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">Userlist</div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Company</th>
                                        <th>Contact Number</th>
                                        <th>Module</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->salutation }} {{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->business_name }}</td>
                                            <td>{{ $user->contact_number }}</td>
                                            <td>{{ $user->userModule['name'] }}</td>
                                            <td>
                                                <a href="/viewUser/{{ $user->id }}">View</a> -
                                                <a href="/editUser/{{ $user->id }}">Edit</a> -
                                                <a href="/pauseUser/{{ $user->id }}">Pause</a>
                                            </td>
                                        </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @if(count($pausedUsers) > 0)
                    <div class="panel panel-default">
                        <div class="panel-heading">Paused users</div>
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Contact Number</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($pausedUsers as $pUser)
                                    <tr>
                                        <td>{{ $pUser->id }}</td>
                                        <td>{{ $pUser->salutation }} {{ $pUser->name }}</td>
                                        <td>{{ $pUser->email }}</td>
                                        <td>{{ $pUser->business_name }}</td>
                                        <td>{{ $pUser->contact_number }}</td>
                                        <td>
                                            <a href="/unpauseUser/{{ $pUser->id }}">Unpause</a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection