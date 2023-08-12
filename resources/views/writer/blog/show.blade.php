@extends('writer.layouts.app')
@section('title', 'Post: ' . $post->title)



@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Post title: {{ $post->title }}</h4>

                                <div>

                                    @if ($post->is_draft)
                                        <a href="{{ route('writer.posts.undraft', $post->slug) }}"
                                            class="btn text-light btn-sm btn-warning">Undraft</a>
                                    @endif
                                    @if (!$post->deleted_at)
                                        <a href="{{ route('writer.posts.edit', $post->slug) }}"
                                            class="btn text-light btn-sm btn-primary">Edit</a>
                                    @endif
                                    @if ($post->deleted_at)
                                        <a href="javascript: void(0)" data-post-id="{{ $post->slug }}"
                                            class="delete-link text-light btn btn-sm btn-danger">Delete</a>
                                    @else
                                        <a href="javascript: void(0)" data-post-id="{{ $post->slug }}"
                                            class="trash-link text-light btn btn-sm btn-warning">Move to trash</a>
                                    @endif

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-7">
                        <article class="article round">
                            <div class="article-header">
                                <div class="article-image rounded" data-background="{{ asset($post->featured_image) }}"
                                    style="background-image: url(&quot;{{ asset($post->featured_image) }}&quot;);">
                                </div>
                                <div class="article-title">
                                    <h2><a href="#">{{ $post->title }}</a></h2>
                                </div>
                            </div>
                            <div class="article-details">
                                {!! $post->content !!}
                                <hr>
                                <h6>Mata title: </h6>
                                <p>
                                    {{ $post->meta_title }}
                                </p>
                                <h6>Mata description: </h6>
                                <p>
                                    {{ $post->meta_description }}
                                </p>
                                <div class="article-cta">
                                    <a href="{{ route('writer.posts.comments', $post->slug) }}" class="btn btn-primary">See
                                        comments</a>
                                </div>
                            </div>
                        </article>
                    </div>

                    <div class="col-12 col-sm-12 col-lg-5">

                        <div class="card">
                            <div class="card-header">
                                <h4>Post Satictics</h4>
                            </div>
                            <div class="card-body pb-0">
                                <div class="table-responsive">
                                    <table class="table table-striped table-md">
                                        <tbody>
                                            <tr>
                                                <td>Total views</td>
                                                <td>{{ App\Http\Controllers\Admin\BlogController::formatNumber($post->views) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Total comments</td>
                                                <td>{{ $post->commentable ? App\Http\Controllers\Admin\BlogController::formatNumber($post->comments()->count())  : 'Not commentable' }}
                                                </td>
                                            </tr>
                                            {{-- <tr>
                                                <td>Total likes</td>
                                                <td>{{ $post->likes }}</td>
                                            </tr> --}}
                                            {{-- <tr>
                                                <td>Total shares</td>
                                                <td>{{ $post->shares }}</td>
                                            </tr> --}}
                                            <tr>
                                                <td>Published</td>
                                                <td>{{ $post->is_published ? 'True' : 'False' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Created date</td>
                                                <td>{{ $post->created_at->format('M d, Y') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Published date</td>
                                                <td>{{ $post->published_at ? Carbon\Carbon::parse($post->published_at)->format('M d, Y') : 'Not publish yet' }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Last updated</td>
                                                <td>{{ $post->updated_at->format('M d, Y') }}</td>
                                            </tr>

                                            <tr>
                                                <td>Draft</td>
                                                <td>{{ $post->is_draft ? 'True' : 'False' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Trash</td>
                                                <td>{{ $post->deleted_at ? 'True' : 'False' }}</td>
                                            </tr>
                                            <tr>
                                                <td>Post link</td>
                                                <td>
                                                    <div class="form-group">
                                                        <div class="input-group mb-3">
                                                            <input type="text" id="copyLink" class="form-control"
                                                                value="{{ route('blog.show', $post->slug) }}">
                                                            <div class="input-group-append">
                                                                <button class="btn btn-success" id="copyButton"
                                                                    type="button"><i class="fa fa-clipboard"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        @php
                            $totalPostViews = App\Models\Blog\Post::sum('views');
                            $totalPostComments = App\Models\Blog\Post::sum('commentable');
                            $totalPostShares = App\Models\Blog\Post::sum('shares');

                            $viewPercentage = 0;
                            $commentPercentage = 0;
                            $sharePercentage = 0;

                            if ($totalPostViews) {
                                $viewPercentage = ($post->views / $totalPostViews) * 100;
                                $commentPercentage = ($post->shares / $totalPostViews) * 100;
                                $sharePercentage = ($post->commentable / $totalPostViews) * 100;
                            }
                        @endphp


                        <div class="card mt-4">
                            <div class="card-header">
                                <h4>Post chart</h4>
                            </div>
                            <div class="card-body pb-0">
                                {{-- <canvas id="postAnalyticsChart" width="400", height="200"></canvas> --}}
                                <canvas id="postAnalyticsChart" width="729" height="364"
                                    style="display: block; width: 729px; height: 364px;"
                                    class="chartjs-render-monitor"></canvas>
                                <ul class="p-t-30 list-unstyled">
                                    <li class="padding-5"><span><i
                                                class="fa fa-circle m-r-5 col-black"></i></span>Views<span
                                            class="float-right">{{ ceil($viewPercentage) }}%</span></li>
                                    <li class="padding-5"><span><i
                                                class="fa fa-circle m-r-5 col-green"></i></span>Shares<span
                                            class="float-right">{{ ceil($commentPercentage) }}%</span></li>
                                    <li class="padding-5"><span><i
                                                class="fa fa-circle m-r-5 col-orange"></i></span>Comments<span
                                            class="float-right">{{ ceil($sharePercentage) }}%</span></li>
                                </ul>
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
            var postId = @json($post->slug);
            var route = @json(route('writer.analytics.posts', $post->slug));
            var ctx = document.getElementById('postAnalyticsChart').getContext('2d');

            $.ajax({
                url: route,
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    var chart = new Chart(ctx, {
                        type: 'doughnut',
                        data: {
                            labels: ['views', 'Shares', 'Comments'],
                            datasets: [{
                                label: 'Post Analytics',
                                data: [data.views, data.shares, data.comments],
                                backgroundColor: [
                                    '#191d21',
                                    '#63ed7a',
                                    '#ffa426',
                                ],
                            }]
                        },
                        options: {
                            responsive: true,
                            legend: {
                                position: 'bottom',
                                display: false
                            },
                        }
                    });
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });

            // delete post
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
                            var url = '{{ route('writer.posts.forceDestroy', '__id') }}'.replace(
                                '__id', postId);
                            deleteData(postId, url);
                            location.reload("{{ route('writer.posts.index') }}")
                        } else {
                            swal('Operation canceled successfully.', {
                                icon: 'info',
                            });
                        }
                    });
            });

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
                            var url = '{{ route('writer.posts.destroy', '__id') }}'.replace(
                                '__id', postId);
                            deleteData(postId, url);
                            location.reload()
                        } else {
                            swal('Operation canceled successfully.', {
                                icon: 'info',
                            });
                        }
                    });
            });

            // Function to copy the value in the input field to the clipboard
            function copyToClipboard() {
                var copyText = $("#copyLink");
                copyText.select();
                document.execCommand("copy");

                // Optionally, you can add some visual feedback to indicate the successful copy
                var copyButton = $("#copyButton");
                copyButton.html("<i class='fa fa-check'></i>");
                setTimeout(function() {
                    copyButton.html("<i class='fa fa-clipboard'></i>");
                }, 1000); // Reset the button icon after 1 second
            }

            // Add an event listener to the copy button to call the copyToClipboard function
            $("#copyButton").on("click", copyToClipboard);
        });
        document.addEventListener('DOMContentLoaded', function() {
            var postId = {{ $post->slug }};
            var ctx = document.getElemeny
        });
    </script>
@endsection
