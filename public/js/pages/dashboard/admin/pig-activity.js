const assignStaffForm = $('#assignStaffForm');
const assignStaffSubmitBtn = assignStaffForm.find('button[type="submit"]');

const addMatingForm = $('#addMatingForm');
const addMatingSubmitBtn = addMatingForm.find('button[type="submit"]');
const addMatingModal = $('#addMatingModal');

const editMatingForm = $('#editMatingForm');
const editMatingSubmitBtn = editMatingForm.find('button[type="submit"]');
const editMatingModal = $('#editMatingModal');

const editFarrowingForm = $('#editFarrowingForm');
const editFarrowingSubmitBtn = editFarrowingForm.find('button[type="submit"]');
const editFarrowingModal = $('#editFarrowingModal');

const editWeaningForm = $('#editWeaningFom');
const editWeaningSubmitBtn = editWeaningForm.find('button[type="submit"]');
const editWeaningModal = $('#editWeaningModal');

const editRemarksForm = $('#editRemarksForm');
const editRemarksSubmitBtn = editRemarksForm.find('button[type="submit"]');

const BGD1D30Form = $('#BGD1D30Form');
const BGD1D30SubmitBtn = BGD1D30Form.find('button[type="submit"]');
const BGD1D30Modal = $('#BGD1D30Modal');

const BGD31D70Form = $('#BGD31D70Form');
const BGD31D70SubmitBtn = BGD31D70Form.find('button[type="submit"]');
const BGD31D70Modal = $('#BGD31D70Modal');

const BGD71D100Form = $('#BGD71D100Form');
const BGD71D100SubmitBtn = BGD71D100Form.find('button[type="submit"]');
const BGD71D100Modal = $('#BGD71D100Modal');

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

    editFarrowingForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/farrowing/edit',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (res) {
                hideModal(editFarrowingModal);
                successAndReloadAfterSeconds(2000, res.message);
            },
            error: function (err) {
                errJSON = err.responseJSON;
                if (errJSON.errors) {
                    const errors = errJSON.errors;
                    const Validation = new CustomValidation();
                    $.each(errors, function (field, errMsg) {
                        const input = formInput(editFarrowingForm, 'input', field);
                        Validation.validate(input, errMsg);
                    });
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(editFarrowingSubmitBtn, 'Editing');
            },
            complete: function () {
                submitBtnAfterSend(editFarrowingSubmitBtn, 'Edit');
            }
        });
    });

    editWeaningForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/weaning/edit',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (res) {
                hideModal(editWeaningModal);
                successAndReloadAfterSeconds(2000, res.message);
            },
            error: function (err) {
                errJSON = err.responseJSON;
                if (errJSON.errors) {
                    const errors = errJSON.errors;
                    const Validation = new CustomValidation();
                    $.each(errors, function (field, errMsg) {
                        const input = formInput(editWeaningForm, 'input', field);
                        Validation.validate(input, errMsg);
                    });
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(editWeaningSubmitBtn, 'Editing');
            },
            complete: function () {
                submitBtnAfterSend(editWeaningSubmitBtn, 'Edit');
            }
        });
    });

    BGD1D30Form.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/breeding-to-gestation/edit/d1-d30',
            type: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                successAndReloadAfterSeconds(2000, res.message);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if ((errJSON.errors)) {
                    const errors = errJSON.errors;
                    const Validation = new CustomValidation();
                    $.each(errors, function (field, errMsg) {
                        const input = formInput(BGD1D30Form, field === 'day' ? 'select' : 'input', field);
                        Validation.validate(input, errMsg);
                    });
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(BGD1D30SubmitBtn, 'Editing');
            },
            complete: function () {
                submitBtnAfterSend(BGD1D30SubmitBtn, 'Edit');
            }
        });
    });

    BGD31D70Form.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/breeding-to-gestation/edit/d31-d70',
            type: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                successAndReloadAfterSeconds(2000, res.message);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if ((errJSON.errors)) {
                    const errors = errJSON.errors;
                    const Validation = new CustomValidation();
                    $.each(errors, function (field, errMsg) {
                        const input = formInput(BGD31D70Form, field === 'day' ? 'select' : 'input', field);
                        Validation.validate(input, errMsg);
                    });
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(BGD31D70SubmitBtn, 'Editing');
            },
            complete: function () {
                submitBtnAfterSend(BGD31D70SubmitBtn, 'Edit');
            }
        });
    });

    BGD71D100Form.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/breeding-to-gestation/edit/d71-d100',
            type: 'POST',
            data: $(this).serialize(),
            success: function (res) {
                successAndReloadAfterSeconds(2000, res.message);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if ((errJSON.errors)) {
                    const errors = errJSON.errors;
                    const Validation = new CustomValidation();
                    $.each(errors, function (field, errMsg) {
                        const input = formInput(BGD71D100Form, field === 'day' ? 'select' : 'input', field);
                        Validation.validate(input, errMsg);
                    });
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(BGD71D100SubmitBtn, 'Editing');
            },
            complete: function () {
                submitBtnAfterSend(BGD71D100SubmitBtn, 'Edit');
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
            pig_id: pig_id
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
    formInput(editMatingForm, 'select', 'boar').val(data.boar);
    formInput(editMatingForm, 'input', 'id').val(data.id);
    formInput(editMatingForm, 'input', 'litter_no').val(data.litter_no);

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

    if (data.farrowing !== null) {
        formInput(editFarrowingForm, 'input', 'actual_date').val(data.farrowing.actual_date);
        formInput(editFarrowingForm, 'input', 'status').val(data.farrowing.status);
        formInput(editFarrowingForm, 'input', 'weight').val(data.farrowing.weight);
        formInput(editFarrowingForm, 'input', 'alive').val(data.farrowing.alive);
        formInput(editFarrowingForm, 'input', 'dead').val(data.farrowing.dead);
        formInput(editFarrowingForm, 'select', 'sow').val(data.farrowing.sow);
    }

    editFarrowingForm.find('input[name="litter_no"]').val(data.litter_no);
    showModal(editFarrowingModal);
});

