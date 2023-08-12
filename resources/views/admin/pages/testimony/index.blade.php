@extends('admin.layouts.app')
@section('title', 'Reviews')


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
                                        <a class="nav-link active "
                                            href="{{ route('admin.testimonies.index') }}">All <span
                                                class="badge badge-white">{{ $testimonies->count() }}</span></a>
                                    </li>
                                    {{-- <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.testimonies.create') }}">Add a photos to gallery <span
                                                class="badge badge-primary"><i data-feather="plus"></i></span></a>
                                    </li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>Testimonies and Reviews</h4>
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
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Review</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($testimonies as $key => $testimony)
                                                <tr id="{{ $testimony->id }}">
                                                    <td>
                                                        {{ ++$key }}
                                                    </td>
                                                    <td>
                                                        {{ $testimony->name }}
                                                        <div class="table-links">
                                                            {{-- <a href="{{ route('admin.testimonies.show', $gallery->slug) }}">View</a>--}}
                                                            {{-- <div class="bullet"></div> --}}
                                                            <a href="{{ route('admin.testimonies.edit', $testimony->id) }}">Edit</a>

                                                            <div class="bullet"></div>
                                                            <a href="javascript: void(0)" class="text-danger delete-link"
                                                            data-post-id="{{ $testimony->id }}">Delete</a>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $testimony->email  }}
                                                    </td>
                                                    <td>
                                                        {{ $testimony->review  }}
                                                    </td>
                                                    <td>
                                                    @if($testimony->is_approve)
                                                        <div class="badge badge-success">Approved</div>
                                                    @else
                                                        <div class="badge badge-warning">Pending</div>
                                                    @endif
                                                    </td>
                                                    <td>{{ $testimony->created_at->format('M d, Y') }}</td>
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
                            const postId = $(this).data('post-id');
                            var url = '{{ route('admin.testimonies.destroy', '__id') }}'.replace(
                        '__id', postId);
                            deleteData(postId, url, 'Gallery deleted successfully');
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
