@if ($posts->count() > 0)
    <div class="pt-2 bg-whit">
        <div class="container">
            <div class="text-center pb-2">
                <p class="section-title px-5"><span class="px-2">Latest School Blog</span></p>
                <h1 class="mb-4">Latest Articles From Our Blog</h1>
            </div>
            <div class="row pb-">
                @foreach ($posts as $post)
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <article class="article article article-style-c">
                            <div class="article-header">
                                <div class="article-image rounded" data-background="{{ asset($post->featured_image) }}"
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
            </div>
        </div>
    </div>
@endif
