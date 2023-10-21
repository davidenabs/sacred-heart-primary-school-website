<div class="col-lg-4 mt-5 mt-lg-0">
    <!-- Author Bio -->
    {{-- <div class="d-flex flex-column text-center rounded mb-5 py-5 px-4 reveal fade-right" style="background-color: rgb(31, 30, 112);">
        <img src="img/profile.jpg" class=" rounded-circle mx-auto mb-3" style="width: 100px;">
        <h4 class="text-white mb-3 animate__animated animate__backInRight">Godwin Daniel</h4>
        <p class="text-white m-0">Conset elitr erat vero dolor ipsum et diam, eos dolor lorem ipsum, ipsum ipsum sit no ut est. Guber ea ipsum erat kasd amet est elitr ea sit.</p>
    </div> --}}

    <!-- Search Form -->
    <div class="mb-5">
        <form action="" method="GET">
            <div class="input-group">
                <input type="text" name="search" class="form-control form-control-md" placeholder="Keyword" value="{{request()->query('search')}}">
                <div class="input-group-append">
                    <span class="input-group-text bg-transparent text-primary"><i
                            class="fa fa-search"></i></span>
                </div>
            </div>
        </form>
    </div>

    @if ($categories->count() > 0)
        <!-- Category List -->
    <div class="mb-5">
        <h4 class="mb-4">Categories</h4>
        <div class="p-3 rounded bg-white shadow-sm">
        <ul class="list-group list-group-flush">
            @foreach ($categories as $category)
            <li class="list-group-item px-0 d-flexustify-content-between">
                    <a href="{{ route('category.posts', $category) }}" class="shs-text-primary-color">
                        {{  $category->title }}
                        <span class="badge badge-primary badge-pill float-right">
                            {{ $category->posts()->where('is_published', true)->where('is_draft', false)->count() }}
                        </span>
                    </a>

            </li>
            @endforeach
        </ul>
    </div>
    </div>
    @endif

    <!-- Recent Post -->
    @if ($recentPosts->count() > 0)
    <div class="mb-5">
        <h4 class="mb-4">Recent Posts</h4>
        <div class="p-3 rounded bg-white shadow-sm">
        @foreach ($recentPosts as $item)
        <div class="d-flex lign-items-center bg-none {{ $loop->last ? '' : ' border-bottom' }} overflow-hidden mb-3 revealfade-left">
            <img class="d-md-block d-none" src="{{ asset($item->featured_image) }}" style="width: 50px; height: 50px;">
            <div class="pl-md-3 pl-0">
                <h6 class="mb-1"><a href="{{ route('blog.show', $item->slug) }}">{{ $item->title }}</a></h6>
                <div class="w-100">
                    <small class="" style="font-size: 12px"><i class="fa fa-folder text-muted"></i> {{ $item->category->title }}</small>

                </div>
            </div>
        </div>
        @endforeach
        </div>
    </div>
    @endif

    <!-- Pubular Post -->
    @if (isset($popularPosts) && $popularPosts->count() > 0)
    <div class="mb-5">
        <h4 class="mb-4">Popular Posts</h4>
        <div class="p-3 rounded bg-white shadow-sm">
        @foreach ($popularPosts as $key => $item)
        <div class="d-flex align-items-center bg-none {{ $loop->last ? '' : ' border-bottom' }} overflow-hidden mb-3 revealfade-left">
            <img class="d-md-block d-none" src="{{ asset($item->featured_image) }}" style="width: 50px; height: 50px;">
            <div class="pl-md-3 pl-0"">
                <h6 class="mb-1"><a href="{{ route('blog.show', $item->slug) }}">{{ $item->title }}</a></h6>
                <div class="d-flex justify-content-between">
                    <small class="" style="font-size: 12px"><i class="fa fa-folder text-muted"></i> {{ $item->category->title }}</small>
                </div>
            </div>
        </div>
        @endforeach
        </div>
    </div>
@endif


    <!-- Plain Text -->
    {{-- <div>
        <h4 class="mb-4">About Us</h4> --}}
        {{-- <img class="" src="{{ asset($item->featured_image) }}" class="text-center" style="width: 80px; height: 80px;"> --}}
            {{-- Aliquyam sed lorem stet diam dolor sed ut sit. Ut sanctus erat ea est aliquyam dolor et. Et no consetetur eos labore ea erat voluptua et. Et aliquyam dolore sed erat. Magna sanctus sed eos tempor rebum dolor, tempor takimata clita sit et elitr ut eirmod. --}}
    {{-- </div> --}}
</div>