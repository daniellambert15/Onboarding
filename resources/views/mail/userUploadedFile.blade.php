<h2>
    New file uploaded
</h2>

<p>
    Hi {{env('ADMIN_NAME', 'Admin')}},
</p>

<p>
    There has been a new file uploaded by {{ $user->name }} - {{ $user->email }}. Please go and review their file.
</p>
