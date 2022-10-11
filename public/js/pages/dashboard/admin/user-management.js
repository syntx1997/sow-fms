const staffTable = $('#staffTable');

$(function (){
    const staffDataTable = staffTable.DataTable({
        'ajax': '/func/user/get/staff/all',
        'columns': [
            {
                'data': 'id'
            },
            {
                'data': 'staff'
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
        //info: false,
        lengthChange:false ,
        language: {
            paginate: {
                next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
                previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>'
            }
        }
    });
});
