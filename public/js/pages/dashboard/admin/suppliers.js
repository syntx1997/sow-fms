const addSupplierModal = $('#addSupplierModal');
const addSupplierForm = $('#addSupplierForm');
const addSupplierSubmitBtn = addSupplierForm.find('button[type="submit"]');

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
});
