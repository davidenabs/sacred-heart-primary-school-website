@extends('admin.layouts.app')
@if (isset($category))
    @section('title', 'Edit Category')
@else
    @section('title', 'Create Categorys and events')
@endif

@section('content')
    <div class="main-content">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @if (isset($category))
                                    <h4>Edit Category</h4>
                                @else
                                    <h4>Create A Category</h4>
                                @endif
                            </div>
                            <div class="card-body">
                                @if (isset($category))
                                    @livewire('admin.blog-category', ['category' => $category])
                                @else
                                    @livewire('admin.blog-category')
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@section('scripts')
    <script src="{{ asset('backend/assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('backend/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
@endsection

