const addPigModal = $('#addPigModal');
const addPigForm = $('#addPigForm');
const addPigSubmitBtn = addPigForm.find('button[type="submit"]');

const editPigModal = $('#editPigModal');
const editPigForm = $('#editPigForm');
const editPigSubmitBtn = editPigForm.find('button[type="submit"]');

const pigTable = $('#pigTable');

$(function () {
    const pigDataTable = pigTable.DataTable({
        'ajax': '/func/pig/get-all/'+type,
        'columns': [
            {
                'classname': 'text-center',
                'data': 'viewActivity',
            },
            {
                'data': 'pig_no',
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

    pigDataTable.on('draw.dt', function () {
        $('.viewPhotoLightGallery').lightGallery({
            loop:true,
            thumbnail:true,
            exThumbImage: 'data-exthumbimage',
            selector: '.LGImg'
        });
    });

    addPigForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/pig/add',
            type: 'POST',
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            processData: false,
            success: function (res) {
                resetForm(addPigForm);
                addPigForm.find('#photo img').attr('src', '/storage/pigs-photo/no-img.png');
                hideModal(addPigModal);
                reloadDataTable(pigTable);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if(errJSON.errors) {
                    const errors = errJSON.errors;
                    $.each(errors, function (field, errMessage) {
                        const Validation = new CustomValidation();
                        const input = formInput(addPigForm, 'input', field);

                        Validation.validate(input, errMessage);
                    });
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(addPigSubmitBtn, 'Adding');
            },
            complete: function () {
                submitBtnAfterSend(addPigSubmitBtn, 'Add');
            }
        });
    });

    editPigForm.on('submit', function (e) {
        e.preventDefault();
        $.ajax({
            url: '/func/pig/edit',
            type: 'POST',
            data: new FormData(this),
            contentType: false,
            processData: false,
            dataType: 'JSON',
            success: function (res) {
                hideModal(editPigModal);
                reloadDataTable(pigTable);
            },
            error: function (err) {
                const errJSON = err.responseJSON;
                if(errJSON.errors) {
                    const errors = errJSON.errors;
                    $.each(errors, function (field, errMessage) {
                        const Validation = new CustomValidation();
                        const input = formInput(editPigForm, 'input', field);

                        Validation.validate(input, errMessage);
                    });
                }
            },
            beforeSend: function () {
                submitBtnBeforeSend(editPigSubmitBtn, 'Editing');
            },
            complete: function () {
                submitBtnAfterSend(editPigSubmitBtn, 'Edit');
            }
        });
    });

    addPigForm.find('#uploadPhotoBtn').on('click', function () {
        addPigForm.find('input[name="photo"]').click();
    });

    addPigForm.find('input[name="photo"]').on('change', function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                addPigForm.find('#photo img').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });

    editPigForm.find('#uploadPhotoBtn').on('click', function () {
        editPigForm.find('input[name="photo"]').click();
    });

    editPigForm.find('input[name="photo"]').on('change', function () {
        if (this.files && this.files[0]) {
            const reader = new FileReader();
            reader.onload = function (e) {
                editPigForm.find('#photo img').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
});

$(document).on('click', '#pigEditBtn', function () {
    const data = $(this).data();

    showModal(editPigModal);

    editPigForm.find('input[name="id"]').val(data.data.id);
    editPigForm.find('input[name="pigNo"]').val(data.data.pig_no);
    editPigForm.find('input[name="breed"]').val(data.data.breed);
    editPigForm.find('input[name="dateBorn"]').val(data.data.date_born);
    editPigForm.find('input[name="origin"]').val(data.data.origin);
    editPigForm.find('input[name="dam"]').val(data.data.dam);
    editPigForm.find('input[name="dateProcured"]').val(data.data.date_procured);
    editPigForm.find('input[name="sire"]').val(data.data.sire);
    editPigForm.find('#photo img').attr('src', '/storage/'+data.data.photo);
});

$(document).on('click', '#pigDeleteBtn', function () {
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
                url: '/func/pig/delete',
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
                    reloadDataTable(pigTable);
                }
            });
        }
    })
});
