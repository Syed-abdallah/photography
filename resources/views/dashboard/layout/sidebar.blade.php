{{-- 




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
                    <a class="sidebar-link {{ request()->is('photography/userregister') ? 'active' : '' }}" 
                       href="{{ route('newuser.register') }}" aria-expanded="false">
                        <i data-feather="lock" class="feather-icon"></i>
                        <span class="hide-menu">Register</span>
                    </a>
                </li>

                <!-- Logout -->
                <li class="sidebar-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="sidebar-link" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i data-feather="log-out" class="feather-icon"></i>
                            <span class="hide-menu">Logout</span>
                        </a>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>
 --}}





 <aside class="left-sidebar" data-sidebarbg="skin6">
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">

                <!-- Dashboard -->
                @can('view dashboard')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('photography/dashboard') ? 'active' : '' }}" 
                       href="{{ route('dashboard') }}" aria-expanded="false">
                        <i data-feather="home" class="feather-icon"></i>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                @endcan

                <li class="list-divider"></li>
                <li class="nav-small-cap"><span class="hide-menu">Management</span></li>

                <!-- Roles Multi-level -->
             

                <!-- Bookings Multi-level -->
                @canany(['view bookings', 'create bookings'])
                <li class="sidebar-item {{ request()->is('photography/bookings*') ? 'active' : '' }}">
                    <a class="sidebar-link has-arrow {{ request()->is('photography/roles*') ? 'active' : '' }}" 
                       href="javascript:void(0)" aria-expanded="{{ request()->is('photography/bookings*') ? 'true' : 'false' }}">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Bookings</span>
                    </a>
                    <ul class="collapse first-level base-level-line {{ request()->is('photography/bookings*') ? 'in' : '' }}">
                        @can('view bookings')
                        <li class="sidebar-item">
                            <a href="{{ route('bookings.index') }}" class="sidebar-link {{ request()->is('photography/bookings') ? 'active' : '' }}">
                                <span class="hide-menu">All Bookings</span>
                            </a>
                        </li>
                        @endcan
                        @can('create bookings')
                        <li class="sidebar-item">
                            <a href="{{ route('bookings.create') }}" class="sidebar-link {{ request()->is('photography/bookings/create') ? 'active' : '' }}">
                                <span class="hide-menu">Create Bookings</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany

                <!-- Users Multi-level -->
                @can('view users')
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
                @endcan

                <!-- Sale Agents -->
                @can('view sale agents')
                <li class="sidebar-item {{ request()->is('photography/sale-agents*') ? 'active' : '' }}">
                    <a href="{{ route('sale-agents.index') }}" 
                       class="sidebar-link {{ request()->is('photography/sale-agents*') ? 'active' : '' }}">
                        <i data-feather="users" class="feather-icon"></i>
                        <span class="hide-menu">Sale Agents</span>
                    </a>
                </li>
                @endcan
                
                <!-- Promotions -->
                @can('view promotions')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('photography/promotions*') ? 'active' : '' }}" 
                       href="{{ route('promotions.index') }}" aria-expanded="false">
                        <i data-feather="gift" class="feather-icon"></i>
                        <span class="hide-menu">Promotions</span>
                    </a>
                </li>
                @endcan

                <!-- Services -->
                @can('view services')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('photography/services*') ? 'active' : '' }}" 
                       href="{{ route('services.index') }}" aria-expanded="false">
                        <i data-feather="briefcase" class="feather-icon"></i>
                        <span class="hide-menu">Services</span>
                    </a>
                </li>
                @endcan

                <!-- Permissions -->
                @can('view permissions')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('photography/permissions*') ? 'active' : '' }}" 
                       href="{{ route('permissions.index') }}" aria-expanded="false">
                        <i data-feather="shield" class="feather-icon"></i>
                        <span class="hide-menu">Permissions</span>
                    </a>
                </li>
                @endcan
                @canany(['view roles', 'create roles'])
                <li class="sidebar-item {{ request()->is('photography/roles*') ? 'active' : '' }}">
                    <a class="sidebar-link has-arrow {{ request()->is('photography/roles*') ? 'active' : '' }}" 
                       href="javascript:void(0)" aria-expanded="{{ request()->is('photography/roles*') ? 'true' : 'false' }}">
                        <i data-feather="tag" class="feather-icon"></i>
                        <span class="hide-menu">Roles</span>
                    </a>
                    <ul class="collapse first-level base-level-line {{ request()->is('photography/roles*') ? 'in' : '' }}">
                        @can('view roles')
                        <li class="sidebar-item">
                            <a href="{{ route('roles.index') }}" class="sidebar-link {{ request()->is('photography/roles') ? 'active' : '' }}">
                                <span class="hide-menu">All Roles</span>
                            </a>
                        </li>
                        @endcan
                        @can('create roles')
                        <li class="sidebar-item">
                            <a href="{{ route('roles.create') }}" class="sidebar-link {{ request()->is('photography/roles/create') ? 'active' : '' }}">
                                <span class="hide-menu">Create Role</span>
                            </a>
                        </li>
                        @endcan
                    </ul>
                </li>
                @endcanany
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
                @can('create users')
                <li class="sidebar-item">
                    <a class="sidebar-link {{ request()->is('photography/userregister') ? 'active' : '' }}" 
                       href="{{ route('newuser.register') }}" aria-expanded="false">
                        <i data-feather="lock" class="feather-icon"></i>
                        <span class="hide-menu">Register</span>
                    </a>
                </li>
                @endcan

                <!-- Logout -->
                <li class="sidebar-item">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a class="sidebar-link" href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">
                            <i data-feather="log-out" class="feather-icon"></i>
                            <span class="hide-menu">Logout</span>
                        </a>
                    </form>
                </li>

            </ul>
        </nav>
    </div>
</aside>