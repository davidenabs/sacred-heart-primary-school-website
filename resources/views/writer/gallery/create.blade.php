@extends('writer.layouts.app')
@if (isset($gallery))
    @section('title', 'Edit Gallery')
@else
    @section('title', 'Create Photo Gallery')
@endif

@section('content')
    <div class="main-content main-wrapper-1">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @if (isset($gallery))
                                    <h4>Edit Photo Gallery</h4>
                                @else
                                    <h4>Add New Photo Gallery</h4>
                                @endif
                            </div>
                            <div class="card-body">
                                @if (isset($gallery))
                                    @livewire('admin.gallery-post', ['page'=>request()->fullUrl(), 'gallery' => $gallery])
                                @else
                                    @livewire('admin.gallery-post', ['page'=>request()->fullUrl()])
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

@endsection



