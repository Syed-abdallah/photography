




<aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <!-- Dashboard -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('photography/dashboard') ? 'active' : '' }}" 
                       href="{{ route('dashboard') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Management</span></li>

                <!-- Roles Multi-level -->
                <li class="sidebar-item {{ request()->is('photography/roles*') ? 'active' : '' }}">
                    <a class="sidebar-link has-arrow {{ request()->is('photography/roles*') ? 'active' : '' }}" 
                       href="javascript:void(0)" aria-expanded="{{ request()->is('photography/roles*') ? 'true' : 'false' }}">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Roles</span>
                    </a>
                    <ul class="collapse first-level base-level-line {{ request()->is('photography/roles*') ? 'in' : '' }}">
                        <li class="sidebar-item">
                            <a href="{{ route('roles.index') }}" class="sidebar-link {{ request()->is('photography/roles') ? 'active' : '' }}">
                                <span class="hide-menu">All Roles</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('roles.create') }}" class="sidebar-link {{ request()->is('photography/roles/create') ? 'active' : '' }}">
                                <span class="hide-menu">Create Role</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ request()->is('photography/bookings*') ? 'active' : '' }}">
                    <a class="sidebar-link has-arrow {{ request()->is('photography/roles*') ? 'active' : '' }}" 
                       href="javascript:void(0)" aria-expanded="{{ request()->is('photography/bookings*') ? 'true' : 'false' }}">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Bookings</span>
                    </a>
                    <ul class="collapse first-level base-level-line {{ request()->is('photography/bookings*') ? 'in' : '' }}">
                        <li class="sidebar-item">
                            <a href="{{ route('bookings.index') }}" class="sidebar-link {{ request()->is('photography/bookings') ? 'active' : '' }}">
                                <span class="hide-menu">All Bookings</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="{{ route('bookings.create') }}" class="sidebar-link {{ request()->is('photography/bookings/create') ? 'active' : '' }}">
                                <span class="hide-menu">Create Bookings</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Users Multi-level -->
                <li class="sidebar-item {{ request()->is('photography/user*') ? 'active' : '' }}">
                    <a class="sidebar-link has-arrow {{ request()->is('photography/user*') ? 'active' : '' }}" 
                       href="javascript:void(0)" aria-expanded="{{ request()->is('photography/user*') ? 'true' : 'false' }}">
                        <i data-feather="user" class="feather-icon"></i>
                        <span class="hide-menu">Users</span>
                    </a>
                    <ul class="collapse first-level base-level-line {{ request()->is('photography/user*') ? 'in' : '' }}">
                        <li class="sidebar-item">
                            <a href="{{ route('user.index') }}" class="sidebar-link {{ request()->is('photography/users') ? 'active' : '' }}">
                                <span class="hide-menu">All Users</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Sale Agents Multi-level -->
                <li class="sidebar-item {{ request()->is('photography/sale-agents*') ? 'active' : '' }}">
                    <a href="{{ route('sale-agents.index') }}" 
                       class="sidebar-link {{ request()->is('photography/sale-agents*') ? 'active' : '' }}">
                        <i data-feather="users" class="feather-icon"></i>
                        <span class="hide-menu">Sale Agents</span>
                    </a>
                </li>
                

                <!-- Promotions -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('photography/promotions*') ? 'active' : '' }}" 
                       href="{{ route('promotions.index') }}" aria-expanded="false">
                        <i data-feather="gift" class="feather-icon"></i>
                        <span class="hide-menu">Promotions</span>
                    </a>
                </li>

                <!-- Services -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('photography/services*') ? 'active' : '' }}" 
                       href="{{ route('services.index') }}" aria-expanded="false">
                        <i data-feather="briefcase" class="feather-icon"></i>
                        <span class="hide-menu">Services</span>
                    </a>
                </li>

                <!-- Permissions -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('photography/permissions*') ? 'active' : '' }}" 
                       href="{{ route('permissions.index') }}" aria-expanded="false">
                        <i data-feather="shield" class="feather-icon"></i>
                        <span class="hide-menu">Permissions</span>
                    </a>
                </li>

                <!-- Profile -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('photography/profile*') ? 'active' : '' }}" 
                       href="{{ route('profile.edit') }}" aria-expanded="false">
                        <i data-feather="user-check" class="feather-icon"></i>
                        <span class="hide-menu">Profile</span>
                    </a>
                </li>

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Account</span></li>

                <!-- Register -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('authentication-register1') ? 'active' : '' }}" 
                       href="{{ url('authentication-register1.html') }}" aria-expanded="false">
                        <i data-feather="lock" class="feather-icon"></i>
                        <span class="hide-menu">Register</span>
                    </a>
                </li>

                <!-- Logout -->
                <li class="sidebar-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="sidebar-link {{ request()->is('logout') ? 'active' : '' }}" aria-expanded="false"
                                style="border: none; background: none; padding: 0; width: 100%; ">
                            <i data-feather="log-out" class="feather-icon"></i>
                            <span class="hide-menu">Logout</span>
                        </button>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>

