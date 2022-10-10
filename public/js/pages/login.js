const loginForm = $('#login-form');
const loginSubmitBtn = loginForm.find('button[type="submit"]');

$(function (){
    loginForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/auth/login',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (res) {

            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if (errJSON.errors) {
                    const errors = errJSON.errors;
                    $.each(errors, function (field, errMessage) {
                        const Validation = new CustomValidation();
                        const input = formInput(loginForm, 'input', field);

                        Validation.validate(input, errMessage);
                    });
                }

                if (errJSON.message) {
                    $(alertMessage(errJSON.message, 'danger')).insertBefore(loginForm);
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(loginSubmitBtn, 'Signing In')
            },
            complete: function () {
                submitBtnAfterSend(loginSubmitBtn, 'Sign Me In')
            }
        });
    });
});
