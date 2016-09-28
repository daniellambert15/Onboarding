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
                            <h3 class="panel-title">Editing {{ $user->salutation }} {{ $user->name }}</h3>
                        </div>
                        <div class="panel-body">
                            <form method="post" action="/postEditUser">
                                {{ csrf_field() }}
                                <input type="hidden" value="{{ $user->id }}" name="id">
                                <div class="form-group">
                                    <label for="salutation">Salutation</label>
                                    <select name="salutation" class="form-control">
                                        <option selected value="{{ $user->salutation }}"> -- NO CHANGE --</option>
                                        <option value="Mr" >Mr</option>
                                        <option value="Mrs">Mrs</option>
                                        <option value="Ms">Ms</option>
                                        <option value="Miss">Miss</option>
                                        <option value="Dr">Dr</option>
                                        <option value="Prof">Prof</option>
                                        <option value="Rev">Rev</option>
                                        <option value="Lady">Lady</option>
                                        <option value="Sir">Sir</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                                </div>

                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"  value="{{ $user->email }}" placeholder="Email">
                                </div>
                                <div class="form-group">
                                    <label for="business_name">Business Name</label>
                                    <input type="text" class="form-control" id="business_name" value="{{ $user->business_name }}" name="business_name">
                                </div>
                                <div class="form-group">
                                    <label for="contact_number">Contact Number</label>
                                    <input type="text" class="form-control" value="{{ $user->contact_number }}" id="contact_number" name="contact_number">
                                </div>

                                <div class="form-group">
                                    <label for="module">Module</label>
                                    <select name="module" class="form-control">
                                        <option selected value="{{ $user->module }}"> -- NO CHANGE --</option>
                                        @foreach($modules as $module)
                                            <option value="{{ $module->id }}">{{ $module->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="stage1" value="1" @if($user->stage1 != null) checked @endif> View Files
                                    </label> <br />
                                    <label>
                                        <input type="checkbox" name="stage2" value="1" @if($user->stage2 != null) checked @endif> View Quiz
                                    </label> <br />
                                    <label>
                                        <input type="checkbox" name="stage3" value="1" @if($user->stage3 != null) checked @endif> View Modules
                                    </label> <br />
                                    <label>
                                        <input type="checkbox" name="is_admin" value="1" @if($user->is_admin != null) checked @endif> <strong>Tick if the user is an administrator of the system</strong>
                                    </label>
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