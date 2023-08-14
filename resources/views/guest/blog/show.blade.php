@extends('guest.layouts.app')

@section('content')
    @include('guest.includes.header', ['title' => $post->title, 'description' => $post->category->title])
    <!-- Detail Start -->
    <div class="container py-2">
        <div class="row pt-5">
            <div class="col-lg-8">
                <div class="d-flex flex-column text-left mb-3">
                    <p class="section-title"><span>Blog Post</span></p>
                    <h1 class="mb-3 revealfade-bottom">{{ $post->title }}</h1>
                    <div class="d-md-flex justify-content-between border rounded bg-light p-2" style="font-size: 13px">
                        <div class="text-md-cente text-muted">
                            <i class="fa fa-user"></i> <a href="{{ route('about') }}"
                                class="mr-3 text-muted">{{ $post->author->name }}</a>
                            <i class="fa fa-folder"></i> <a href="{{ route('category.show', $post->category->slug) }}"
                                class="mr-3 text-muted">{{ $post->category->title }}</a>
                            <i class="fa fa-comments"></i> <a href="#comment"
                                class="mr-3 text-muted">{{ $post->comments()->count() }}</a>
                            <i class="fa fa-eye"></i> {{ $post->views }}
                        </div>
                        <div>
                            <i class="fa fa-clock"></i> Published: {{ $post->created_at->format('M d, Y') }}
                        </div>
                    </div>
                    <div class="social-btn-sp mt-4">
                        {!! $shareButtons !!}
                  </div>
                </div>
                <article class=" article article-style-c" style="box-shadow: none;">
                    <div class="article-header" >
                    <div class="article-image" data-background="{{ asset($post->featured_image) }}" style="background-image: url(&quot;{{ asset($post->featured_image) }}&quot;);">
                    </div>
                </div>
                </article>
                <div class="my-5 border-bottom pb-3">
                    {!! $post->content !!}
                </div>
                <div class="social-btn-sp">
                    {!! $shareButtons !!}
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

<style>
    #social-links ul{
         padding-left: 0;
    }
    #social-links ul li {
         display: inline-block;
    }
    #social-links ul li a {
         padding: 6px;
         border: 1px solid #ccc;
         border-radius: 5px;
         margin: 1px;
         font-size: 25px;
    }
    #social-links .fa-facebook{
          color: #0d6efd;
    }
    #social-links .fa-twitter{
          color: deepskyblue;
    }
    #social-links .fa-linkedin{
          color: #0e76a8;
    }
    #social-links .fa-whatsapp{
         color: #25D366
    }
    #social-links .fa-reddit{
         color: #FF4500;;
    }
    #social-links .fa-telegram{
         color: #0088cc;
    }
    </style>
@endsection

@section('scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="{{ asset('js/share.js') }}"></script>
@endsection