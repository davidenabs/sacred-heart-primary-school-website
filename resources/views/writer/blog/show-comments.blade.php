@extends('writer.layouts.app')
@section('title', 'Comments for the post: ' . $post->title)


@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Comments for the post: {{ $post->title }}</h4>
                                <div>
                                    @if (Auth::user()->isAdmin() && $post->comments()->count() > 0)
                                    <button href="#" data-post-id="{{ $post->slug }}" class="delete-link btn btn-sm btn-danger">Delete all</button>
                                    @endif
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-8">
                        <div class="card">
                            <div class="card-header"></div>
                            <div class="card-body">
                                @livewire('guest.comment-post', ['comments' => $post->comments->take(10), 'post' => $post, 'page' => request()->fullUrl(), 'is_admin' => auth()->user()->role === 'ADM'])
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

@endsection

@section('scripts')
    <script src="{{ asset('backend/assets/bundles/chartjs/chart.min.js') }}"></script>
    <script>
        $(document).ready(function() {

            // delete post
            $(".delete-link").click(function() {
                swal({
                        title: 'Are you sure?',
                        text: 'Once deleted, you will not be able to recover this data!',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            const id = $(this).data('post-id');
                            var url = '{{ route('admin.posts.comments.delete', '__id') }}'.replace(
                        '__id', id);
                            deleteData(id, url, 'Comments deleted successfully!', 'GET');
                            setTimeout(() => {
                                location.reload()
                            }, 1000);
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
