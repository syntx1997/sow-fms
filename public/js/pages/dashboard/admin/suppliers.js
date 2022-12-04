const addSupplierModal = $('#addSupplierModal');
const addSupplierForm = $('#addSupplierForm');
const addSupplierSubmitBtn = addSupplierForm.find('button[type="submit"]');

const editSupplierModal = $('#editSupplierModal');
const editSupplierForm = $('#editSupplierForm');
const editSupplierSubmitBtn = editSupplierForm.find('button[type="submit"]');

$(function () {
    addSupplierForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/supplier/add',
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
                        const formField = formInput(addSupplierForm, field === 'address' ? 'textarea' : 'input', field);
                        Validation.validate(formField, errMsg);
                    });
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(addSupplierSubmitBtn, 'Adding');
            },
            complete: function () {
                submitBtnAfterSend(addSupplierSubmitBtn, 'Add');
            }
        });
    });
    editSupplierForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/supplier/edit',
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
                        const formField = formInput(editSupplierForm, field === 'address' ? 'textarea' : 'input', field);
                        Validation.validate(formField, errMsg);
                    });
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(editSupplierSubmitBtn, 'Editing');
            },
            complete: function () {
                submitBtnAfterSend(editSupplierSubmitBtn, 'Edit');
            }
        });
    });
});

$(document).on('click', '#editSupplierBtn', function () {
    const data = $(this).data('data');

    formInput(editSupplierForm, 'input', 'name').val(data.name);
    formInput(editSupplierForm, 'input', 'latitude').val(data.latitude);
    formInput(editSupplierForm, 'input', 'longitude').val(data.longitude);
    formInput(editSupplierForm, 'input', 'longitude').val(data.longitude);
    formInput(editSupplierForm, 'textarea', 'address').val(data.address);
    formInput(editSupplierForm, 'input', 'contact').val(data.contact);
    formInput(editSupplierForm, 'input', 'id').val(data.id);

    showModal(editSupplierModal);
});

$(document).on('click', '#deleteSupplierBtn', function () {
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
                url: '/func/supplier/delete',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: 'POST',
                data: data,
                dataType: 'JSON',
                success: function (res) {
                    successAndReloadAfterSeconds(2000, res.message)
                }
            });
        }
    });
});
