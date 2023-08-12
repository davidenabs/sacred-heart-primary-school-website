@extends('admin.layouts.app')
@section('title')
    Notifications
@endsection

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <h2 class="section-title">Notifications</h2>
                <div class="row">
                    <div class="col-12">
                        <div class="activities">
                            <div class="activit">
                                @forelse ($notifications->take(20) as $notification)
                                    @if ($notification->type == 'App\Notifications\Admin\NewMailSentNotification')
                                        @include('admin.includes.notification-body', [
                                            'message' => $notification->data['message'],
                                            'url' => route('admin.mail.show', $notification->data['data']['id']),
                                            'icon' => 'fa-envelope',
                                        ])
                                    @elseif($notification->type == 'App\Notifications\Admin\PostCreatedNotification')
                                        @include('admin.includes.notification-body', [
                                            'message' => $notification->data['message'],
                                            'url' => route(
                                                'admin.posts.show',
                                                $notification->data['data']['slug']),
                                            'icon' => 'fa-pencil-alt',
                                        ])
                                    @endif
                                @empty
                                    <p class="text-cneter text-muted">No Notification yet!</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
