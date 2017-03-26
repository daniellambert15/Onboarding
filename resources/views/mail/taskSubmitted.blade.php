<h2>
    New task submitted
</h2>

<p>
    Hi {{env('ADMIN_NAME', 'Admin')}},
</p>

<p>
    There has been a new task submitted by {{ $user->name }} - {{ $user->email }}. Please go and review their answer.
</p>
