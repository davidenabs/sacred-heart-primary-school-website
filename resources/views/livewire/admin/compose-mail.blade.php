<div>
    <form class="composeForm" wire:submit.prevent="sendMail" method="POST">
        @csrf

        <div class="form-group">
            <div class="form-line">
                <select wire:model="to" id="sendTo" class="form-control @error('to') is-invalid @enderror" autocomplete="off">
                    <option value="">-- TO --</option>
                    <option value="all">All User</option>
                    <option value="admin">Admin</option>
                    <option value="writer">Content Writer</option>
                    <option value="manualMail">Input Email Manually</option>
                </select>
                @error('to')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group" id="manualMailInput" wire:ignore>
            <div class="form-line">
                <input type="text" class="form-control inputtags"
                    placeholder="Enter emails: for multiple emails, press enter to saperate them">
            </div>
        </div>

        <div class="form-group">
            <div class="form-line">
                <input type="text" wire:model="subject" class="form-control" placeholder="Subject">
                @error('subject')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div>

        <div class="form-group" wire:ignore>
            <div class="form-line">
                <textarea class="summernote-simple"></textarea>
            </div>
        </div>

        <div class="form-group">
            <input type="file" wire:model='file' class="default" multiple>
            @error('file')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        {{-- <div class="form-group">
            <div class="form-line">
                <input type="text" wire:model="actionButton" class="form-control"
                    placeholder="Action button: paste url here">
                @error('actionButton')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
            </div>
        </div> --}}

        <div class="form-group mt-3">
            <div class="form-line">
                <button type="submit" class="btn btn-info btn-border-radius waves-effect">Send</button>
                <button type="button" class="btn btn-danger btn-border-radius waves-effect">Discard</button>
            </div>
        </div>

    </form>
</div>


@section('scripts')
    {{-- <script src="{{ asset('backend/assets/bundles/alpinejs/alpinejs.js') }}"></script> --}}
    <script src="{{ asset('backend/assets/bundles/summernote/summernote-bs4.js') }}"></script>
    <script src="{{ asset('backend/assets/bundles/jquery-selectric/jquery.selectric.min.js') }}"></script>
    <script src="{{ asset('backend/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js') }}"></script>
    {{-- <script src="{{ asset('backend/assets/js/page/create-post.js') }}"></script> --}}
    <script>
        $('.summernote-simple').summernote({
            placeholder: 'Write your message...',
            height: 100,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear', 'strikethrough']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
            ],
            // // dialogsFade: true
            callbacks: {
                onChange: function(contents, $editable) {
                    @this.set('messageBody', contents);
                }
            }
        });

        $(document).ready(function() {

            $('#sendTo').change(function () {
                if ($(this).val() == 'manualMail') {
                    $('#manualMailInput').show()
                } else {
                    $('#manualMailInput').hide()
                    $('#manualMailInput').val = '';
                }
            });

            $('#manualMailInput').hide()

            $(".inputtags").tagsinput('items');

            $(".inputtags").on('itemAdded', function(event) {
               Livewire.emit('addItem', event.item);
            });

        });

        $('.selectric').on('selectric-change', function(event, element, selectric) {
            Livewire.emit('addTo', element.value);
        });
    </script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/jquery-selectric/selectric.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/summernote/summernote-bs4.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/bundles/bootstrap-tagsinput/dist/bootstrap-tagsinput.css') }}">
@endsection


{{-- create a textarea input that accepts only valid email address, it can accept multiple emails and distinguish them using a commas, when submited to livewire, the email should be in form of an array. Note, the emails could be paste or typed individually.
make use of jquery if needed --}}
