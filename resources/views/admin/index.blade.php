@extends('admin.layouts.app')
@section('title', 'Dashboard')

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="row ">
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Users</h5>
                                            <h2 class="mb-3 font-18">
                                                {{ App\Http\Controllers\Admin\MainController::formatNumber($users->count()) }}
                                            </h2>
                                            <p class="mb-0"><span class="col-green">- -</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="assets/img/banner/1.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15"> Subscribers</h5>
                                            <h2 class="mb-3 font-18">
                                                {{ App\Http\Controllers\Admin\MainController::formatNumber($subscribers->count()) }}
                                            </h2>
                                            <p class="mb-0"><span class="col-orange">- -</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="assets/img/banner/2.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Posts</h5>
                                            <h2 class="mb-3 font-18">
                                                {{ App\Http\Controllers\Admin\MainController::formatNumber($posts->count()) }}
                                            </h2>
                                            <p class="mb-0">- -</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="assets/img/banner/3.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Gallery</h5>
                                            <h2 class="mb-3 font-18">
                                                {{ App\Http\Controllers\Admin\MainController::formatNumber($gallery->count()) }}
                                            </h2>
                                            <p class="mb-0"><span class="col-green">- -</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="assets/img/banner/4.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Management</h5>
                                            <h2 class="mb-3 font-18">
                                                {{ App\Http\Controllers\Admin\MainController::formatNumber($management->count()) }}
                                            </h2>
                                            <p class="mb-0"><span class="col-green">- -</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="assets/img/banner/4.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Author</h5>
                                            <h2 class="mb-3 font-18">
                                                {{ App\Http\Controllers\Admin\MainController::formatNumber($users->where('role', '==', 'WRT')->count()) }}
                                            </h2>
                                            <p class="mb-0"><span class="col-green">- -</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="assets/img/banner/4.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <div class="card">
                        <div class="card-statistic-4">
                            <div class="align-items-center justify-content-between">
                                <div class="row ">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                                        <div class="card-content">
                                            <h5 class="font-15">Admin</h5>
                                            <h2 class="mb-3 font-18">
                                                {{ App\Http\Controllers\Admin\MainController::formatNumber($users->where('role', '==', 'ADM')->count()) }}
                                            </h2>
                                            <p class="mb-0"><span class="col-green">- -</p>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                                        <div class="banner-img">
                                            <img src="assets/img/banner/4.png" alt="">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-12">
                    <div class="car">
                        <div class="card-header">
                            <h4>Quick Link</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">

                              <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title m-0 text-center">
                                            <i class="fas fa-user-secret d-block" style="font-size: 25px"></i>
                                            Admin Users
                                        </h5>
                                    </div>
                                    <div class="card-footer p-2 border-top">
                                        <div class="text-center">
                                            <a href="{{ route('admin.users.index', 'admin') }}"
                                                class="btn btn-primary btn-round btn-sm shadow-sm">
                                                <i class="
                                      fas fa-cog"></i> Manage
                                            </a>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title m-0 text-center">
                                            <i class="fas fa-users d-block" style="font-size: 25px"></i>
                                            Author Users
                                        </h5>
                                    </div>
                                    <div class="card-footer p-2 border-top">
                                        <div class="text-center">
                                            <a href="{{ route('admin.users.index', 'writer') }}"
                                                class="btn btn-primary btn-round btn-sm shadow-sm">
                                                <i class="
                                      fas fa-cog"></i> Manage
                                            </a>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title m-0 text-center">
                                            <i class="fas fa-user-tie d-block" style="font-size: 25px"></i>
                                            Staffs
                                        </h5>
                                    </div>
                                    <div class="card-footer p-2 border-top">
                                        <div class="text-center">
                                            <a href="{{ route('admin.managements.index') }}"
                                                class="btn btn-primary btn-round btn-sm shadow-sm">
                                                <i class="
                                      fas fa-cog"></i> Manage
                                            </a>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title m-0 text-center">
                                            <i class="
                                            fas fa-id-badge d-block" style="font-size: 25px"></i>
                                            Subscribers
                                        </h5>
                                    </div>
                                    <div class="card-footer p-2 border-top">
                                        <div class="text-center">
                                            <a href="{{ route('admin.subscribes.index') }}"
                                                class="btn btn-primary btn-round btn-sm shadow-sm">
                                                <i class="
                                      fas fa-cog"></i> Manage
                                            </a>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title m-0 text-center">
                                            <i class="fas fa-envelope d-block" style="font-size: 25px"></i>
                                            Send Mail
                                        </h5>
                                    </div>
                                    <div class="card-footer p-2 border-top">
                                        <div class="text-center">
                                            <a href="{{ route('admin.mail.send') }}"
                                                class="btn btn-primary btn-round btn-sm shadow-sm">
                                                <i class="
                                      fas fa-cog"></i> Manage
                                            </a>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title m-0 text-center">
                                            <i class="fas fa-pencil-alt d-block" style="font-size: 25px"></i>
                                           Posts
                                        </h5>
                                    </div>
                                    <div class="card-footer p-2 border-top">
                                        <div class="text-center">
                                            <a href="{{ route('admin.posts.index') }}"
                                                class="btn btn-primary btn-round btn-sm shadow-sm">
                                                <i class="
                                      fas fa-cog"></i> Manage
                                            </a>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title m-0 text-center">
                                            <i class="fas fa-folder d-block" style="font-size: 25px"></i>
                                           Categories
                                        </h5>
                                    </div>
                                    <div class="card-footer p-2 border-top">
                                        <div class="text-center">
                                            <a href="{{ route('admin.categories.index') }}"
                                                class="btn btn-primary btn-round btn-sm shadow-sm">
                                                <i class="
                                      fas fa-cog"></i> Manage
                                            </a>
                                        </div>
                                    </div>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="card-title m-0 text-center">
                                            <i class="fas fa-images d-block" style="font-size: 25px"></i>
                                            Gallery
                                        </h5>
                                    </div>
                                    <div class="card-footer p-2 border-top">
                                        <div class="text-center">
                                            <a href="{{ route('admin.galleries.create') }}"
                                                class="btn btn-primary btn-round btn-sm shadow-sm">
                                                <i class="
                                      fas fa-cog"></i> Manage
                                            </a>
                                        </div>
                                    </div>
                                </div>
                              </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-lg-12">
                    <div class="card ">
                        <div class="card-header">
                            <h4>Recent Posts</h4>
                            <div class="card-header-action">
                                {{-- <div class="dropdown">
                                    <a href="#" data-toggle="dropdown"
                                        class="btn btn-warning dropdown-toggle">Options</a>
                                    <div class="dropdown-menu">
                                        <a href="#" class="dropdown-item has-icon"><i class="fas fa-eye"></i>
                                            View</a>
                                        <a href="#" class="dropdown-item has-icon"><i class="far fa-edit"></i>
                                            Edit</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item has-icon text-danger"><i
                                                class="far fa-trash-alt"></i>
                                            Delete</a>
                                    </div>
                                </div> --}}
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">View All</a>
                            </div>
                        </div>
                        <div class="card-body">
                          <div class="table-responsive">
                            @if ($posts->count() > 0)
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Author</th>
                                            <th>Title</th>
                                            <th>Views</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($posts->take(10) as $key => $post)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>
                                                    <a href="{{ route('admin.posts.user.show', $post->author->id) }}">
                                                        {{ $post->author->name }}
                                                    </a>
                                                </td>
                                                <td>
                                                  <a href="{{ route('admin.posts.show', $post->slug) }}">
                                                      {{ $post->title }}
                                                  </a>
                                              </td>
                                                <td>@php
                                                    echo App\Http\Controllers\Admin\BlogController::formatNumber($post->views);
                                                @endphp</td>
                                                <td>
                                                    @if (!$post->is_published && $post->is_draft)
                                                        <div class="badge badge-info">Draft</div>
                                                    @elseif($post->is_published)
                                                        <div class="badge badge-success">Published</div>
                                                    @else
                                                        <div class="badge badge-warning">Pending</div>
                                                    @endif
                                                </td>
                                                <td>{{ $post->created_at->format('M d, Y') }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            @else
                                <p class="text-muted text-center">
                                    You haven't created any post yet!
                                </p>
                            @endif
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

@endsection
