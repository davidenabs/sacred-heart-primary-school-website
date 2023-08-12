@extends('admin.layouts.app')
@section('title', 'User::' . Str::ucfirst($type))

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-0">
                            <div class="card-body d-flex justify-content-between">
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#">All <span
                                                class="badge badge-white">{{ $users->count() }}</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.users.create', $type) }}">Add a
                                            {{ $type }} <span class="badge badge-primary"><i
                                                    data-feather="plus"></i></span></a>
                                    </li>

                                </ul>
                                <ul class="nav nav-pills">
                                    <li class="nav-item">
                                        <a class="nav-link text-danger"
                                            href="{{ route('admin.users.trash', $type) }}">Blocked {{ Str::plural($type, 0) }}<span
                                                class="badge badge-sm badge-danger">{{ $trashUser->count() }}</span></a>
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
                                <h4>All {{ Str::ucfirst($type) }}</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Profile</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Bio</th>
                                                <th>Last Seen</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $key => $user)
                                                <tr id="{{ $user->id }}" data-myuser-id="{{ $user->id }}">
                                                    <td class="text-center">{{ ++$key }}</td>
                                                    <td>
                                                        <img alt="image"
                                                            src="{{ asset($user->profile_phone_path ?? 'shs/img/sacred-heart-international-school.jpeg') }}"
                                                            class="rounded-circle" width="35" height="35"
                                                            data-toggle="title" title="{{ $user->name . ' avatar' }}">
                                                    </td>
                                                    <td>
                                                        <a href="#" class="text-dark">
                                                            <span class="d-inline-block ml-">{{ $user->name }}</span>
                                                            @if ($user->id != '1' && $user->email != env('APP_EMAIL'))
                                                                <div class="table-links">
                                                                    <a href="{{ route('admin.users.show', [$type, $user->id]) }}">View</a>
                                                                    <div class="bullet"></div>
                                                                    @if (!isset($is_trash))
                                                                    <a
                                                                        href="{{ route('admin.users.edit', [$type, $user->id]) }}">Edit</a>
                                                                    <div class="bullet"></div>
                                                                    <a href="#"
                                                                        class="block-link text-danger">Block</a>
                                                                    @endif


                                                                        @if (isset($is_trash))
                                                                        <a href="#"
                                                                        class="delete-link text-danger">Delete</a>

                                                                        <div class="bullet"></div>
                                                                        <a class="text-success"
                                                                        href="{{ route('admin.users.restore', [$type, $user->id]) }}">Restore</a>
                                                                        @endif
                                                                </div>
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->phone }}</td>
                                                    <td>
                                                        {{ $user->bio }}

                                                    </td>
                                                    <td>
                                                        {{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}

                                                    </td>
                                                    <td>{{ $user->created_at->format('M d, Y') }}</td>
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

            $(".block-link").click(function() {
                event.preventDefault();
                swal({
                        title: 'Are you sure?',
                        text: 'Are you sure you want to block this user?',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            const userId = $(this).closest('tr').data('myuser-id');
                            var url = '{{ route('admin.users.blockUser', [$type,'__id']) }}'.replace(
                                '__id', userId);
                            deleteData(userId, url);
                        } else {
                            swal('Operation canceled successfully.', {
                                icon: 'info',
                            });
                        }
                    });
            });

            $(".delete-link").click(function() {
                event.preventDefault();
                swal({
                        title: 'Are you sure?',
                        text: 'Are you sure you want to delete this user? \n Once deleted, it cannot be recovered!',
                        icon: 'warning',
                        buttons: true,
                        dangerMode: true,
                    })
                    .then((willDelete) => {
                        if (willDelete) {
                            const userId = $(this).closest('tr').data('myuser-id');
                            var url = '{{ route('admin.users.forceDestroy', [$type,'__id']) }}'.replace(
                                '__id', userId);
                            deleteData(userId, url);
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
