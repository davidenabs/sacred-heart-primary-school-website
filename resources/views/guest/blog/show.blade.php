@extends('guest.layouts.app')
@section('title', $post->title)
@section('meta_keyboard', $post->title)
@section('meta_description', $post->meta_description)
@section('other_meta_tags')
<meta property="og:type" content="article" />
<meta property="og:title" content={{ $post->title }}">
<meta property="og:description" content="{{ $post->summary }}">
<meta property="og:image" content="{{ asset($post->featured_image) }}">
<meta property="og:url" content="{{ route('blog.show', $post->slug) }}">

<!-- Twitter Cards -->
<meta name="twitter:title" content={{ $post->title }}">
<meta name="twitter:description" content="{{ $post->summary }}">
<meta name="twitter:image" content="{{ asset($post->featured_image) }}">
@endsection

@section('content')
    @include('guest.includes.header', ['title' => $post->title, 'description' => $post->category->title])
    <!-- Detail Start -->
    <div class="container py-2">
        <div class="row pt-5">
            <div class="col-lg-8">
                <div class="d-flex flex-column text-left mb-3">
                    <p class="section-title"><span class=" bg-light">Blog Post</span></p>
                    <h1 class="mb-3 revealfade-bottom">{{ $post->title }}</h1>
                    <div class="d-md-flex justify-content-between w-100">
                        <div class="text-md-center text-muted">
                            <i class="fa fa-user"></i> <a href="{{ route('about') }}"
                                class="mr-3 text-muted">{{ $post->author->name }}</a>
                            <i class="fa fa-folder"></i> <a href="{{ route('category.show', $post->category->slug) }}"
                                class="mr-3 text-muted">{{ $post->category->title }}</a>
                            <i class="fa fa-comments"></i> <a href="#comment"
                                class="mr-3 text-muted">{{ $post->comments()->count() }}</a>
                            <i class="fa fa-eye"></i> {{ $post->views }}
                        </div>
                        <div class="text-center">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ route('blog.show', $post->slug) }}" target="_blank" class="btn btn-primary btn-sm">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://www.instagram.com/sharer.php?u={{ route('blog.show', $post->slug) }}"
                            target="_blank" class="btn btn-danger btn-sm">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="https://api.whatsapp.com/send?text={{ route('blog.show', $post->slug) }}"
                            target="_blank" class="btn btn-success btn-sm">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>

                    </div>
                </div>
                <article class="mb-5article article article-style-c">
                    <div class="article-header shadow-none" style="height: 65vh">
                        <div class="article-image rounded" data-background="{{ asset($post->featured_image) }}"
                            style="background-image: url(&quot;{{ asset($post->featured_image) }}&quot;);">
                        </div>
                    </div>
                </article>
                <div class="my-5 border-bottom">
                    {!! $post->content !!}
                </div>

                <!-- Related Post -->
                @if ($relatedPosts->count() > 0)
                    <div class="mb-5 mx-n3">
                        <h4 class="mb-4 ml-3">Related Post</h4>
                        <div class="owl-carousel post-carousel position-relative">
                            @foreach ($relatedPosts as $item)
                                <div class="d-flex align-items-center bg-light shadow-sm rounded overflow-hidden mx-3">
                                    <img class="" src="{{ asset($item->featured_image) }}"
                                        style="width: 80px; height: 80px;">
                                    <div class="pl-3">
                                        <h5><a href="{{ route('blog.show', $item->slug) }}"
                                                class="text-primary">{{ $item->title }}</a></h5>
                                        <div class="d-flex text-muted text-small">
                                            <small class="mr-3"><i class="fa fa-folder"></i>
                                                {{ $item->category->title }}</small>
                                            <small class="mr-3"><i class="fa fa-comments"></i> {{ $item->comments()->count() }}</small>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Comment List -->
                @if ($post->commentable)
                    @livewire('guest.comment-post', ['comments' => $post->comments->take(10), 'post' => $post, 'page' => request()->fullUrl(), 'is_admin' => false])
                @endif
            </div>

            @include('guest.includes.right-sidebar')
        </div>
    </div>
    <!-- Detail End -->
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
@endsection
