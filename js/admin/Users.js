    function resetUserForm() {
        $('#users-modal').modal('show');
        $('#title').html('Add User');
        $('#users-form')[0].reset(); // Reset the form fields
        $('#id').val(''); // Clear the ID field
    }

    $(function () {
        getUsers();

        $('#add').on('click',function (e) {
            e.preventDefault();
            resetUserForm();
        });

        $('#users-table').on('click','.edit',function (e) {
            e.preventDefault();
            var id = $(this).data('id');
            $('#title').html('Update User');
            $.ajax({
                url: base_url + '/Users/edit/' + id,
                type: "GET",
                dataType: 'json'
            })
            .done(function(data, textStatus, jqXHR){
                if(data!=''){
                    $('#username').val(data.username);
                    $('#password').val(data.password);
                    $('#fullname').val(data.fullname);
                    $('#bdate').val(data.bdate);
                    $('#tin_no').val(data.tin_no);
                    $('#plantilla_no').val(data.plantilla_no);
                    $('#position').val(data.position);
                    $('#role').val(data.role);
                    $('#contact').val(data.contact);
                    $('#department_id').val(data.department_id);
                    $('#id').val(data.id);
                    $('#users-modal').modal('show');
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                msgBox('error',errorThrown);
            });
        });
        
        $('#users-form').on('submit',function (e) {
            e.preventDefault();
            var fd = new FormData(this);
            var id = $('#id').val();
            var url;
            if(id!=''){
                url = 'Users/edit/' + id;
            }else{
                url = 'Users/add';
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
                    getUsers();
                    msgBox('success',data.message);
                    $('#users-modal').modal('hide');
                    resetUserForm(); 
                }else{
                    msgBox('error',data.message);
                }
            })
            .fail(function(jqXHR, textStatus, errorThrown){
                msgBox('error',errorThrown);
            });
        });

        $('#users-table').on('click', '.delete', function (e) {
            e.preventDefault();
            var id=$(this).data('id');
            isDelete(function (confirmed) {
                if (confirmed) {
                    $.ajax({
                        url: 'Users/delete/'+ id,
                        type: "DELETE",
                        dataType: 'json',
                        headers : {
                            'X-CSRF-Token': $('[name="_csrfToken"]').val()
                        },
                    })
                    .done(function(data, textStatus, jqXHR){
                        if(data.result=='success'){
                            getUsers();
                            msgBox('success',data.message);
                        }else{
                            msgBox('error',data.message);
                        }
                    })
                    .fail(function(jqXHR, textStatus, errorThrown){
                        msgBox('error',errorThrown);
                    });

                }
            });
        });
    });

    var selectedUserData;
    var isDeleteConfirmationDisplayed = false;

    function getUsers() {
        var table = $("#users-table").dataTable({
            "responsive": true,
            "autoWidth": false,
            "destroy": true,
            "order": [[0, "asc"]],
            "ajax": {
                "url": 'Users/getUsers'
            },
            "columns": [
                { data: "username" },
                { data: "fullname" },
                {
                    data: "bdate",
                    render: function (data, type, row) {
                        if (type === 'display' && data && data.length === 10 && data.includes('-')) {
                            var parts = data.split('-');
                            if (parts.length === 3) {
                                    // Reformat to mm-dd-yyyy
                                return parts[1] + '-' + parts[2] + '-' + parts[0];
                            }
                        }
                        return data;
                    }
                },
                { data: "tin_no" },
                { data: "plantilla_no" },
                { data: "position" },
                { data: "role" },
                { data: "contact" },
                { data: "department.name"},
                {
                    data: null,
                    render: function (data, type, row) {
                        var option = '<div style="text-align:center;">' +
                        '<a href="#" class="delete" data-toggle="tooltip" ' +
                        'data-placement="bottom" title="Delete User" data-id="' + data.id + '"><i ' +
                        'class="fa fa fa-trash"></i></a></div>';
                        return option;
                    }
                },
                ]
        });

        $('#users-table tbody').on('click', 'tr', function (e) {
            if (!table.api().rows().any()) {
                return;
            }
            if ($(e.target).is('.edit')) {
                return;
            }
            var data = table.api().row(this).data();
            if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
                resetUserForm();
                $('#title').html('User Details');
                $('#username').val(data.username);
                $('#password').val(data.password);
                $('#fullname').val(data.fullname);
                $('#bdate').val(data.bdate);
                $('#tin_no').val(data.tin_no);
                $('#plantilla_no').val(data.plantilla_no);
                $('#position').val(data.position);
                $('#role').val(data.role);
                $('#contact').val(data.contact);
                $('#department_id').val(data.department_id);
                $('#id').val(data.id);
                $('#users-modal').modal('show');
            }
        });

        $('#users-table tbody').on('click', '.delete', function (e) {
            if (!table.api().rows().any()) {
                return;
            }
            e.preventDefault();
            if (!isDeleteConfirmationDisplayed) { // Check if delete confirmation is not displayed
                var data = table.api().row($(this).closest('tr')).data();
                selectedUserData = data;
                isDeleteConfirmationDisplayed = true; // Set delete confirmation flag to true
                $('#delete-modal').modal('show');
            }
        });

        $('#users-table').on('click', '.delete', function (e) {
            e.preventDefault();
            var id=$(this).data('id');
            isDelete(function (confirmed) {
                if (confirmed) {
                    $.ajax({
                        url: 'Users/delete/'+ id,
                        type: "DELETE",
                        dataType: 'json',
                        headers : {
                            'X-CSRF-Token': $('[name="_csrfToken"]').val()
                        },
                    })
                    .done(function(data, textStatus, jqXHR){
                        if(data.result=='success'){
                            getUsers();
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

    function validateTinNo(input) {
        var tinNo = input.value;
        var tinNoError = document.getElementById('tin-no-error');

                // Check if TIN No. has between 9 and 12 digits
        if (tinNo.length < 9 || tinNo.length > 12) {
            tinNoError.textContent = 'TIN No. must have between 9 and 12 digits.';
        } else {
                    tinNoError.textContent = ''; // Clear the error message
                }
            }