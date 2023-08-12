<div class="navbar-bg"></div>
<nav class="navbar navbar-expand-lg main-navbar sticky">
    <div class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg
									collapse-btn"> <i
                        data-feather="align-justify"></i></a></li>
            <li><a href="#" class="nav-link nav-link-lg fullscreen-btn">
                    <i data-feather="maximize"></i>
                </a></li>
            <li>

            </li>
        </ul>
    </div>
    <ul class="navbar-nav navbar-right">

        <li class="dropdown dropdown-list-toggle">
            <a href="#" data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg d-flex justify-content-between">
                <i data-feather="bell" class="bell"></i>
                @if ($notifications->count() > 0)
                    <small class="badge badge-sm badge-danger">{{ $notifications->count() }}</small>
                @endif
            </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
                <div class="dropdown-header">
                    Notifications
                    <div class="float-right">
                        {{-- <a href="#" id="mark-all">Mark All As Read</a> --}}
                    </div>
                </div>
                <div class="dropdown-list-content dropdown-list-icons">
                    @forelse ($notifications->take(5) as $notification)
                        @if ($notification->type == 'App\Notifications\Admin\NewMailSentNotification')
                            @include('admin.includes.navbar-notify-body', [
                                'message' => $notification->data['message'],
                                'url' => route('admin.mail.show', $notification->data['data']['id']),
                                'icon' => 'fa-envelope',
                            ])
                        @elseif($notification->type == 'App\Notifications\Admin\PostCreatedNotification')
                            @include('admin.includes.navbar-notify-body', [
                                'message' => $notification->data['message'],
                                'url' => route('admin.posts.show', $notification->data['data']['slug']),
                                'icon' => 'fa-pencil-alt',
                            ])
                        @endif

                    @empty
                        <p class="text-muted text-center">
                            There are no new notifications
                        </p>
                    @endforelse

                </div>
                <div class="dropdown-footer text-center">
                    <a href="{{ route('admin.notifications') }}">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image"
                    src="{{ auth()->user()->writerInfo->profile ? asset(auth()->user()->writerInfo->profile) : asset('frontend/assets/img/profile.jpg') }}"
                    class="user-img-radious-style"> <span class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">Hello {{ auth()->user()->name }}</div>
                <a href="{{ route('admin.profile') }}" class="dropdown-item has-icon"> <i
                        class="far
										fa-user"></i> Profile
                    {{-- </a> <a href="timeline.html" class="dropdown-item has-icon"> <i class="fas fa-bolt"></i>
                    Activities
                </a> <a href="#" class="dropdown-item has-icon"> <i class="fas fa-cog"></i>
                    Settings
                </a> --}}
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item">
                        <form action="{{ route('logout') }}" method="post" class="">
                            @csrf
                            <button class="btn-none btn text-danger"><i class="fas fa-sign-out-alt"></i> Logout</button>
                        </form>
                    </a>
            </div>
        </li>
    </ul>
</nav>

{{-- @section('scripts')
    <script>
        // function sendMarkRequest(id = null) {
        //     return $.ajax("{{ route('markNotification') }}", {
        //         method: 'POST',
        //         data: {
        //             _token,
        //             id
        //         }
        //     });
        // }
        // $(function() {
        //     $('.mark-as-read').click(function() {
        //         let request = sendMarkRequest($(this).data('id'));
        //         request.done(() => {
        //             $(this).parents('div.alert').remove();
        //         });
        //     });
        //     $('#mark-all').click(function() {
        //         alert('')
        //         let request = sendMarkRequest();
        //         request.done(() => {
        //             $('div.alert').remove();
        //         });
        //     });
        // });
    </script>
@endsection --}}
