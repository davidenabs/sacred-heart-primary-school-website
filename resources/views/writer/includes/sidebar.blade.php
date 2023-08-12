<div class="main-sidebar sidebar-style-2">
        <aside id="sidebar-wrapper">
          <div class="sidebar-brand">
            <a href="{{ route('writer.home') }}"> <img alt="sacred-heart-international-school" src="{{ asset('shs/img/sacred-heart-international-school.jpeg') }}" class="header-logo" /> <span
                class="logo-name">Dashboard</span>
            </a>
          </div>
          <ul class="sidebar-menu">
            <li class="menu-header">Main</li>
            <li class="dropdown @if (Route::currentRouteName() === 'writer.home') active @endif">
              <a href="{{ route('writer.home') }}" class="nav-link"><i data-feather="monitor"></i><span>Dashboard</span></a>
            </li>
            <li class="dropdown @if (Route::currentRouteName() === 'writer.notifications') active @endif">
              <a href="{{ route('writer.notifications') }}" class="nav-link"><i data-feather="bell"></i><span>Notification</span></a>
            </li>
            <li class="menu-header">Event, News & Posts</li>
            <li class="dropdown @if (Route::currentRouteName() === 'writer.posts.create' ||  Route::currentRouteName() === 'writer.posts.index') active @endif">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="check-square"></i><span>
              Blog post</span></a>
              <ul class="dropdown-menu">
                <li class="@if (Route::currentRouteName() === 'writer.posts.create') active @endif"><a class="nav-link" href="{{ route('writer.posts.create') }}">Create Post</a></li>
                <li @if (Route::currentRouteName() === 'writer.posts.index') class="active" @endif><a class="nav-link" href="{{ route('writer.posts.index') }}">Posts</a></li>
              </ul>
            </li>

            <li class="dropdown @if (Route::currentRouteName() === 'writer.galleries.create' ||  Route::currentRouteName() === 'writer.galleries.index') active @endif">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="image"></i><span>
              Gallery</span></a>
              <ul class="dropdown-menu">
                <li class="@if (Route::currentRouteName() === 'writer.galleries.create') active @endif"><a class="nav-link" href="{{ route('writer.galleries.create') }}">Add Photo</a></li>
                <li @if (Route::currentRouteName() === 'writer.galleries.index') class="active" @endif><a class="nav-link" href="{{ route('writer.galleries.index') }}">Manage Gallery</a></li>
              </ul>
            </li>

            {{-- <li class="dropdown @if (Route::currentRouteName() === 'writer.galleries.create' ||  Route::currentRouteName() === 'writer.galleries.index') active @endif">
              <a href="#" class="menu-toggle nav-link has-dropdown"><i data-feather="image"></i><span>
              Gallery</span></a>
              <ul class="dropdown-menu">
                <li><a class="nav-link" href="{{ route('writer.galleries.create') }}"><a class="nav-link" href="{{ route('writer.galleries.create') }}">Add photo</a></li>
                <li><a class="nav-link" href="{{ route('writer.galleries.index') }}"><a class="nav-link" href="{{ route('writer.galleries.index') }}">Gallery</a></li>
              </ul>
            </li> --}}
            <li class="menu-header">Profile</li>
            <li class="dropdown @if (Route::currentRouteName() === 'writer.profile') active @endif">
              <a href="{{ route('writer.profile') }}" class="nav-link"><i data-feather="user"></i><span>Profile</span></a>
            </li>
          </ul>
        </aside>
      </div>