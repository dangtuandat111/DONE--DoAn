import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;

$(document).ready(function () {
    $("#sortable-table-1").tablesort();
    $('.update_status_disabled').on('click', function () {
        let id = $(this).data('id');
        let status = 0;
        let url = $('#update_status_brand').val();
        let params = {
            'id': id,
            'status': status
        }
        let errorMessage = 'Update brand info failed.';
        let that = $(this);
        let row_id = $(this).closest('td');
        ajaxWithCsrf(url, params, function processResponse(res) {
            toastr.success('Cập nhật thông tin thành công.');
            $(that).removeClass('btn btn-light btn-rounded disabled');
            $(that).addClass('badge-danger');
            $(row_id).find('.update_status_enabled').removeClass('badge-warning');
            $(row_id).find('.update_status_enabled').addClass('btn btn-light btn-rounded disabled');
        }, errorMessage)
    })
    $('.update_status_enabled').on('click', function () {
        let id = $(this).data('id');
        let status = 1;
        let url = $('#update_status_brand').val();
        let params = {
            'id': id,
            'status': status
        }
        let errorMessage = 'Update brand info failed.';
        let that = $(this);
        let row_id = $(this).closest('td');
        ajaxWithCsrf(url, params, function processResponse(res) {
            toastr.success('Cập nhật thông tin nhãn hàng thành công');
            $(that).removeClass('btn btn-light btn-rounded disabled');
            $(that).addClass('badge-warning');
            $(row_id).find('.update_status_disabled').removeClass('badge-danger');
            $(row_id).find('.update_status_disabled').addClass('btn btn-light btn-rounded disabled');
        }, errorMessage)
    })
    $('#buttonSearch').on('click', function () {
        let url = $('#search_brand').val();
        let params = {
            'name': $('#search_brand_name').val()
        }

        ajaxWithCsrf(url, params, function processResponse(res) {
            console.log(res.data);
            if (res.data.html) {
                $('.brand_list').html(res.data.html);
                $("#sortable-table-1").tablesort();
            } else {
                toastr.error('Nhãn hàng không tồn tại.');
                return;
            }
            toastr.success('Cập nhật thành công.');
        }, 'Có lỗi bất ngờ xảy ra.');
    })
})
