@extends('guest.layouts.app')
@section('title', 'News, Acticle and Event')

@section('content')

    @isset($category)
        @include('guest.includes.header', [
            'title' => $category->title,
            'description' => 'Category',
        ])
    @else
        @include('guest.includes.header', ['title' => 'Blog Posts and Events', 'description' => 'Our Blog'])
    @endisset

    <!-- Blog Start -->
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-lg-8">
                @isset($category)
                    <div class="text-center pb-2">
                        <p class="section-title px-5"><span class="px-2">Category</span></p>
                        <h1 class="mb-4">Articles On This Category</h1>
                        <p class="my-3 py-2 border-top border-bottom">
                            {{ $category->description }}
                    </div>
                @else
                    <div class="text-center pb-2">
                        <p class="section-title px-5"><span class="px-2">Latest Blog Post</span></p>
                        <h1 class="mb-4">Latest Articles From Blog</h1>
                    </div>
                @endisset

                <div class="row pb-3">
                    @if ($posts->count() > 0)

                        @foreach ($posts as $post)
                            <div class="col-12 col-sm-6 col-md-6 col-lg-6">
                                <article class="article article article-style-c">
                                    <div class="article-header">
                                        <div class="article-image rounded"
                                            data-background="{{ asset($post->featured_image) }}"
                                            style="background-image: url(&quot;{{ asset($post->featured_image) }}&quot;);">
                                        </div>
                                        <div class="article-title">
                                            <h2><a href="{{ route('blog.show', $post->slug) }}">{{ $post->title }}</a></h2>
                                        </div>
                                    </div>
                                    <div class="article-details">
                                        <div class="article-category"><a
                                                href="{{ route('category.show', $post->category->slug) }}">{{ $post->category->title }}</a>
                                            <div class="fa fab-dot"></div> <a
                                                href="javascript: void(0)">{{ Str::upper($post->created_at->diffForHumans()) }}</a>
                                        </div>
                                        <p>
                                            {{ Str::limit($post->summary, 150, '...') }}
                                        </p>

                                        <div class="article-cta text-right">
                                            <small>
                                                <a href="{{ route('blog.show', $post->slug) }}" class="text-primary">Read
                                                    More</a> <i class="fas fa-chevron-right"></i>
                                            </small>
                                        </div>
                                    </div>

                                </article>
                            </div>
                        @endforeach



                        <div class="col-md-12 mb-4">
                            {{-- <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link active" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav> --}}
                            {{
                                $posts->appends(['search' => request()->query('search')])
                                ->links('vendor.pagination.bootstrap-4')
                            }}
                        </div>
                    @else
                        <p class="text-muted text-center">Opps! No Post Available.</p>
                    @endif

                </div>
            </div>
            @include('guest.includes.right-sidebar')
        </div>
    </div>
    <!-- Blog End -->
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/css/components.css') }}">
@endsection
