<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="{{ request()->route()->getName() == 'admin.dashboard' ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <img src="{{ asset('backend/assets/img/icons/dashboard.svg') }}" alt="img">
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <li class="{{ request()->routeIs('admin.user.*') ? 'active' : '' }}">
                    <a href="{{ route('admin.user.show') }}">
                        <img src="{{ asset('backend/assets/img/icons/users1.svg') }}" alt="img">
                        <span>Admin Users</span>
                    </a>
                </li>
                       
                <li class="{{ request()->routeIs('category.*') ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}">
                        <img src="{{ asset('backend/assets/img/icons/users1.svg') }}" alt="img">
                        <span>Category</span>
                    </a>
                </li>
                       

            </ul>
        </div>
    </div>
</div>
