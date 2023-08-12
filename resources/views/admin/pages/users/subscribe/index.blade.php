@extends('admin.layouts.app')
@section('title', 'Email subscribers')

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
                                        <a class="nav-link active" href="#">All <span
                                                class="badge badge-white">{{ $subscribes->count() }}</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.subscribes.create') }}">Add a subscriber
                                            <span class="badge badge-primary"><i data-feather="plus"></i></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4>All subscribers</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">
                                                    #
                                                </th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($subscribes as $key => $subscriber)
                                                <tr data-subscriber-id="{{ $subscriber->id }}">
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td>
                                                        <a href="#" class="text-dark">
                                                            <span class="d-inline-block ml-1">{{ $subscriber->name }}</span>
                                                            <div class="table-links">
                                                                {{-- <a href="{{ route('admin.subscribes.show', $subscriber->id) }}">View</a> --}}
                                                                {{-- <div class="bullet"></div> --}}
                                                                <a
                                                                    href="{{ route('admin.subscribes.edit', $subscriber->id) }}">Edit</a>
                                                                <div class="bullet"></div>
                                                                <a href="#" class="text-danger delete-link"
                                                                    >Delete</a>
                                                            </div>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{ $subscriber->email }}
                                                    </td>
                                                    <td class="{{ $subscriber->status ? 'text-success' : 'text-danger' }}">
                                                        {{ $subscriber->status ? 'Active' : 'Inactive' }}
                                                    </td>
                                                    <td>{{ $subscriber->created_at->format('M d, Y') }}</td>
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

    <script>
        $(document).ready(function() {
            // Define a function to handle the deletion of a subscriber
            function deleteSubscriber(subscriberId) {

                var url = '{{ route('admin.subscribes.destroy', '__subscriber_id') }}'.replace(
                        '__subscriber_id', subscriberId);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                jQuery.ajax({
                    url: url,
                    type: 'DELETE',
                    data: event.detail,
                    success: function(data) {
                        swal('Success', 'Subscriber deleted successfully!', 'success');
                        setInterval(() => {
                            location.reload();
                        }, 1000);
                    },
                    error: function(error) {
                        // Handle error if deletion fails
                        console.log(error);
                        swal('Error', 'An error occurred while trying to delete the subscriber!',
                            'error');
                    }
                });

                // $.ajax({
                    // url: '{{ route('admin.subscribes.destroy', '__subscriber_id') }}'.replace(
                    //     '__subscriber_id', subscriberId),
                //     type: 'DELETE',
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     success: function(response) {
                //         // Reload the page after successful deletion
                //         swal('Success', 'Subscriber deleted successfully!', 'success');
                //         location.reload();
                //     },
                //     error: function(error) {
                //         // Handle error if deletion fails
                //         console.log(error);
                //         swal('Error', 'An error occurred while trying to delete the subscriber!',
                //             'error');
                //     }
                // });
            }

            $(".delete-link").click(function() {
                swal({
                        title: 'Are you sure?',
                        text: 'Once deleted, you will not be able to recover this subscriber!',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            // Get the subscriber's ID from the delete link's data attribute
                            const subscriberId = $(this).data('subscriber-id');
                            deleteSubscriber(subscriberId);
                        } else {
                            swal('Subscriber deletion canceled.', {
                                icon: 'info',
                            });
                        }
                    });
            });
        });
    </script>
@endsection
