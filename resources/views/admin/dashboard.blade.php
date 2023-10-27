<h2>admin dashboard</h2>

@if(auth('admin')->check())
    <form method="POST" action="{{ route('admin.logout') }}">
@elseif(auth('vendor')->check())
    <form method="POST" action="{{ route('vendor.logout') }}">
@else
    <form method="POST" action="{{ route('logout','web') }}">
@endif

@csrf
<a class="dropdown-item" href="#" onclick="event.preventDefault();this.closest('form').submit();"><i class="bx bx-log-out"></i>logout</a>
</form>