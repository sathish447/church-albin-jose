    <aside class="main-sidebar sidebar-dark-primary sid elevation-4">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <img src="{{ btheme() }}/images/logo.png?{{ ver() }}" alt="{{ conf('name') }}"
            class="brand-image img-circle elevation-3">
            <span class="brand-text font-weight-bold text-uppercase">{{ conf('name') }}</span>
        </a>
        <div class="sidebar">
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar nav-flat nav-legacy flex-column" data-widget="treeview"
                role="menu" data-accordion="false">

                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                    class="nav-link @if ($active == 'dashboard') active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Dashboard
                    </p>
                </a>
            </li>

            <li class="nav-item">
                <a href="{{ route('role.index') }}"
                class="nav-link @if ($active == 'role') active @endif">
                <i class="nav-icon fas fa-key"></i>
                <p>
                    Roles
                </p>
            </a>


        @can("user")
        <li class="nav-item">
            <a href="{{ route('user.index') }}"
            class="nav-link @if ($active == 'user') active @endif">
            <i class="nav-icon fas fa-users"></i>
            <p>
                Users
            </p>
        </a>
    </li>
    @endcan


             <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}"
                    class="nav-link @if ($active == 'dashboard') active @endif">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>Logout</p>
                </a>
            </li>
</ul>
</nav>
</div>
</aside>