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
                                                class="badge badge-white">{{ $roles->count() }}</span></a>
                                       
                                        </li>
                                        @can('role-create')
                                            <li class="nav-item">
                                                <a class="nav-link" href="{{ route('admin.roles.create') }}">Add a subscriber
                                                    <span class="badge badge-primary"><i data-feather="plus"></i></span></a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4>Role Management</h4>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped" id="table-1">
                                            <tr>
                                                <th>No</th>
                                                <th>Name</th>
                                                <th width="280px">Action</th>
                                            </tr>
                                            @foreach ($roles as $key => $role)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $role->name }}</td>
                                                    <td>
                                                        <a class="btn btn-info"
                                                            href="{{ route('admin.roles.show', $role->id) }}">Show</a>
                                                        @can('role-edit')
                                                            <a class="btn btn-primary"
                                                                href="{{ route('admin.roles.edit', $role->id) }}">Edit</a>
                                                        @endcan
                                                        @can('role-delete')
                                                            {{-- {!! Form::open(['method' => 'DELETE','route' => ['admin.roles.destroy', $role->id],'style'=>'display:inline']) !!}
                                                       {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                                                   {!! Form::close() !!} --}}
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>


        {{-- @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif --}}



        {!! $roles->render() !!}


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
