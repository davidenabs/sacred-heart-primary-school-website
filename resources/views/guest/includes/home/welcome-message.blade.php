<div id="popup-container">
    <div id="popup-message">
        <img src="{{ asset('shs/logo/sacred-heart-primary-school-kaduna.webp') }}" width="100" alt="Sacred Heart Primary School">
        <h2>Welcome to Sacred Heart <br> Primary School<br> Kaduna</h2>
        <p><i>...learning Never Ends</i></p>
    </div>
</div>

@section('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        // Get the timestamp from localStorage (if available)
        var lastPopupTime = localStorage.getItem('lastPopupTime');
        var now = new Date().getTime();

        // Check if more than 24 hours have passed since the last popup
        if (!lastPopupTime || (now - lastPopupTime > 24 * 60 * 60 * 1000)) {
            // Show the popup
            $('#popup-container').fadeIn();

            // Update the lastPopupTime in localStorage
            localStorage.setItem('lastPopupTime', now);
        }

        // Close the popup when clicking outside of it
        $(document).on('click', function(e) {
            // alert($(e.target).closest('#popup-container').length)
            if ($(e.target).closest('#popup-container').length === 1) {
                $('#popup-container').fadeOut();
            }
        });
    });
</script>

@endsection