$(document).on('click', '#editWeaningBtn', function () {
    const data = $(this).data();

    if (data.weaning !== null) {
        formInput(editWeaningForm, 'input', 'date').val(data.weaning.date);
        formInput(editWeaningForm, 'input', 'number').val(data.weaning.number);
        formInput(editWeaningForm, 'input', 'weight').val(data.weaning.weight);
    }

    editWeaningForm.find('input[name="litter_no"]').val(data.litter_no);
    showModal(editWeaningModal);
});

$(document).on('submit', '#editRemarksForm', function (e) {
    e.preventDefault();
    const submitBtn = $(this).find('button[type="submit"]');
    const form = $(this);

    $.ajax({
        url: '/func/remarks/edit',
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
                $.each(errors, function (field, errMsg) {
                    const input = formInput(form, 'textarea', field);
                    Validation.validate(input, errMsg);
                });
            }
        },
        beforeSend: function () {
            submitBtnBeforeSend(submitBtn, 'Saving');
        },
        complete: function () {
            submitBtnAfterSend(submitBtn, 'Save');
        }
    });
});

$(document).on('click', '#GDD1D30Btn', function () {
    const data = $(this).data();

    if (data.bgd1d31 !== null) {
        formInput(BGD1D30Form, 'select', 'day').val(data.bgd1d31.day);
        formInput(BGD1D30Form, 'input', 'time').val(data.bgd1d31.time);
        formInput(BGD1D30Form, 'input', 'feed_amount').val(data.bgd1d31.feed_amount);
        formInput(BGD1D30Form, 'input', 'feed_type').val(data.bgd1d31.feed_type);
    }

    showModal(BGD1D30Modal);
});

$(document).on('click', '#GDD31D70Btn', function () {
    const data = $(this).data();

    if (data.bgd31d70 !== null) {
        formInput(BGD31D70Form, 'select', 'day').val(data.bgd31d70.day);
        formInput(BGD31D70Form, 'input', 'time').val(data.bgd31d70.time);
        formInput(BGD31D70Form, 'input', 'feed_amount').val(data.bgd31d70.feed_amount);
        formInput(BGD31D70Form, 'input', 'feed_type').val(data.bgd31d70.feed_type);
    }

    showModal(BGD31D70Modal);
});

$(document).on('click', '#GDD71D100Btn', function () {
    const data = $(this).data();

    if (data.bgd71d100 !== null) {
        formInput(BGD71D100Form, 'select', 'day').val(data.bgd71d100.day);
        formInput(BGD71D100Form, 'input', 'time').val(data.bgd71d100.time);
        formInput(BGD71D100Form, 'input', 'feed_amount').val(data.bgd71d100.feed_amount);
        formInput(BGD71D100Form, 'input', 'feed_type').val(data.bgd71d100.feed_type);
    }

    showModal(BGD71D100Modal);
});
