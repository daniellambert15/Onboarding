<h2>
    New User
</h2>

<p>
    Hi {{env('ADMIN_NAME', 'Admin')}},
</p>

<p>
    There has been a new user sign up to the system, Here are their details. Please go and review them.
</p>

<ul>
    <li>{{ $user->salutation }}</li>
    <li>{{ $user->name }}</li>
    <li>{{ $user->email }}</li>
    <li>{{ $user->business_name }}</li>
    <li>{{ $user->contact_number }}</li>
</ul>
