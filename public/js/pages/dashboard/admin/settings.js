const updateInfoForm = $('#updateInfoForm');
const updateInfoSubmitBtn = updateInfoForm.find('button[type="submit"]');

const updatePasswordForm = $('#updatePasswordForm');
const updatePasswordSubmitBtn = updatePasswordForm.find('button[type="submit"]');

$(function () {

    updateInfoForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/settings/update-information',
            type: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function (res) {
                successAndReloadAfterSeconds(2000, res.message);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if (errJSON.errors) {
                    const errors = errJSON.errors;
                    const Validation = new CustomValidation();
                    $.each(errors, function (field, message) {
                        const input = formInput(updateInfoForm, 'input', field);
                        Validation.validate(input, message);
                    });
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(updateInfoSubmitBtn, 'Updating');
            },
            complete: function () {
                submitBtnAfterSend(updateInfoSubmitBtn, 'Update');
            }
        });
    });

    updatePasswordForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/settings/update-password',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (res) {
                successAndReloadAfterSeconds(2000, res.message);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if (errJSON.errors) {
                    const errors = errJSON.errors;
                    const Validation = new CustomValidation();
                    $.each(errors, function (field, message) {
                        const input = formInput(updatePasswordForm, 'input', field);
                        Validation.validate(input, message);
                    });
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(updatePasswordSubmitBtn, 'Updating');
            },
            complete: function () {
                submitBtnAfterSend(updatePasswordSubmitBtn, 'Update');
            }
        });
    });

});

$(document).on('click', '#choosePhotoBtn', function () {
    $('input[name="avatar"]').click();
});

$('input[name="avatar"]').on('change', function () {
    if (this.files && this.files[0]) {
        const reader = new FileReader();

        reader.onload = function (e) {
            updateInfoForm.find('#avatar img').attr('src', e.target.result);
        }

        reader.readAsDataURL(this.files[0]);
    }
});
