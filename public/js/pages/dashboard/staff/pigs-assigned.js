const pigTable = $('#pigTable');

$(document).ready(function () {
    const pigDataTable = pigTable.DataTable({
        'ajax': '/func/pig/staff-assigned/get-all/'+staffId,
        'columns': [
            {
                'className':        'details-control',
                'orderable':        false,
                'data':             '',
                'defaultContent':   '',
            },
            {
                'classname': 'text-center',
                'data': 'viewActivity',
            },
            {
                'data': 'type',
            },
            {
                'data': 'pig_no',
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

    $('#pigTable tbody').on('click', 'td.details-control', function() {
        const tr  = $(this).closest('tr');
        const row = pigDataTable.row( tr );

        if ( row.child.isShown() ) {
            row.child.hide();
            tr.removeClass('shown');
        } else {
            row.child( more_details( row.data() ) ).show();
            tr.addClass('shown');
        }
    });
});

function more_details(data) {
    return `
        <div class="card">
            <div class="card-body">
                <table style="width: 100%">
                    <tbody>
                        <tr>
                            <td><strong>Breed</strong></td>
                            <td>${data.breed}</td>
                        </tr>
                        <tr>
                            <td><strong>Date Born</strong></td>
                            <td>${data.date_born}</td>
                        </tr>
                        <tr>
                            <td><strong>Origin</strong></td>
                            <td>${data.origin}</td>
                        </tr>
                        <tr>
                            <td><strong>DAM</strong></td>
                            <td>${data.dam}</td>
                        </tr>
                        <tr>
                            <td><strong>Date Procured</strong></td>
                            <td>${data.date_procured}</td>
                        </tr>
                        <tr>
                            <td><strong>Sire</strong></td>
                            <td>${data.sire}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-center">${data.actions}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    `;
}
