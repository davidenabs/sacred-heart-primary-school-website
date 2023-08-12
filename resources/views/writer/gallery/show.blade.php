@extends('writer.layouts.app')
@section('title', 'Post: ' . $gallery->title)



@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between">
                                <h4>Gallery title: {{ $gallery->title }}</h4>

                                <div>

                                    <a href="#" class="btn btn-sm btn-primary">Edit</a>
                                    {{-- <a href="javascript: void(0)" data-post-id="{{ $gallery->slug }}"
                                        class="delete-links text-light btn btn-sm btn-danger">Delete</a> --}}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12 col-lg-12">
                        <div class="card">


                            <div class="card-body">

                                <strong>Description: </strong>
                                <p>{{ $gallery->description == '' ? 'No description available' : $gallery->description }}
                                </p>
                                <strong>Photos: </strong>
                                <div class="gallery">

                                    @forelse (json_decode($gallery->photos) as $item)
                                        <div class="gallery-item" data-image="{{ asset($item) }}" data-title="Image 1">
                                        </div>
                                    @empty
                                        <p class="text-muted text-center">No photo available!</p>
                                    @endforelse

                                </div>
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
    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/chocolat/dist/css/chocolat.css') }}">
@endsection

@section('scripts')
    <script src="{{ asset('backend/assets/bundles/chocolat/dist/js/jquery.chocolat.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/page/gallery1.js') }}"></script>
    <script src="{{ asset('backend/assets/js/custom.js') }}"></script>
    <script>
        $(document).ready(function() {

            // delete post
            // $(".delete-links").click(function() {
            //     swal({
            //             title: 'Are you sure?',
            //             text: 'Once deleted, you will not be able to recover this data!',
            //             icon: 'warning',
            //             buttons: true,
            //             dangerMode: true,
            //         })
            //         .then((willDelete) => {
            //             if (willDelete) {
            //                 const id = $(this).data('post-id');
            //                 var url = '{{ route('writer.galleries.destroy', '__id') }}'.replace(
            //                     '__id', id);
            //                 deleteData(id, url, 'Gallery deleted successfully');
            //                 location.replace('{{ route('writer.galleries.index') }}')
            //             } else {
            //                 swal('Operation canceled successfully.', {
            //                     icon: 'info',
            //                 });
            //             }
            //         });
            // });
        });
    </script>
@endsection
