const assignStaffForm = $('#assignStaffForm');
const assignStaffSubmitBtn = assignStaffForm.find('button[type="submit"]');

const addMatingForm = $('#addMatingForm');
const addMatingSubmitBtn = addMatingForm.find('button[type="submit"]');
const addMatingModal = $('#addMatingModal');

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

    addMatingForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/mating/add',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (res) {
                successAndReloadAfterSeconds(2000, res.message);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if(errJSON.errors) {
                    const errMessages = errJSON.errors;
                    $.each(errMessages, function (field, error) {
                        const Validation = new CustomValidation();
                        const input = formInput(addMatingForm, 'input', field);

                        Validation.validate(input, error);
                    });
                }

                if(errJSON.message) {
                    Swal.fire('Error', errJSON.message, 'error');
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(addMatingSubmitBtn, 'Adding');
            },
            complete: function () {
                submitBtnAfterSend(addMatingSubmitBtn, 'Add');
            }
        });
    });
});

$(document).on('click', '#addNewSetBtn', function () {
    submitBtnBeforeSend($(this), 'Adding');
    $.ajax({
        url: '/func/litter/add',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        data: {
            sow_id: sow_id
        },
        dataType: 'JSON',
        success: function (res) {
            submitBtnAfterSend($(this), '<i class="fa fa-plus"></i> Add New Set');
            setTimeout(function () {
                location.reload();
            }, 2000);
        },
        error: function (err) {
            const errJSON = err.responseJSON;
            console.log(errJSON);
        }
    });
});

$(document).on('click', '#addMatingBtn', function () {
    const data = $(this).data();
    showModal($('#addMatingModal'));
    $('#addMatingForm').find('input[name="litter_no"]').val(data.litter_no);
});

$(document).on('click', '#editMatingBtn', function (e) {
    e.preventDefault();
    const data = $(this).data('data');
    console.log(data);
});

$(document).on('click', '#deleteMatingBtn', function (e) {
    e.preventDefault();
    const data = $(this).data('data');
    console.log(data);
});
