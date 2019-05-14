<li class="{{ Request::is('admin/home*') ? 'active' : '' }} {{Request::is('admin/home*') ? 'active' : '' }}}} ">
    <a href="{!! url('home') !!}"><i class="fa fa-home"></i><span>Home</span></a>
</li>

<li class="{{ Request::is('admin/bookings*') ? 'active' : '' }}">
    <a href="{!! route('bookings.index') !!}"><i class="fa fa-edit"></i><span>Bookings</span></a>
</li>
@if(Auth::user()->role == "admin")
    <li class="{{ Request::is('admin/rooms*') ? 'active' : '' }}">
        <a href="{!! route('rooms.index') !!}"><i class="fa fa-building"></i><span>Rooms</span></a>
    </li>

    {{-- <li class="{{ Request::is('prices*') ? 'active' : '' }}">
        <a href="{!! route('prices.index') !!}"><i class="fa fa-edit"></i><span>Prices</span></a>
    </li>
     --}}

    {{-- <li class="{{ Request::is('roomImages*') ? 'active' : '' }}">
        <a href="{!! route('roomImages.index') !!}"><i class="fa fa-edit"></i><span>Room Images</span></a>
    </li> --}}

    <li class="{{ Request::is('admin/gustbooks*') ? 'active' : '' }}">
        <a href="{!! route('gustbooks.index') !!}"><i class="fa fa-image"></i><span>Our Guests</span></a>
    </li>

    <li class="{{ Request::is('admin/users*') ? 'active' : '' }}">
        <a href="{!! route('users.index') !!}"><i class="fa fa-user-secret"></i><span> Users </span></a>
    </li>

    <li class="{{ Request::is('admin/blockedIPs*') ? 'active' : '' }}">
        <a href="{!! route('blockedIPs') !!}"><i class="fa fa-ban"></i><span> Blocked IPs </span></a>
    </li>
@endif

<li class="{{ Request::is('admin/reports*') ? 'active' : '' }}">
    <a href="{!! route('reports.index') !!}"><i class="fa fa-bar-chart"></i><span> Reports </span></a>
</li>


@if(Auth::user()->role == "admin")
    <li class="{{ Request::is('admin/settings*') ? 'active' : '' }}">
        <a href="{!! route('settings.index') !!}"><i class="fa fa-cogs"></i><span> Settings </span></a>
    </li>
@endif