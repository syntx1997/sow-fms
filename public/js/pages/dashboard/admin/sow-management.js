const addSowModal = $('#addSowModal');
const addSowForm = $('#addSowForm');
const addSowSubmitBtn = addSowForm.find('button[type="submit"]');

const editSowModal = $('#editSowModal');
const editSowForm = $('#editSowForm');
const editSowSubmitBtn = editSowForm.find('button[type="submit"]');

const sowTable = $('#sowTable');

$(function () {
    const sowDataTable = sowTable.DataTable({
        'ajax': '/func/sow/get-all',
        'columns': [
            {
                'data': 'sow_no',
            },
            {
                'data': 'breed',
            },
            {
                'data': 'date_born',
            },
            {
                'data': 'origin',
            },
            {
                'data': 'dam',
            },
            {
                'data': 'date_procured',
            },
            {
                'data': 'sire',
            },
            {
                'data': 'actions',
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

    addSowForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/sow/add',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (res) {
                hideModal(addSowModal);
                reloadDataTable(sowTable);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if(errJSON.errors) {
                    const errors = errJSON.errors;
                    $.each(errors, function (field, errMessage) {
                        const Validation = new CustomValidation();
                        const input = formInput(addSowForm, 'input', field);

                        Validation.validate(input, errMessage);
                    });
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(addSowSubmitBtn, 'Adding');
            },
            complete: function () {
                submitBtnAfterSend(addSowSubmitBtn, 'Add');
            }
        });
    });

    editSowForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/sow/edit',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'JSON',
            success: function (res) {
                hideModal(editSowModal);
                reloadDataTable(sowTable);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if(errJSON.errors) {
                    const errors = errJSON.errors;
                    $.each(errors, function (field, errMessage) {
                        const Validation = new CustomValidation();
                        const input = formInput(editSowForm, 'input', field);

                        Validation.validate(input, errMessage);
                    });
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(editSowSubmitBtn, 'Adding');
            },
            complete: function () {
                submitBtnAfterSend(editSowSubmitBtn, 'Add');
            }
        });
    });
});

$(document).on('click', '#sowEditBtn', function () {
    const data = $(this).data();

    showModal(editSowModal);

    editSowForm.find('input[name="id"]').val(data.data.id);
    editSowForm.find('input[name="sowNo"]').val(data.data.sow_no);
    editSowForm.find('input[name="breed"]').val(data.data.breed);
    editSowForm.find('input[name="dateBorn"]').val(data.data.date_born);
    editSowForm.find('input[name="origin"]').val(data.data.origin);
    editSowForm.find('input[name="dam"]').val(data.data.dam);
    editSowForm.find('input[name="dateProcured"]').val(data.data.date_procured);
    editSowForm.find('input[name="sire"]').val(data.data.sire);
});

$(document).on('click', '#sowDeleteBtn', function () {
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
                url: '/func/sow/delete',
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
                    reloadDataTable(sowTable);
                }
            });
        }
    })
});
