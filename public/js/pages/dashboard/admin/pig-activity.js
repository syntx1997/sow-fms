const assignStaffForm = $('#assignStaffForm');
const assignStaffSubmitBtn = assignStaffForm.find('button[type="submit"]');

const addMatingForm = $('#addMatingForm');
const addMatingSubmitBtn = addMatingForm.find('button[type="submit"]');
const addMatingModal = $('#addMatingModal');

const editMatingForm = $('#editMatingForm');
const editMatingSubmitBtn = editMatingForm.find('button[type="submit"]');
const editMatingModal = $('#editMatingModal');

const editFarrowingForm = $('#editFarrowingForm');
const editFarrowingSubmitBtn = editFarrowingForm.find('input[type="submit"]');
const editFarrowingModal = $('#editFarrowingModal');

$(function () {
    assignStaffForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/pig/assign-staff',
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
                hideModal(addMatingModal);
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

    editMatingForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/mating/edit',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (res) {
                hideModal(editMatingModal);
                successAndReloadAfterSeconds(2000, res.message);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if (errJSON.errors) {
                    const errors = errJSON.errors;
                    $.each(errors, function (field, errMessage) {
                        const Validation = new CustomValidation();
                        const input = formInput(editMatingForm, 'input', field);

                        Validation.validate(input, errMessage);
                    });
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(editMatingSubmitBtn, 'Editing');
            },
            complete: function () {
                submitBtnAfterSend(editMatingSubmitBtn, 'Edit');
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

    formInput(editMatingForm, 'input', 'date').val(data.date);
    formInput(editMatingForm, 'input', 'boar').val(data.boar);
    formInput(editMatingForm, 'input', 'id').val(data.id);

    showModal(editMatingModal);
});

$(document).on('click', '#deleteMatingBtn', function (e) {
    e.preventDefault();
    const data = $(this).data('data');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: '/func/mating/delete',
                type: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {id: data.id},
                dataType: 'JSON',
                success: function (res) {
                    successAndReloadAfterSeconds(2000, res.message);
                },
                error: function (err) {
                    const errJSON = err.responseJSON;
                    console.log(errJSON);
                }
            });
        }
    })
});

$(document).on('click', '#editFarrowingBtn', function () {
    const data = $(this).data();

    if (data.farrowing === null) {
        console.log(1);
    }

    showModal(editFarrowingModal);
});
