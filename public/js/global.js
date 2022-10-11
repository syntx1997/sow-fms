const spinner = `<span class="spinner-border spinner-border-sm mr-2" role="status"></span>`;

const removeInputValidationErrors = () => {
    $('.form-control').removeClass('is-invalid');
    $('.form-select').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    $('.alert').remove();
    $('#notification').html('');
    $('#captcha_error').html('');
};

$(document).on('click', '#logout-btn', function (){
    Swal.fire({
        title: 'Log Out?',
        text: "You can get back again next time.",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes'
    }).then((result) => {
        console.log(result);
        if (result.value) {
            $.ajax({
                url: '/func/auth/logout',
                type: 'GET',
                success: function (response){
                    Swal.fire({
                        title: 'Logged Out!',
                        text: response.message,
                        type: 'success'
                    })
                    setInterval(function (){
                        location.reload();
                    }, 2000);
                }
            })
        }
    })
});

const submitBtnBeforeSend = (button, text) => {
    button.attr('disabled', 'disabled');
    button.html(spinner + ' ' + text);
    removeInputValidationErrors();
};

const submitBtnAfterSend = (button, text) => {
    button.attr('disabled', false);
    button.html(text);
};

const formInput = (form, type, name) => form.find(type + '[name="' + name + '"]');

function resetForm(form) {
    form[0].reset();
}

function hideModal(modal) {
    modal.modal('hide');
}

function showModal(modal) {
    modal.modal('show');
}

function reloadDataTable(table) {
    table.DataTable().ajax.reload(null);
}

function alertMessage(message, type) {
    return `
        <div class="alert alert-${type} alert-dismissible fade show" role="alert">
            ${message}
        </div>
    `;
}

function inputFeedback(message, type) {
    return `
        <div class="${type}-feedback d-block ">
            ${message}
        </div>
    `;
}

function fieldValidation(fieldElement, message) {
    if(message) {
        fieldElement.addClass('is-invalid');
        fieldElement.after(inputFeedback(message, 'invalid'));
    } else {
        fieldElement.removeClass('is-invalid');
    }
}

const inputGroupfieldValidation = (fieldElement, group, message) => {
    if(message) {
        fieldElement.addClass('is-invalid');
        group.after(inputFeedback(message, 'invalid'));
    } else {
        fieldElement.removeClass('is-invalid');
    }
};

function password_show_hide() {
    const x = document.getElementById('password');
    const show_eye = document.getElementById('show_eye');
    const hide_eye = document.getElementById('hide_eye');
    hide_eye.classList.remove('d-none');

    if(x.type === 'password') {
        x.type = 'text';
        show_eye.style.display = 'none';
        hide_eye.style.display = 'block';
    } else {
        x.type = 'password';
        show_eye.style.display = 'block';
        hide_eye.style.display = 'none';
    }
}

class CustomValidation {
    inputFeedback(message, type) {
        return `
            <div class="${type}-feedback d-block text-danger">
                ${message}
            </div>
        `;
    }

    // For Normal Input
    validate(field, message) {
        if(message) {
            field.addClass('is-invalid');
            field.after(this.inputFeedback(message, 'invalid', 'danger'));
        } else {
            field.removeClass('is-invalid');
        }
    }

    // For Input Groups
    validateGroup(message, field, group) {
        if(message) {
            field.addClass('is-invalid');
            group.after(this.inputFeedback(message, 'invalid'));
        } else {
            field.removeClass('is-invalid');
        }
    }
}

function generateToken() {
    const api = base_url + '/func/register/';
    const form = $('#register-form');
    const username = formInput(form, 'input', 'username').val();
    const email = formInput(form, 'input', 'email').val();
    const birthday = formInput(form, 'input', 'birthday').val();

    $.ajax({
        url: api + 'generate-token',
        headers: {'X-Requested-With': 'XMLHttpRequest'},
        type: 'POST',
        data: {
            username: username,
            email: email,
            birthday: birthday
        },
        dataType: 'JSON',
        success: function (res) {
            formInput(form, 'input', 'sso_token').val(res.token);
        }
    });
}

$(function () {
    const registerForm = $('#register-form');
    const registerEmailField = registerForm.find('input[name="email"]');
    const registerUsernameField = registerForm.find('input[name="username"]');
    const registerBirthdayField = registerForm.find('input[name="birthday"]');

    let timer = null;
    registerUsernameField.on('keyup', function () {
        clearTimeout(timer);
        timer = setTimeout(() => {
            generateToken();
        }, 1000);
    });

    registerEmailField.on('keyup', function () {
        clearTimeout(timer);
        timer = setTimeout(() => {
            generateToken();
        }, 1000);
    });

    registerBirthdayField.on('keyup', function () {
        clearTimeout(timer);
        timer = setTimeout(() => {
            generateToken();
        }, 1000);
    });
});
