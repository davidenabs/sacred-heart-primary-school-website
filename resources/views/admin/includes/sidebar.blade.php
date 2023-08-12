<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.home') }}"> <img alt="sacred-heart-international-school"
                    src="{{ asset('shs/logo/sacred-heart-primary-school-kaduna.webp') }}" class="header-logo" /> <span
                    class="logo-name">Admin panel</span>
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown @if (Route::currentRouteName() === 'admin.home') active @endif">
                <a href="{{ route('admin.home') }}" class="nav-link"><i
                        data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown @if (Route::currentRouteName() === 'admin.notifications') active @endif">
                <a href="{{ route('admin.notifications') }}" class="nav-link"><i
                        data-feather="bell"></i><span>Notification</span></a>
            </li>
            <li class="menu-header">Mail</li>
            <li class="dropdown @if (Route::currentRouteName() === 'admin.mail.send' || Route::currentRouteName() === 'admin.mail.index' || Route::currentRouteName() === 'admin.mail.show') active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i
                        data-feather="mail"></i><span>Email</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.mail.send') }}">Compose mail</a></li>
                    <li><a class="nav-link" href="{{ route('admin.mail.index') }}">Sent mails</a></li>
                </ul>
            </li>
            <li class="menu-header">Manage users / testimonies</li>
            <li class="dropdown
            @if (Route::currentRouteName() === 'admin.users.index') active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user"></i><span>
                        Users</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.users.index', 'admin') }}">Admins</a></li>
                    <li><a class="nav-link" href="{{ route('admin.users.index', 'writer') }}">Authors</a></li>
                </ul>
            </li>
            <li class="dropdown @if (Route::currentRouteName() === 'admin.managements.edit' ||
                    Route::currentRouteName() === 'admin.managements.index' ||
                    Route::currentRouteName() === 'admin.managements.create') active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="user-check"></i><span>
                        Management</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.managements.create') }}">Add</a></li>
                    <li><a class="nav-link" href="{{ route('admin.managements.index') }}">View all</a></li>
                </ul>
            </li>
            <li class="dropdown @if (Route::currentRouteName() === 'admin.subscribes.edit' ||
                    Route::currentRouteName() === 'admin.subscribes.index' ||
                    Route::currentRouteName() === 'admin.subscribes.create') active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="thumbs-up"></i><span>
                        Subscribers</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.subscribes.create') }}">Add</a></li>
                    <li><a class="nav-link" href="{{ route('admin.subscribes.index') }}">View all</a></li>
                </ul>
            </li>
            <li class="dropdown @if (Route::currentRouteName() === 'admin.testimonies.index') active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="heart"></i><span>
                        Testimonies</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.testimonies.index') }}">View all</a></li>
                </ul>
            </li>
            <li class="menu-header">Event & New</li>
            <li class="dropdown @if (Route::currentRouteName() === 'admin.posts.edit' ||
                    Route::currentRouteName() === 'admin.posts.index' ||
                    Route::currentRouteName() === 'admin.posts.create') active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="list"></i><span>
                        Blog post</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.posts.create') }}">Create Post</a></li>
                    <li><a class="nav-link" href="{{ route('admin.posts.index') }}">Posts</a></li>
                </ul>
            </li>
            <li class="dropdown @if (Route::currentRouteName() === 'admin.categories.edit' ||
                    Route::currentRouteName() === 'admin.categories.index' ||
                    Route::currentRouteName() === 'admin.categories.create') active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="tag"></i><span>
                        Category</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.categories.create') }}">Create Category</a></li>
                    <li><a class="nav-link" href="{{ route('admin.categories.index') }}">Categories</a></li>
                </ul>
            </li>
            <li class="dropdown @if (Route::currentRouteName() === 'admin.galleries.edit' ||
                    Route::currentRouteName() === 'admin.galleries.index' ||
                    Route::currentRouteName() === 'admin.galleries.create') active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="film"></i><span>
                        Gallery</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.galleries.create') }}">Add photo</a></li>
                    <li><a class="nav-link" href="{{ route('admin.galleries.index') }}">Gallery</a></li>
                    {{-- <li><a class="nav-link" href="{{ route('admin.galleries.index') }}">Create album</a></li> --}}
                </ul>
            </li>
            <li class="menu-header">Profile</li>
            <li class="dropdown @if (Route::currentRouteName() === 'admin.profile') active @endif">
                <a href="{{ route('admin.profile') }}" class="nav-link"><i
                        data-feather="user"></i><span>Profile</span></a>
            </li>
            <li class="menu-header">Website</li>
            <li class="dropdown @if (Route::currentRouteName() === 'admin.settings.home') active @endif">
                <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="settings"></i><span>
                        Settings</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="{{ route('admin.settings.home') }}">Site info</a></li>
                    {{-- <li><a class="nav-link" href="posts.html">Styles</a></li> --}}
                </ul>
            </li>
        </ul>
    </aside>
</div>
