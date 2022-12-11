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
                'className':        'details-control',
                'orderable':        false,
                'data':             '',
                'defaultContent':   '',
            },
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
                'data': 'assigned'
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

    $('#staffTable tbody').on('click', 'td.details-control', function() {
        const tr  = $(this).closest('tr');
        const row = staffDataTable.row( tr );

        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child( more_details( row.data() ) ).show();
            tr.addClass('shown');
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

function more_details(data) {
    const pigs = data.pigs;
    let pigRow = '';

    pigs.map(pig => {
        pigRow += `
            <tr>
                <td><img src="/storage/${pig.photo}" style="width: 100px"></td>
                <td>${pig.type}</td>
                <td>${pig.pig_no}</td>
            </tr>
        `;
    });

    if (pigs.length == 0) {
        pigRow += `
            <tr>
                <td colspan="3" class="text-center">no pigs assigned yet</td>
            </tr>
        `;
    }


    return `
        <p><strong>Pigs Assigned</strong></p>
        <table class="table">
            <thead>
                <tr>
                    <th></th>
                    <th>Type</th>
                    <th>Pig No.</th>
                </tr>
            </thead>
            <tbody>${pigRow}</tbody>
        </table>
    `;
}
