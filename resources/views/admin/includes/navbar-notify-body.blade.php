<a id="" href="#" data-note-id="{{ $notification->id }}"
    class="markAsRead dropdown-item dropdown-item-unread"> <span class="dropdown-item-icon bg-primary text-white">
        <i class="fas {{ $icon }}"></i>
    </span> <span class="dropdown-item-desc"> {{ $message }}! <span class="time">
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

@section('scripts')
    <script>
        // $(function() {
        $('.markAsRead').click(function(e) {
            e.preventDefault();
            var id = $(this).data('note-id');

            jQuery.ajax({
                url: url,
                type: 'POST',
                data: {
                    $('meta[name="csrf-token"]').attr('content'),
                    id
                },
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(data) {
                    console.log(data);
                    setInterval(() => {
                        location.reload();
                    }, 1000);
                },
                error: function(error) {
                    console.log(error);
                }
            });

            // let request = $.ajax("{{ route('markNotification') }}", {
            //     method: 'POST',
            //     data: {
            // $('meta[name="csrf-token"]').attr('content'),
            // id
            //     }
            // });


            console.log(request);
            // request.done(() => {
            //     location.reload()
            // });
        })
        // })
    </script>
@endsection
