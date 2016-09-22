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
                @if (session('success'))
                    <div class="alert alert-success" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">My Files</div>
                        <div class="panel-body">
                            @foreach($files as $file)
                                <form id="{{ $file->id }}" name="{{ $file->id }}" method="post" action="/postFiles"  enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="id" value="{{ $file->id }}">
                                    <div class="panel panel-primary ">
                                        <div class="panel-heading">{{ $file->name }}</div>
                                        <div class="panel-body">
                                            <p>
                                                {{ $file->description }}
                                            </p>

                                            <p>
                                                <a class="btn btn-default" href="{{ asset('storage/'.str_replace('public', '', $file->original)) }}" role="button">Click here to download</a>
                                            </p>

                                            <div class="form-group ">
                                                <label for="file">File input</label>
                                                <input type="file" name="file" id="file">
                                            </div>
                                            @foreach($user->userFile($file->id) as $userFile)
                                                <p>
                                                    <a class="btn
                                                            @if($userFile->approved == 1)
                                                                btn-success
                                                            @else
                                                                btn-danger  disabled
                                                            @endif"
                                                       href="{{ asset('storage/'.str_replace('public', '', $userFile->fileLocation)) }}"
                                                        role="button">Click here to download - Submitted: {{ $userFile->created_at }}</a>
                                                </p>
                                            @endforeach
                                            <button type="submit" class="btn btn-default">Upload File</button>
                                        </div>
                                    </div>
                                </form>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection