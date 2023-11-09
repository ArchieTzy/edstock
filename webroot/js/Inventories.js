function resetInventoryForm() {
        $('#title').html('Add Item');
    $('#inventories-form')[0].reset(); // Reset the form fields
    $('#id').val(''); // Clear the ID field
    $('#inventories-modal').modal('show');
    calculateTotalCost();
}
$(function () {
    getInventories();
    $('#add').on('click',function (e) {
        e.preventDefault();
        resetInventoryForm();
    });

    $('#inventories-table').on('click','.edit',function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        $('#title').html('Update Item');
        $.ajax({
            url: 'Inventories/edit/' + id,
            type: "GET",
            dataType: 'json'
        })
        .done(function(data, textStatus, jqXHR){
            if(data!=''){
        $('#item_id').val(data.item_id); // Update to set item_id
        $('#unit').val(data.unit);
        $('#qty').val(data.qty);
        $('#unit_cost').val(data.unit_cost);
        $('#total_cost').val(data.total_cost);
        $('#id').val(data.id);
        $('#inventories-modal').modal('show');
        calculateTotalCost(); // Ensure #inventories-modal exists
    }
})
        .fail(function(jqXHR, textStatus, errorThrown){
            msgBox('error',errorThrown);
        });
    });

    $('#inventories-form').on('submit',function (e) {
        e.preventDefault();
        var fd = new FormData(this);
        var id = $('#id').val();
        var url;
        if(id!=''){
            url = 'Inventories/edit/' + id;
        }else{
            url = 'Inventories/add';
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
                getInventories();
                msgBox('success',data.message);
                $('#inventories-modal').modal('hide');
                resetInventoryForm();
                calculateTotalCost();
            }else{
                msgBox('error',data.message);
            }
        })
        .fail(function(jqXHR, textStatus, errorThrown){
            msgBox('error',errorThrown);
        });
    });
});

var selectedInventoryData; // Store the data of the selected item for delete
var isDeleteConfirmationDisplayed = false; // Flag to track delete confirmation display

function getInventories() {
    var table = $("#inventories-table").dataTable({
        "responsive": true,
        "autoWidth": false,
        "destroy": true,
        "order": [[0, "asc"]],
        "ajax": {
            "url": 'Inventories/getInventories'
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
            { data: "item.description" },
            { data: "unit" },
            { data: "qty",},
            { data: "unit_cost",},
            {
                data: "total_cost",
                render: function (data, type, row) {
                    // Format total_cost as a number with 2 decimal places
                    if (type === 'display') {
                        return parseFloat(data).toFixed(2);
                    }
                    return data;
                }
            },
            {
                data: null,
                render: function (data, type, row) {
                    var option = '<div style="text-align:center;">' +
                    '<a href="#" class="delete" data-toggle="tooltip" ' +
                    'data-placement="bottom" title="Delete Item" data-id="' + data.id + '"><i ' +
                    'class="fa fa fa-trash"></i></a></div>';
                    return option;
                }
            },
            ]
    });

    $('#inventories-table tbody').on('click', 'tr', function (e) {
        if (!table.api().rows().any()) {
        return; // Exit if the table is empty
    }
    if ($(e.target).is('.edit')) {
        return;
    }
    var data = table.api().row(this).data();
    if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
        resetInventoryForm();
        $('#title').html('Item Details');
        $('#item_id').val(data.item_id);
        $('#unit').val(data.unit);
        $('#qty').val(data.qty);
        $('#unit_cost').val(data.unit_cost);
        $('#total_cost').val(data.total_cost);
        $('#id').val(data.id);
        $('#inventories-modal').modal('show');
    }
});

    $('#inventories-table tbody').on('click', '.delete', function (e) {
        if (!table.api().rows().any()) {
        return; // Exit if the table is empty
    }
    e.preventDefault();
    if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
        var data = table.api().row($(this).closest('tr')).data();
        selectedInventoryData = data;
        isDeleteConfirmationDisplayed = true; // Set delete confirmation flag to true
        $('#delete-modal').modal('show');
    }
});

    $('#inventories-table').on('click', '.delete', function (e) {
        e.preventDefault();
        var id=$(this).data('id');
        isDelete(function (confirmed) {
            if (confirmed) {
                $.ajax({
                    url: 'Inventories/delete/'+ id,
                    type: "DELETE",
                    dataType: 'json',
                    headers : {
                        'X-CSRF-Token': $('[name="_csrfToken"]').val()
                    },
                })
                .done(function(data, textStatus, jqXHR){
                    if(data.result=='success'){
                        getInventories();
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

var $qty = $('#qty');
var $unit_cost = $('#unit_cost');
var $total_cost = $('#total_cost');

// Attach an input event listener to both fields
$qty.on('input', calculateTotalCost);
$unit_cost.on('input', calculateTotalCost); // Corrected the closing parenthesis

// Function to calculate the total cost
function calculateTotalCost() {
    // Get the values from the input fields
    var quantity = parseFloat($qty.val()) || 0;
    var unitCost = parseFloat($unit_cost.val()) || 0;

    // Calculate the total cost
    var totalCost = quantity * unitCost;

    // Update the "Total Cost" field with the calculated value
    $total_cost.val(totalCost.toFixed(2)); // Display with 2 decimal places
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