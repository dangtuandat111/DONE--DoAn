import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;

$(document).ready(function () {
    $("#sortable-table-1").tablesort();
    $('.update_status_disabled').on('click', function () {
        let id = $(this).data('id');
        let status = 0;
        let url = $('#update_status_category').val();
        let params = {
            'id': id,
            'status': status
        }
        let errorMessage = 'Cập nhật thông tin không thành công.';
        let that = $(this);
        let row_id = $(this).closest('td');
        ajaxWithCsrf(url, params, function processResponse(res) {
            toastr.success('Cập nhật thông tin thành công');
            $(that).removeClass('btn btn-light btn-rounded disabled');
            $(that).addClass('badge-danger');
            $(row_id).find('.update_status_enabled').removeClass('badge-warning');
            $(row_id).find('.update_status_enabled').addClass('btn btn-light btn-rounded disabled');
        }, errorMessage)
    })
    $('.update_status_enabled').on('click', function () {
        let id = $(this).data('id');
        let status = 1;
        let url = $('#update_status_category').val();
        let params = {
            'id': id,
            'status': status
        }
        let errorMessage = 'Cập nhật thông tin không thành công.';
        let that = $(this);
        let row_id = $(this).closest('td');
        ajaxWithCsrf(url, params, function processResponse(res) {
            toastr.success('Cập nhật thông tin thành công.');
            $(that).removeClass('btn btn-light btn-rounded disabled');
            $(that).addClass('badge-warning');
            $(row_id).find('.update_status_disabled').removeClass('badge-danger');
            $(row_id).find('.update_status_disabled').addClass('btn btn-light btn-rounded disabled');
        }, errorMessage)
    })
    $('#buttonSearch').on('click', function () {
        let url = $('#search_category').val();
        let params = {
            'name': $('#search_category_name').val()
        }

        ajaxWithCsrf(url, params, function processResponse(res) {
            console.log(res.data);
            if (res.data.html) {
                $('.category_list').html(res.data.html);
                $("#sortable-table-1").tablesort();
            } else {
                toastr.error('Loại giày không tồn tại');
                return;
            }
            toastr.success('Cập nhậ thành công.');
        }, 'Có lỗi bất ngờ xảy ra!');
    })
})
