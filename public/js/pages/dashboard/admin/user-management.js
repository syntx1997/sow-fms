const staffTable = $('#staffTable');

const addStaffForm = $('#addStaffForm');
const addStaffSubmitBtn = addStaffForm.find('button[type="submit"]');
const addStaffModal = $('#addStaffModal');

const editStaffForm = $('#editStaffForm');
const editStaffSubmitBtn = editStaffForm.find('button[type="submit"]');
const editStaffModal = $('#editStaffModal');

$(function (){
    const staffDataTable = staffTable.DataTable({
        'ajax': '/func/user/get/staff/all',
        'columns': [
            {
                'data': 'number'
            },
            {
                'data': 'staff'
            },
            {
                'data': 'phone'
            },
            {
                'className': 'text-primary',
                'data': 'date'
            },
            {
                'data': 'action'
            }
        ],
        searching: false,
        paging:true,
        select: false,
        lengthChange:false ,
        language: {
            paginate: {
                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
            }
        }
    });

    addStaffForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/user/add/staff',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (res) {
                resetForm(addStaffForm);
                reloadDataTable(staffTable);
                hideModal(addStaffModal);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if (errJSON.errors) {
                    const errors = errJSON.errors;
                    $.each(errors, function (field, errMessage) {
                        const Validation = new CustomValidation();
                        const input = formInput(addStaffForm, 'input', field);

                        Validation.validate(input, errMessage);
                    });
                }

                if (errJSON.message) {
                    addStaffForm.find('.modal-body')
                        .prepend(alertMessage(errJSON.message, 'danger'));
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(addStaffSubmitBtn, 'Adding');
            },
            complete: function () {
                submitBtnAfterSend(addStaffSubmitBtn, 'Add');
            }
        });
    });

    editStaffForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/user/update/staff',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (res) {
                resetForm(editStaffForm);
                reloadDataTable(staffTable);
                hideModal(editStaffModal);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if (errJSON.errors) {
                    const errors = errJSON.errors;
                    $.each(errors, function (field, errMessage) {
                        const Validation = new CustomValidation();
                        const input = formInput(editStaffForm, 'input', field);

                        Validation.validate(input, errMessage);
                    });
                }

                if (errJSON.message) {
                    editStaffForm.find('.modal-body')
                        .prepend(alertMessage(errJSON.message, 'danger'));
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(editStaffSubmitBtn, 'Editing');
            },
            complete: function () {
                submitBtnAfterSend(editStaffSubmitBtn, 'Edit');
            }
        });
    });
});

$(document).on('click', '#staffEditBtn', function () {
    const data = $(this).data();

    showModal(editStaffModal);

    editStaffForm.find('input[name="name"]').val(data.data.name);
    editStaffForm.find('input[name="email"]').val(data.data.email);
    editStaffForm.find('input[name="phone"]').val(data.data.phone);
    editStaffForm.find('input[name="id"]').val(data.data.id);
});

$(document).on('click', '#staffDeleteBtn', function () {
    const data = $(this).data();

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
                url: '/func/user/delete/staff',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',
                data: {
                    id: data.data.id
                },
                dataType: 'JSON',
                success: function (res) {
                    Swal.fire(
                        'Deleted!',
                        res.message,
                        'success'
                    )
                    reloadDataTable(staffTable);
                }
            });
        }
    })
});
