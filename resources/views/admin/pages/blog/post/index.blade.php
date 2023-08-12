@extends('admin.layouts.app')
@section('title', 'News, Events, Article Posts')



@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-0">
                            <div class="card-body">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link @if (Route::currentRouteName() === 'admin.posts.index') active @endif"
                                            href="{{ route('admin.posts.index') }}">All <span
                                                class="badge @if (Route::currentRouteName() === 'admin.posts.index') badge-white @else badge-primary @endif">{{ $postsCount }}</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if (Route::currentRouteName() === 'admin.draft.posts') active @endif"
                                            href="{{ route('admin.draft.posts', 'draft') }}">Draft <span
                                                class="badge  @if (Route::currentRouteName() === 'admin.draft.posts') badge-white @else badge-primary @endif ">{{ $draftCount }}</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if (Route::currentRouteName() === 'admin.pending.posts') active @endif"
                                            href="{{ route('admin.pending.posts', 'pending') }}">Pending <span
                                                class="badge  @if (Route::currentRouteName() === 'admin.pending.posts') badge-white @else badge-primary @endif">{{ $pendingCount }}</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link @if (Route::currentRouteName() === 'admin.posts.trash') active @endif"
                                            href="{{ route('admin.posts.trash', 'trash') }}">Trash <span
                                                class="badge  @if (Route::currentRouteName() === 'admin.posts.trash') badge-white @else badge-primary @endif">{{ $trashCount }}</span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- {{ $posts }} --}}
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All Posts</h4>
                            </div>
                            <div class="card-body">
                                <div class="clearfix mb-3"></div>
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-2">
                                        <thead>
                                            <tr>
                                                <th class="pt-2">
                                                    #
                                                </th>
                                                <th>Author</th>
                                                <th>Featured Image</th>
                                                <th>Title</th>
                                                <th>Category</th>
                                                <th>Created At</th>
                                                <th>Views</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($posts as $key => $post)
                                                <tr id="{{ $post->slug }}">
                                                    <td>
                                                        {{ ++$key }}
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.posts.user.show', $post->author->id) }}">
                                                          {{ $post->author->name  }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                      <img alt="image"
                                                      src="{{ asset($post->featured_image) }}"
                                                      class="rounded" width="50" height="50" data-toggle="title"
                                                      title="{{ $post->title . ' featured image' }}">
                                                    </td>
                                                    <td>
                                                        {{ Str::limit(strip_tags($post->title), 100, '...') }}
                                                        <div class="table-links">
                                                            <a href="{{ route('admin.posts.show', $post->slug) }}">View</a>
                                                            <div class="bullet"></div>
                                                            @if (!$is_trash && Auth::id() === $post->author_id )
                                                            <a href="{{ route('admin.posts.edit', $post->slug) }}">Edit</a>
                                                            <div class="bullet"></div>
                                                            @endif
                                                            @if(!$post->is_published)
                                                            <a href="{{ route('admin.posts.publish', $post->slug) }}">Publish</a>
                                                            <div class="bullet"></div>
                                                            @endif
                                                            @if (!$is_trash && $post->id === Auth::id())
                                                            {{-- <div class="bullet"></div> --}}
                                                            <a href="javascript: void(0)" class="text-danger trash-link"
                                                            data-post-id="{{ $post->slug }}">Trash</a>
                                                            @else
                                                            <a href="javascript: void(0)"
                                                            class="delete-link text-danger">Delete</a>
                                                            @endif

                                                            @if ($is_trash && $post->id === Auth::id())
                                                            <a href="#"
                                                            class="delete-link text-danger">Delete</a>

                                                            <div class="bullet"></div>
                                                            <a class="text-success"
                                                            href="{{ route('admin.posts.restore', $post->slug) }}">Restore</a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.posts.category.show', $post->category->slug) }}">{{ $post->category->title  }}</a>
                                                    </td>
                                                    <td>{{ $post->created_at->format('M d, Y') }}</td>
                                                    <td>
@php
    echo App\Http\Controllers\Admin\BlogController::formatNumber($post->views);
@endphp
                                                    </td>
                                                    <td>
                                                        @if (!$post->is_published && $post->is_draft)
                                                            <div class="badge badge-info">Draft</div>
                                                        @elseif($post->is_published)
                                                            <div class="badge badge-success">Published</div>
                                                        @else
                                                            <div class="badge badge-warning">Pending</div>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/datatables/datatables.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('backend/assets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('backend/assets/bundles/datatables/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/js/page/datatables.js') }}"></script>
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {

            $(".trash-link").click(function() {
                swal({
                        title: 'Are you sure?',
                        text: 'You are about to move this post to the trash!',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            const postId = $(this).data('post-id');
                            var url = '{{ route('admin.posts.destroy', '__id') }}'.replace(
                        '__id', postId);
                            deleteData(postId, url);
                        } else {
                            swal('Operation canceled successfully.', {
                                icon: 'info',
                            });
                        }
                    });
            });

            $(".delete-link").click(function() {
                swal({
                        title: 'Are you sure?',
                        text: 'You are about to delete a post, once deleted, you will not be able to recover this it!',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            const postId = $(this).data('post-id');
                            var url = '{{ route('admin.posts.forceDestroy', '__id') }}'.replace(
                        '__id', postId);
                            deleteData(postId, url);
                        } else {
                            swal('Operation canceled successfully.', {
                                icon: 'info',
                            });
                        }
                    });
            });
        });
    </script>
@endsection
