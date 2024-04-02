// New User
function submitForm() {
    var form = $('#addUserForm');
    var url = form.attr('action');
    var method = form.attr('method');
    var data = form.serialize();

    form.find('.is-invalid').removeClass('is-invalid');
    form.find('.invalid-feedback').remove(); 

    // Refresh selectpicker elements to apply validation
    $('.selectpicker').selectpicker('refresh');

    $.ajax({
        type: method,
        url: url,
        data: data,
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message
                });
                $('#add_user').modal('hide');
                $('#addUserForm').find('input, select, button').val('');
            }
        },
        error: function(response) {
            if (response.status === 422) {
                var errors = response.responseJSON.errors;
                $.each(errors, function (key, value) {
                    if ($("#" + key).hasClass('selectpicker')) {
                        // Add 'is-invalid' class to selectpicker's parent
                        $("#" + key).closest('.bootstrap-select').addClass("is-invalid");
                        // Add error message after selectpicker's parent
                        $("#" + key).closest('.bootstrap-select').after('<span class="invalid-feedback text-danger">'+value+'</span>');
                    } else {
                        // Add 'is-invalid' class to other input fields
                        $("#" + key).addClass("is-invalid").after('<span class="invalid-feedback text-danger">'+value+'</span>');
                    }
                });
            } else {
                console.log('Error:', response);
            }
        }
    });
}

// Edit User
function updateForm(userId) {
    var form = $('#updateUserForm' + userId);
    var url = form.attr('action');
    var method = form.attr('method');
    var data = form.serialize();

    form.find('.is-invalid').removeClass('is-invalid');
    form.find('.invalid-feedback').remove();

    $.ajax({
        type: method,
        url: url,
        data: data,
        success: function(response) {
            if (response.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message
                });
                $('#edit_user' + userId).modal('hide');
                form.find('input, select, button').val('');

                window.location.href = "user";
            }
        },
        error: function(response) {
            console.log(response.responseJSON.errors);
            if (response.status === 422) {
                var errors = response.responseJSON.errors;
                $.each(errors, function (key, value) {
                    $("." + key).addClass("is-invalid").after('<span class="invalid-feedback text-danger">'+value+'</span>');
                });
            } else {
                console.log('Error:', response);
            }
        }
    });
}

// Tenant
function submitTenant() {
    var form = $('#addTenantForm');
    var url = form.attr('action');
    var method = form.attr('method');
    var data = form.serialize();

    form.find('.is-invalid').removeClass('is-invalid');
    form.find('.invalid-feedback').remove(); 

    $.ajax({
        type: method,
        url: url,
        data: data,
        success: function(response) {
            if (response.success) {
                // alert(response.message);
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: response.message
                });
                $('#add_tenant').modal('hide');
                $('#addTenantForm').find('input, select, button').val('');

                window.location.href = "tenant";
            }
        },
        error: function(response) {
            if (response.status === 422) {
                var errors = response.responseJSON.errors;
                $.each(errors, function (key, value) {
                    $("#" + key).addClass("is-invalid").after('<span class="invalid-feedback text-danger">'+value+'</span>');
                });
            } else {
                console.log('Error:', response);
            }
        }
    });
}

// DataTables
$(document).ready(function(){
    var title = $('.ibox-title h5').text();
    $('.dataTables').DataTable({
        pageLength: 25,
        responsive: true,
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'csv', title: title},
            {extend: 'excel', title: title},
            {extend: 'pdf', title: title},
        ]
    });
});
