<div class="page-breadcrumb">
    <div class="row">
        <div class="col-12 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">
                @auth
                    @php
                        $pakistanTime = now()->setTimezone('Asia/Karachi');
                        $hour = $pakistanTime->format('H');
                        $greeting = match(true) {
                            $hour < 12 => 'Good Morning',
                            $hour < 17 => 'Good Afternoon',
                            $hour < 20 => 'Good Evening',
                            default => 'Good Night',
                        };
                    @endphp
                    {{ $greeting }}, {{ Auth::user()->name }}!
                @else
                    Welcome!
                @endauth
            </h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}">Photography</a>
                        </li>

                        @if(request()->routeIs('promotions.*'))
                            <li class="breadcrumb-item active" aria-current="page">Promotions</li>
                        @elseif(request()->routeIs('services.*'))
                            <li class="breadcrumb-item active" aria-current="page">Services</li>
                        @elseif(request()->routeIs('sale-agents.*'))
                            <li class="breadcrumb-item active" aria-current="page">Sales Agents</li>
                        @elseif(request()->routeIs('permissions.*'))
                            <li class="breadcrumb-item active" aria-current="page">Permissions</li>
                        @elseif(request()->routeIs('roles.*'))
                            <li class="breadcrumb-item active" aria-current="page">Roles</li>
                        @elseif(request()->routeIs('user.*'))
                            <li class="breadcrumb-item active" aria-current="page">Users</li>
                        @elseif(request()->routeIs('bookings.*'))
                            <li class="breadcrumb-item active" aria-current="page">Bookings</li>
                        @elseif(request()->routeIs('profile.*'))
                            <li class="breadcrumb-item active" aria-current="page">Profile</li>
                        @endif
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
