@extends('writer.layouts.app')
@section('title')
    Dashboard
@endsection

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row ">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Total Posts</h5>
                                            <h2 class="mb-3 font-18">{{ $posts['totalPosts'] }}</h2>
                                            <p class="mb-0"><span
                                                    class="col-green">{{ $posts['percentageThisMonth'] }}%</span> Posting
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('backend/assets/img/banner/1.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15"> Views</h5>
                                            <h2 class="mb-3 font-18">{{ $views['viewsThisMonth'] }}</h2>
                                            <p class="mb-0"><span
                                                    class="col-orange">{{ $views['percentageViewsChange'] }}%</span>
                                                {{ $views['viewsChange'] }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('backend/assets/img/banner/2.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Comments</h5>
                                            <h2 class="mb-3 font-18">{{ $comments['commentsThisMonth'] }}</h2>
                                            <p class="mb-0"><span
                                                    class="col-green">{{ $comments['percentageCommentsChange'] }}%</span>
                                                {{ $comments['commentsChange'] }}</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="{{ asset('backend/assets/img/banner/3.png') }}" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="car">
                        <div class="card-header">
                            <h4>Quick Link</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <a href="{{ route('writer.posts.create') }}" class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 nav-link">
                                    <div class="card">
                                        <div class="card-statistic-4">
                                            <div class="align-items-center justify-content-between">
                                                <div class="row ">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                                        <div class="card-content">
                                                            <h5 class="font-15">Create posts</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                                        <div class="banner-img float-right">
                                                            <i class="fas fa-pencil-alt text-muted" style="font-size: 50px"></i>
                                                            {{-- <img src="{{ asset('backend/assets/img/banner/3.png') }}" alt=""> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('writer.posts.index') }}" class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 nav-link">
                                    <div class="card">
                                        <div class="card-statistic-4">
                                            <div class="align-items-center justify-content-between">
                                                <div class="row ">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                                        <div class="card-content">
                                                            <h5 class="font-15">All posts</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                                        <div class="banner-img float-right">
                                                            <i class="fas fa-parking text-muted" style="font-size: 50px"></i>
                                                            {{-- <img src="{{ asset('backend/assets/img/banner/3.png') }}" alt=""> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('writer.galleries.create') }}" class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 nav-link">
                                    <div class="card">
                                        <div class="card-statistic-4">
                                            <div class="align-items-center justify-content-between">
                                                <div class="row ">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                                        <div class="card-content">
                                                            <h5 class="font-15">Add photos</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                                        <div class="banner-img float-right">
                                                            <i class="
                                                            fas fa-plus-circle text-muted" style="font-size: 50px"></i>
                                                            {{-- <img src="{{ asset('backend/assets/img/banner/3.png') }}" alt=""> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>

                                <a href="{{ route('writer.galleries.index') }}" class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12 nav-link">
                                    <div class="card">
                                        <div class="card-statistic-4">
                                            <div class="align-items-center justify-content-between">
                                                <div class="row ">
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                                        <div class="card-content">
                                                            <h5 class="font-15">Manage Gallery</h5>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                                        <div class="banner-img float-right">
                                                            <i class="
                                                            far fa-images text-muted" style="font-size: 50px"></i>
                                                            {{-- <img src="{{ asset('backend/assets/img/banner/3.png') }}" alt=""> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Recent posts</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                @if ($posts['posts']->count() > 0)
                                    <table class="table table-hover mb-0">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Title</th>
                                                <th>Views</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($posts['posts']->take(10) as $key => $post)
                                                <tr>
                                                    <td>{{ ++$key }}</td>
                                                    <td>
                                                        <a href="{{ route('writer.posts.show', $post->slug) }}">
                                                            {{ $post->title }}
                                                        </a>
                                                    </td>
                                                    <td>@php
                                                        echo App\Http\Controllers\Admin\BlogController::formatNumber($post->views);
                                                    @endphp</td>
                                                    <td>
                                                        @if (!$post->is_published && $post->is_draft)
                                                            <div class="badge badge-info">Draft</div>
                                                        @elseif($post->is_published)
                                                            <div class="badge badge-success">Published</div>
                                                        @else
                                                            <div class="badge badge-warning">Pending</div>
                                                        @endif
                                                    </td>
                                                    <td>{{ $post->created_at->format('M d, Y') }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @else
                                    <p class="text-muted text-center">
                                        You haven't created any post yet!
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
@endsection
