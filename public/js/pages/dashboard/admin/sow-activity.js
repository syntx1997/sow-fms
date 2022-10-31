const assignStaffForm = $('#assignStaffForm');
const assignStaffSubmitBtn = assignStaffForm.find('button[type="submit"]');

$(function () {
    assignStaffForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/sow/assign-staff',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (res) {
                Swal.fire('Success', res.message, 'success');
                setTimeout(function () {
                    location.reload();
                }, 2000);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                console.log(errJSON);
            },
            beforeSend: function () {
                submitBtnBeforeSend(assignStaffSubmitBtn, 'Assigning');
            },
            complete: function () {
                submitBtnAfterSend(assignStaffSubmitBtn, 'Assign');
            }
        });
    });
});
