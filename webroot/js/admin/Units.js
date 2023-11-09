function resetUnitForm() {
    $('#title').html('Add Unit');
    $('#units-form')[0].reset(); // Reset the form fields
    $('#id').val(''); // Clear the ID field
    $('#units-modal').modal('show');
}

$(function () {
    getUnits();
    $('#add').on('click',function (e) {
        e.preventDefault();
        resetUnitForm();
    });

    $('#units-table').on('click','.edit',function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#title').html('Unit Details');
        $.ajax({
            url: 'Units/edit/' + id,
            type: "GET",
            dataType: 'json'
        })
        .done(function(data, textStatus, jqXHR){
            if(data!=''){
        $('#name').val(data.name);
        $('#id').val(data.id);
        $('#units-modal').modal('show');
    }
})
        .fail(function(jqXHR, textStatus, errorThrown){
            msgBox('error',errorThrown);
        });
    });

    $('#units-form').on('submit',function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        var id = $('#id').val();
        var url;
        if(id!=''){
            url = 'Units/edit/' + id;
        }else{
            url = 'Units/add';
        }
        $.ajax({
            processData: false,
            contentType:false,
            data: fd,
            url: url,
            type: "POST",
            dataType: 'json'
        })
        .done(function(data){
            if(data.result=='success'){
                getUnits();
                msgBox('success',data.message);
                $('#heads-modal').modal('hide');
                resetUnitForm();
            }else{
                msgBox('error',data.message);
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            msgBox('error',errorThrown);
        });
    });
});

var selectedUnitData;
var isDeleteConfirmationDisplayed = false;

function getUnits() {
    var table = $("#units-table").dataTable({
        "responsive": true,
        "autoWidth": false,
        "destroy": true,
        "order": [[0, "asc"]],
        "ajax": {
            "url": 'Units/getUnits'
        },
        "columns": [
            { data: "name" },
            {
                data: null,
                render: function (data, type, row) {
                    var option = '<div style="text-align:center;">' +
                    '<a href="#" class="delete" data-toggle="tooltip" ' +
                    'data-placement="bottom" title="Delete Head" data-id="' + data.id + '"><i ' +
                    'class="fa fa fa-trash"></i></a></div>';
                    return option;
                }
            },
            ]
    });

    $('#units-table tbody').on('click', 'tr', function (e) {
        if (!table.api().rows().any()) {
        return; // Exit if the table is empty
    }
    if ($(e.target).is('.edit')) {
        return;
    }
    var data = table.api().row(this).data();
    if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
        resetUnitForm();
        $('#title').html('Unit Details');
        $('#name').val(data.name);
        $('#id').val(data.id);
        $('#units-modal').modal('show');
    }
});

    $('#units-table tbody').on('click', '.delete', function (e) {
        if (!table.api().rows().any()) {
        return; // Exit if the table is empty
    }
    e.preventDefault();
    if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
        var data = table.api().row($(this).closest('tr')).data();
        selectedUnitData = data;
        isDeleteConfirmationDisplayed = true; // Set delete confirmation flag to true
        $('#delete-modal').modal('show');
    }
});

    $('#units-table').on('click', '.delete', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        isDelete(function (confirmed) {
            if (confirmed) {
                $.ajax({
                    url: 'Units/delete/'+ id,
                    type: "DELETE",
                    dataType: 'json',
                    headers : {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                })
                .done(function(data, textStatus, jqXHR){
                    if(data.result=='success'){
                        getUnits();
                        msgBox('success',data.message);
                    }else{
                        msgBox('error',data.message);
                    }
                })
                .fail(function(jqXHR, textStatus, errorThrown){
                    msgBox('error',errorThrown);
                })
                .always(function() {
                    isDeleteConfirmationDisplayed = false; // Reset delete confirmation flag
                });
            } else {
                isDeleteConfirmationDisplayed = false; // Reset delete confirmation flag
            }
        });
    });
}