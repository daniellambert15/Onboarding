@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
                @include('alerts')
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">Quiz: </div>
                        <div class="panel-body">
                            <form method="post" action="/postQuiz">

                                {{ csrf_field() }}
                                <p>
                                    You've now got two choices:
                                    <ol>
                                        <li>Save and Send - This will save your questions, then email them through to the administrator who will review your answers and get back to you shortly.</li>
                                        <li>Save - This will just save your answers so you can revisit/send them at a later date.</li>
                                    </ol>
                                    <div class="form-group">
                                        <select name="choice" class="form-control">
                                            <option value="1" selected>Save and Send</option>
                                            <option value="2">Save now, send later</option>
                                        </select>
                                    </div>
                                </p>
                                <button type="submit"  class="btn btn-default">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection