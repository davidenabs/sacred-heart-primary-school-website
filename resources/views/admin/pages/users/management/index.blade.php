@extends('admin.layouts.app')
@section('title', 'School management')

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
                                                class="badge badge-white">{{ $managements->count() }}</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('admin.managements.create') }}">Add a staff <span
                                                class="badge badge-primary"><i data-feather="plus"></i></span></a>
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
                                <h4>All Staffs</h4>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-striped" id="table-1">
                                      <thead>
                                        <tr>
                                            <th class="text-center">
                                                #
                                            </th>
                                            <th></th>
                                            <th>Name</th>
                                            <th>Role</th>
                                            <th>Breif Bio</th>
                                            <th>Created At</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        @foreach ($managements as $key => $staff)
                                        <tr>
                                          <td>
                                            {{ ++$key }}
                                          </td>
                                          <td>
                                            <img alt="image"
                                            src="{{ asset($staff->avatar) }}"
                                            class="rounded-circle" width="35" height="35" data-toggle="title"
                                            title="{{ $staff->name . ' avatar' }}">
                                          </td>
                                          <td>
                                            <a href="#" class="text-dark">
                                                <span class="d-inline-block ml-1">{{ $staff->name }}</span>
                                                <div class="table-links">
                                                    <a href="{{ route('admin.managements.show', $staff->id) }}">View</a>
                                                    <div class="bullet"></div>
                                                    <a href="{{ route('admin.managements.edit', $staff->id) }}">Edit</a>
                                                    <div class="bullet"></div>
                                                    <a href="#" class="text-danger">Trash</a>
                                                </div>
                                            </a>
                                          </td>
                                          <td> 
                                            <div class="badge badge-success badge-shadow">{{ $staff->role }}</div>
                                          </td>
                                          <td>
                                            {{ $staff->bio }}

                                          </td>
                                          <td>{{ $staff->created_at->format('M d, Y') }}</td>
                                          {{-- <td>
                                            <div class="badge badge-success badge-shadow">Completed</div>
                                          </td> --}}
                                          {{-- <td><a href="#" class="btn btn-primary">Detail</a></td> --}}
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
@endsection

{{-- <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenter_{{ $staff->id }}Title">Modal
                                                                            title</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"
                                                                            aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        {{ $staff->name }}
                                                                    </div>
                                                                    <div class="modal-footer bg-whitesmoke br">
                                                                        <button type="button" class="btn btn-primary">Save</button>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
{{--
                                                            <div class="modal fade" id="exampleModalCenter_{{ $staff->id }}" tabindex="-1"
                                                                role="dialog" aria-labelledby="exampleModalCenter_{{ $staff->id }}Title"
                                                                aria-hidden="true">

                                                            </div> --}}
