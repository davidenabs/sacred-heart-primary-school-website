@extends('admin.layouts.app')
@if (isset($post))
    @section('title', 'Edit Post')
@else
    @section('title', 'Create Posts and events')
@endif

@section('content')
    <div class="main-content main-wrapper-1">
        <section class="section">
            <div class="section-body">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                @if (isset($post))
                                    <h4>Edit Post</h4>
                                @else
                                    <h4>Write Your Post</h4>
                                @endif
                            </div>
                            <div class="card-body">
                                @if (isset($post))
                                    @livewire('admin.blog-post', ['page'=>request()->fullUrl(), 'post' => $post])
                                @else
                                    @livewire('admin.blog-post', ['page'=>request()->fullUrl()])
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
<script src="{{ asset('backend/assets/js/page/create-post.js') }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
    <style>
      /* The switch - the box around the slider */
      .switch {
          position: relative;
          display: inline-block;
          width: 40px;
          height: 20px;
      }

      /* Hide default HTML checkbox */
      .switch input {
          opacity: 0;
          width: 0;
          height: 0;
      }

      /* The slider */
      .slider {
          position: absolute;
          cursor: pointer;
          top: 0;
          left: 0;
          right: 0;
          bottom: 0;
          background-color: #ccc;
          -webkit-transition: .4s;
          transition: .4s;
      }

      .slider:before {
          position: absolute;
          content: "";
          height: 12px;
          width: 12px;
          left: 4px;
          bottom: 4px;
          background-color: white;
          -webkit-transition: .4s;
          transition: .4s;
      }

      input:checked+.slider {
          background-color: #2196F3;
      }

      input:focus+.slider {
          box-shadow: 0 0 1px #2196F3;
      }

      input:checked+.slider:before {
          -webkit-transform: translateX(20px);
          -ms-transform: translateX(20px);
          transform: translateX(20px);
      }

      /* Rounded sliders */
      .slider.round {
          border-radius: 34px;
      }

      .slider.round:before {
          border-radius: 50%;
      }
  </style>
@endsection

