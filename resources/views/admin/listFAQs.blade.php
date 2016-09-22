@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            @include('layouts.nav')
            <div class="col-md-8">
                <div class="tab-content">
                    <div class="panel panel-default">
                        <div class="panel-heading">FAQ</div>
                        <div class="panel-body">
                            <div class="panel-group" id="faqAccordion">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Question</th>
                                            <th>Answer</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($faqs as $faq)
                                            <tr>
                                                <td>{{ $faq->id }}</td>
                                                <td>{{ $faq->question }}</td>
                                                <td>{{ $faq->answer }}</td>
                                                <td>
                                                    <a href="/editAdminFAQ/{{ $faq->id }}">Edit</a>
                                                    <a href="/removeAdminFAQ/{{ $faq->id }}" onclick="return confirm('Are you sure you want to delete this FAQ?');">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <a href="/addFAQ" class="btn btn-primary">Add</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection