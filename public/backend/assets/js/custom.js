/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

// Listen for the 'showAlert' custom event emitted by the Livewire component
window.addEventListener('showAlert', (event) => {
    // console.log(message);
    switch (event.detail.type) {
        case 'success':
            iziToast.success({
                message: event.detail.message,
                position: 'topRight'
            });
            break;
        case 'info':
            iziToast.info({
                message: event.detail.message,
                position: 'topRight'
            });
            break;
        case 'warning':
            iziToast.warning({
                message: event.detail.message,
                position: 'topRight'
            });
            break;
        case 'error':
            iziToast.error({
                message: event.detail.message,
                position: 'topRight'
            });
            break;
        default:
            iziToast.info({
                message: event.detail.message,
                position: 'topRight'
            });
            break;
    }
});

function deleteData(id, url) {

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    jQuery.ajax({
        url: url,
        type: 'DELETE',
        dataType: 'JSON',
        contentType: false,
        cache: false,
        processData: false,
        success: function (data) {
            swal('Success', data, 'success');
            iziToast.success({
                message: data,
                position: 'topRight'
            });
            $('#' + id).remove();
        },
        error: function (xhr) {
            // Handle error if deletion fails
            swal('Error', xhr.responseJSON.message,
                'error');
        }
    });
}

