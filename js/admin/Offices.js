function resetOfficeForm() {
    $('#title').html('Add Office');
    $('#offices-form')[0].reset(); // Reset the form fields
    $('#id').val(''); // Clear the ID field
    $('#offices-modal').modal('show');
}
$(function () {
    getOffices();
    $('#add').on('click',function (e) {
        e.preventDefault();
        resetOfficeForm();
    });

    $('#offices-table').on('click','.edit',function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#title').html('Office Details');
        $.ajax({
            url: 'Offices/edit/' + id,
            type: "GET",
            dataType: 'json'
        })
        .done(function(data, textStatus, jqXHR){
            if(data!=''){
        $('#name').val(data.name);
        $('#id').val(data.id);
        $('#offices-modal').modal('show');
    }
})
        .fail(function(jqXHR, textStatus, errorThrown){
            msgBox('error',errorThrown);
        });
    });

    $('#offices-form').on('submit',function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        var id = $('#id').val();
        var url;
        if(id!=''){
            url = 'Offices/edit/' + id;
        }else{
            url = 'Offices/add';
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
                getOffices();
                msgBox('success',data.message);
                $('#offices-modal').modal('hide');
                resetOfficeForm();
            }else{
                msgBox('error',data.message);
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            msgBox('error',errorThrown);
        });
    });
});

var selectedOfficeData;
var isDeleteConfirmationDisplayed = false;

function getOffices() {
    var table = $("#offices-table").dataTable({
        "responsive": true,
        "autoWidth": false,
        "destroy": true,
        "order": [[0, "asc"]],
        "ajax": {
            "url": 'Offices/getOffices'
        },
        "columns": [
            { data: "name" },
            {
                data: null,
                render: function (data, type, row) {
                    var option = '<div style="text-align:center;">' +
                    '<a href="#" class="delete" data-toggle="tooltip" ' +
                    'data-placement="bottom" title="Delete Office" data-id="' + data.id + '"><i ' +
                    'class="fa fa fa-trash"></i></a></div>';
                    return option;
                }
            },
            ]
    });

    $('#offices-table tbody').on('click', 'tr', function (e) {
        if (!table.api().rows().any()) {
        return; // Exit if the table is empty
    }
    if ($(e.target).is('.edit')) {
        return;
    }
    var data = table.api().row(this).data();
    if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
        resetOfficeForm();
        $('#title').html('Office Details');
        $('#name').val(data.name);
        $('#id').val(data.id);
        $('#offices-modal').modal('show');
    }
});

    $('#offices-table tbody').on('click', '.delete', function (e) {
        if (!table.api().rows().any()) {
        return; // Exit if the table is empty
    }
    e.preventDefault();
    if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
        var data = table.api().row($(this).closest('tr')).data();
        selectedOfficeData = data;
        isDeleteConfirmationDisplayed = true; // Set delete confirmation flag to true
        $('#delete-modal').modal('show');
    }
});

    $('#offices-table').on('click', '.delete', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        isDelete(function (confirmed) {
            if (confirmed) {
                $.ajax({
                    url: 'Offices/delete/'+ id,
                    type: "DELETE",
                    dataType: 'json',
                    headers : {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                })
                .done(function(data, textStatus, jqXHR){
                    if(data.result=='success'){
                        getOffices();
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

function msgBox(result,message){
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });
    Toast.fire({
        icon: result,
        title: message
    });
}

function isDelete(callback){
    Swal.fire({
        title: 'Are you sure you want to delete this record?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((confirmed) => {
        callback(confirmed && confirmed.value == true);
    });
}