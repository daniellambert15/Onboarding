@if(Auth::user()->is_admin OR Auth::user()->stage1 OR Auth::user()->stage2 OR Auth::user()->stage3 )
    <div class="col-md-4">
        @if(Auth::user()->is_admin)
            <div class="panel panel-default">
                <div class="panel-heading">Administration</div>

                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked" >
                        <li role="presentation">
                            <a href="/userList">Userlist</a>
                        </li>
                        <li role="presentation">
                            <a href="/adminFiles">Onboarding Files</a>
                        </li>
                        <li role="presentation">
                            <a href="/adminQuizzes">Quizzes</a>
                        </li>
                        <li role="presentation">
                            <a href="/adminModules">Modules</a>
                        </li>
                        <li role="presentation">
                            <a href="/adminFAQS">FAQ</a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
        @if(Auth::user()->is_admin OR Auth::user()->stage1 )
            <div class="panel panel-default">
                <div class="panel-heading">Onboarding</div>

                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                        <li role="presentation">
                            <a href="/files">Files</a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
        @if(Auth::user()->is_admin OR Auth::user()->stage2)
            <div class="panel panel-default">
                <div class="panel-heading">Quiz</div>

                <div class="panel-body">
                    <ul class="nav nav-pills nav-stacked">
                        <li role="presentation">
                            <a href="/quizes">Quiz</a>
                        </li>
                        <li role="presentation">
                            <a href="/completedQuizes">Completed Quizzes</a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
        @if(Auth::user()->is_admin OR Auth::user()->stage3)
        <div class="panel panel-default">
            <div class="panel-heading">Modules</div>

            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation">
                        <a href="/module">Module</a>
                    </li>
                    <li role="presentation">
                        <a href="/completedModules">Completed Modules</a>
                    </li>
                </ul>
            </div>
        </div>
        @endif
        <div class="panel panel-default">
            <div class="panel-heading">HELP</div>

            <div class="panel-body">
                <ul class="nav nav-pills nav-stacked">
                    <li role="presentation">
                        <a href="/faq">FAQ's</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endif