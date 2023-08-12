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
        {{-- <li class="dropdown dropdown-list-toggle"><a href="#" data-toggle="dropdown"
              class="nav-link nav-link-lg message-toggle"><i data-feather="mail"></i>
              <span class="badge headerBadge1">
                6 </span> </a>
            <div class="dropdown-menu dropdown-list dropdown-menu-right pullDown">
              <div class="dropdown-header">
                Messages
                <div class="float-right">
                  <a href="#">Mark All As Read</a>
                </div>
              </div>
              <div class="dropdown-list-content dropdown-list-message">
                <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar
											text-white"> <img alt="image" src="{{ asset('backend/assets/img/users/user-1.png') }}" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">John
                      Deo</span>
                    <span class="time messege-text">Please check your mail !!</span>
                    <span class="time">2 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{ asset('backend/assets/img/users/user-2.png') }}" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                      Smith</span> <span class="time messege-text">Request for leave
                      application</span>
                    <span class="time">5 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{ asset('backend/assets/img/users/user-5.png') }}" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Jacob
                      Ryan</span> <span class="time messege-text">Your payment invoice is
                      generated.</span> <span class="time">12 Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{ asset('backend/assets/img/users/user-4.png') }}" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Lina
                      Smith</span> <span class="time messege-text">hii John, I have upload
                      doc
                      related to task.</span> <span class="time">30
                      Min Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{ asset('backend/assets/img/users/user-3.png') }}" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Jalpa
                      Joshi</span> <span class="time messege-text">Please do as specify.
                      Let me
                      know if you have any query.</span> <span class="time">1
                      Days Ago</span>
                  </span>
                </a> <a href="#" class="dropdown-item"> <span class="dropdown-item-avatar text-white">
                    <img alt="image" src="{{ asset('backend/assets/img/users/user-2.png') }}" class="rounded-circle">
                  </span> <span class="dropdown-item-desc"> <span class="message-user">Sarah
                      Smith</span> <span class="time messege-text">Client Requirements</span>
                    <span class="time">2 Days Ago</span>
                  </span>
                </a>
              </div>
              <div class="dropdown-footer text-center">
                <a href="#">View All <i class="fas fa-chevron-right"></i></a>
              </div>
            </div>
          </li> --}}
        <li class="dropdown dropdown-list-toggle">
          <a href="#" data-toggle="dropdown"
                class="nav-link notification-toggle nav-link-lg d-flex justify-content-between">

                <i data-feather="bell" class="bell"></i>
                @if ($notifications->count() > 0)
                <small class="badge badge-sm text-danger">{{ $notifications->count() }}</small>
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
                    @forelse ($notifications as $notification)
                        <a href="{{ route('writer.posts.show',  $notification->data['data']['slug']) }}" class="dropdown-item dropdown-item-unread"> <span
                                class="dropdown-item-icon bg-primary text-white">
                                <i class="fas
                  fa-check"></i>
                            </span> <span class="dropdown-item-desc"> {{ $notification->data['message'] }}! <span
                                    class="time">
                                    @php
                                        // Assuming $post is your model instance fetched from the database
                                        // and $post->created_at is the created_at timestamp
                                        $createdAt = Carbon\Carbon::parse($notification->created_at);
                                        $currentDateTime = Carbon\Carbon::now();

                                        // Calculate the time difference
                                        $timeDifference = $createdAt->diffInMinutes($currentDateTime);

                                        // Format the time difference based on the value
                                        if ($timeDifference < 1) {
                                            $formattedTime = 'Just Now';
                                        } elseif ($timeDifference < 60) {
                                            $formattedTime = $timeDifference . ' Min Ago';
                                        } elseif ($timeDifference < 1440) {
                                            // 1440 minutes = 1 day
                                            $formattedTime = $createdAt->diffForHumans(['parts' => 1]);
                                        } else {
                                            // Handle cases where the time difference is more than a day
                                            $formattedTime = $createdAt->format('M j, Y, g:i A');
                                        }

                                        // Output the formatted time
                                        echo $formattedTime;

                                    @endphp
                                </span>
                            </span>
                        </a>
                        @empty
        <p class="text-muted text-center">
          There are no new notifications
        </p>
                    @endforelse
                </div>
                <div class="dropdown-footer text-center">
                    <a href="{{ route('writer.notifications') }}">View All <i class="fas fa-chevron-right"></i></a>
                </div>
            </div>
        </li>
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                class="nav-link dropdown-toggle nav-link-lg nav-link-user"> <img alt="image"
                    src="{{ auth()->user()->writerInfo->profile ? asset(auth()->user()->writerInfo->profile) : asset('frontend/assets/img/profile.jpg') }}" class="user-img-radious-style"> <span
                    class="d-sm-none d-lg-inline-block"></span></a>
            <div class="dropdown-menu dropdown-menu-right pullDown">
                <div class="dropdown-title">Hello {{ auth()->user()->name }}</div>
                <a href="{{ route('writer.profile') }}" class="dropdown-item has-icon"> <i class="far
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

@section('scripts')
<script>
  function sendMarkRequest(id = null) {
      return $.ajax("{{ route('markNotification') }}", {
          method: 'POST',
          data: {
              _token,
              id
          }
      });
  }
  $(function() {
      $('.mark-as-read').click(function() {
          let request = sendMarkRequest($(this).data('id'));
          request.done(() => {
              $(this).parents('div.alert').remove();
          });
      });
      $('#mark-all').click(function() {
        alert('')
          let request = sendMarkRequest();
          request.done(() => {
              $('div.alert').remove();
          });
      });
  });
  </script>
@endsection
