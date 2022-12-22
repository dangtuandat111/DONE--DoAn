import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;

$(document).ready(function () {
    $("#sortable-table-1").tablesort();
    outFocusModal();
    $('.update_status_disabled').on('click', function () {
        let id = $(this).data('id');
        let status = 0;
        let url = $('#update_status_account').val();
        let params = {
            'id': id,
            'status': status
        }
        let errorMessage = 'Update user status failed.';
        let that = $(this);
        let row_id = $(this).closest('td');
        ajaxWithCsrf(url, params, function processResponse(res) {
            toastr.success('Update user status successfull.');
            $(that).removeClass('btn btn-light btn-rounded disabled');
            $(that).addClass('badge-danger');
            $(row_id).find('.update_status_enabled').removeClass('badge-warning');
            $(row_id).find('.update_status_enabled').addClass('btn btn-light btn-rounded disabled');
        }, errorMessage)
    })
    $('.update_status_enabled').on('click', function () {
        let id = $(this).data('id');
        let status = 1;
        let url = $('#update_status_account').val();
        let params = {
            'id': id,
            'status': status
        }
        let errorMessage = 'Update user status failed.';
        let that = $(this);
        let row_id = $(this).closest('td');
        ajaxWithCsrf(url, params, function processResponse(res) {
            toastr.success('Update user status successfull.');
            $(that).removeClass('btn btn-light btn-rounded disabled');
            $(that).addClass('badge-warning');
            $(row_id).find('.update_status_disabled').removeClass('badge-danger');
            $(row_id).find('.update_status_disabled').addClass('btn btn-light btn-rounded disabled');
        }, errorMessage)
    })
    $('.update_admin_role').on('click', function () {
        $('.confirm-save').attr('data-id', $(this).attr('data-id'));
    })
    $('.confirm-save').on('click', function () {
        let id = $(this).data('id');
        let url = $('#upgrade_account').val();
        let params = {
            'id': id,
            'role': 1
        }
        let errorMessage = 'Update user info failed.';
        ajaxWithCsrf(url, params, function processResponse(res) {
            if (res.data.status) {
                toastr.success('Update user info successfull.');
                $('.update_admin_role[data-id="' + id + '"]').addClass('disabled');
                $('.update_admin_role[data-id="' + id + '"]').text('Admin');
            } else {
                toastr.error('Update user info fail.');
            }
            $('#js-panel').modal('hide');
        }, errorMessage)
    })

    $('#buttonSearch').on('click', function () {
        let url = $('#search_account').val();
        let params = {
            'name': $('#search_account_name').val(),
            'perPage': $('select[name="order-listing_length"]').val()
        }

        ajaxWithCsrf(url, params, function processResponse(res) {
            if (res.data.html) {
                $('.data-customer-table').html(res.data.html);
                $("#sortable-table-1").tablesort();
            } else {
                toastr.error('User is not exist.');
                return;
            }
            toastr.success('Search updated.');
        }, 'Something error!!!');
    })
})

function outFocusModal() {
    $('#js-panel').on('hidden.bs.modal', function () {
        setTimeout(() => {
            $('button').blur();
        },60);
    })
}
