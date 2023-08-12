<div class="activity bg-muted">
    <div class="activity-icon bg-primary text-white">
        <i class="fas
        {{ $icon }}"></i>
    </div>
    <div class="activity-detail">
        <div class="mb-2">
            <span class="text-job">
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
            <span class="bullet"></span>
            <a class="text-job" href="{{ $url }}">View</a>
            @if ($notification->read_at)
                <div class="float-right d-inline m-0 p-0 text-muted">
                    <i>read</i>
                </div>
            @else
                <form action="{{ route('markNotification') }}" class="float-right d-inline m-0 p-0" method="post">
                    @csrf
                    <button type="submit" class="btn btn-none text-info p-0 m-0">Mark as read</button>
                </form>
            @endif

            {{-- <div class="float-right dropdow">

                {{-- <a href="#" data-toggle="dropdown"><i class="fas fa-ellipsis-h"></i></a>
                <div class="dropdown-menu">
                    <div class="dropdown-title">Options</div>
                    <a href="{{ route('admin.posts.show',  $notification->data['data']['slug']) }}" class="dropdown-item has-icon"><i class="fas fa-eye"></i>
                        View</a>

                    <div class="dropdown-divider"></div>

                    {{-- <a href="#" class="dropdown-item has-icon text-danger"
                        data-confirm="Wait, wait, wait...|This action can't be undone. Want to take risks?"
                        data-confirm-text-yes="Yes, IDC"><i class="fas fa-trash-alt"></i>
                        Archive</a> --}}
            {{-- </div> --}}
            {{-- </div> --}}
        </div>
        <div>
            {{ $message }}
        </div>
    </div>
</div>
