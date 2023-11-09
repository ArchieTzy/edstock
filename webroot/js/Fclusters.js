function resetFclusterForm() {
    $('#title').html('Add Cluster');
    $('#fclusters-form')[0].reset(); // Reset the form fields
    $('#id').val(''); // Clear the ID field
    $('#fclusters-modal').modal('show');
}
$(function () {
    getFclusters();
    $('#add').on('click',function (e) {
        e.preventDefault();
        resetFclusterForm();
    });

    $('#fclusters-table').on('click','.add',function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#title').html('Add Cluster');
        $.ajax({
            url: 'Fclusters/add/',
            type: "GET",
            dataType: 'json'
        })
        .done(function(data, textStatus, jqXHR){
            if(data!=''){
                $('#name').val(data.name);
                $('#id').val(data.id);
                $('#fclusters-modal').modal('show');
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            msgBox('error',errorThrown);
        });
    });

    $('#fclusters-form').on('submit',function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        var id = $('#id').val();
        var url;
        if(id!=''){
            url = 'Fclusters/edit/' + id;
        }else{
            url = 'Fclusters/add';
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
                getFclusters();
                msgBox('success',data.message);
                $('#fclusters-modal').modal('hide');
                resetFclusterForm();
            }else{
                msgBox('error',data.message);
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            msgBox('error',errorThrown);
        });
    });
});

var selectedFclusterData; // Store the data of the selected item for delete
var isDeleteConfirmationDisplayed = false; // Flag to track delete confirmation display

function getFclusters() {
    var table = $("#fclusters-table").dataTable({
        "responsive": true,
        "autoWidth": false,
        "destroy": true,
        "order": [[0, "asc"]],
        "ajax": {
            "url": 'Fclusters/getFclusters'
        },
        "columns": [
            {
                data: "created",
                render: function (data, type, row) {
                        // Format the date and time
                    var date = new Date(data);
                    var day = date.getDate().toString().padStart(2, '0');
                        var month = (date.getMonth() + 1).toString().padStart(2, '0'); // Month is zero-based
                        var year = date.getFullYear();
                        var hours = date.getHours() % 12 || 12; // Convert to 12hr format
                        var minutes = date.getMinutes().toString().padStart(2, '0');
                        var ampm = date.getHours() >= 12 ? 'PM' : 'AM';

                        var formattedDate = year + '-' + month + '-' + day + ' ' + hours + ':' + minutes + ' ' + ampm;
                        return formattedDate;
                    }
            },
            { data: "name" },
            {
                data: null,
                render: function (data, type, row) {
                    var option = '<div style="text-align:center;">' +
                    '<a href="#" class="delete" data-toggle="tooltip" ' +
                    'data-placement="bottom" title="Delete Category" data-id="' + data.id + '"><i ' +
                    'class="fa fa fa-trash"></i></a></div>';
                    return option;
                }
            },
            ]
    });

    $('#fclusters-table tbody').on('click', 'tr', function (e) {
        if (!table.api().rows().any()) {
        return; // Exit if the table is empty
    }
    if ($(e.target).is('.edit')) {
        return;
    }
    var data = table.api().row(this).data();
    if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
        resetFclusterForm();
        $('#title').html('Fund Cluster Details');
        $('#name').val(data.name);
        $('#id').val(data.id);
        $('#fclusters-modal').modal('show');
    }
});

    $('#fclusters-table tbody').on('click', '.delete', function (e) {
        if (!table.api().rows().any()) {
        return; // Exit if the table is empty
    }
    e.preventDefault();
    if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
        var data = table.api().row($(this).closest('tr')).data();
        selectedFclusterData = data;
        isDeleteConfirmationDisplayed = true; // Set delete confirmation flag to true
        $('#delete-modal').modal('show');
    }
});

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

};