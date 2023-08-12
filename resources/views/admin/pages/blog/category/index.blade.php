@extends('admin.layouts.app')
@section('title', 'Category')



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
                                        <a class="nav-link active" href="{{ route('admin.categories.index') }}">All <span
                                                class="badge badge-white">{{ $categories->count() }}</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.categories.create') }}">Add a category <span
                                                class="badge badge-primary"><i data-feather="plus"></i></span></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- {{ $categorys }} --}}
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
                                                <th>Category Title</th>
                                                <th>Description</th>
                                                <th>Usage</th>
                                                <th>Created At</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $key => $category)
                                                <tr id="{{ $category->slug }}">
                                                    <td>
                                                        {{ ++$key }}
                                                    </td>
                                                    <td>
                                                        <a href="#">
                                                          {{ $category->title  }}
                                                          <div class="table-links">
                                                            {{-- <a href="{{ route('admin.categories.show', $category->slug) }}">View</a>
                                                            <div class="bullet"></div> --}}
                                                            <a href="{{ route('admin.categories.edit', $category->slug) }}">Edit</a>

                                                            <div class="bullet"></div>
                                                            <a href="javascript: void(0)" class="text-danger delete-link"
                                                            data-table-id="{{ $category->slug }}">Trash</a>
                                                        </div>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{ Str::limit(strip_tags($category->description), 100, '...') }}
                                                    </td>
                                                    <td>
                                                        {{ $category->posts->count() }}
                                                    </td>
                                                    <td>
                                                        {{ $category->created_at->format('M d, Y') }}
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
                            const id = $(this).data('table-id');
                            var url = '{{ route('admin.categories.destroy', '__id') }}'.replace(
                        '__id', id);
                            deleteData(id, url);
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
