import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;
let errorMessage = 'Lỗi: ';

$(document).ready(function () {
    $("#sortable-table-1").tablesort();
    $('footer').remove();
    showProfile();
    adminAction();
    $('.update_status_disabled').on('click', function () {
        let id = $(this).data('id');
        let status = 0;
        let url = $('#update_status_customer').val();
        let params = {
            'id': id,
            'status': status
        }
        let errorMessage = 'Cập nhật thông tin người dùng thành công.';
        let that = $(this);
        let row_id = $(this).closest('td');
        ajaxWithCsrf(url, params, function processResponse(res) {
            toastr.success('Update customer info successfull.');
            $(that).removeClass('btn btn-light btn-rounded disabled');
            $(that).addClass('badge-danger');
            $(row_id).find('.update_status_enabled').removeClass('badge-warning');
            $(row_id).find('.update_status_enabled').addClass('btn btn-light btn-rounded disabled');
        }, errorMessage)
    })
    $('.update_status_enabled').on('click', function () {
        let id = $(this).data('id');
        let status = 1;
        let url = $('#update_status_customer').val();
        let params = {
            'id': id,
            'status': status
        }
        let errorMessage = 'Cập nhật thông tin người dùng thất bại';
        let that = $(this);
        let row_id = $(this).closest('td');
        ajaxWithCsrf(url, params, function processResponse(res) {
            toastr.success('Cập nhật thông tin người dùng thành công.');
            $(that).removeClass('btn btn-light btn-rounded disabled');
            $(that).addClass('badge-warning');
            $(row_id).find('.update_status_disabled').removeClass('badge-danger');
            $(row_id).find('.update_status_disabled').addClass('btn btn-light btn-rounded disabled');
        }, errorMessage)
    })
    $('.page-link-page').on('click', function () {
        $('#buttonSearch').trigger('click', [$(this).attr('data-page')]);
    })
})

$('#buttonSearch').on('click', function (e, data) {
    let url = $('#search_customer').val();
    let page = 1;
    if (data) {
        page = data[0];
    }
    let params = {
        'perPage': ($("select[name='order-listing_length'] :selected").val()),
        'name': $("#search_customer_name").val(),
        'email': $("#search_customer_email").val(),
        'status': $("select[name='search_customer_status'] :selected").val(),
        'page': page
    }

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status === true) {
            $('.data-customer-table').html();
            $('.data-customer-table').html(res.data.html);
            $("#sortable-table-1").tablesort();
            $('.page-link-page').on('click', function () {
                $('#buttonSearch').trigger('click', [$(this).attr('data-page')]);
            })
            adminAction();
            toastr.success('Cập nhật thành công.');
        } else {
            toastr.error(errorMessage + 'Người dùng không tồn tại')
        }
    }, 'Có lỗi bất ngờ xảy ra!')
})

function showProfile() {
    let currentModal = $('#customerModal');

    $(document).find('tr').not(':first').on('dblclick', function () {
        let customer_id = $(this).data('id');
        getUserData(customer_id, () => {
            let optionModal = {backdrop: 'static', keyboard: false}
            $(currentModal).modal(optionModal);
            $(currentModal).modal('show');
        })
    });

    $(currentModal).on('show', function () {
        $('body').addClass('openModal');
    })

    $(currentModal).on('hide', function () {
        $('body').removeClass('openModal');
    })
}

function getUserData(customer_id, callback) {
    let url = $('#get_customer_data').val();
    let params = {
        'id': customer_id
    }

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status === true) {
            $('.modal-name').text(res.data.data[0]['name']);
            $('.modal-phone-number').text(res.data.data[0]['phone_number']);
            $('.modal-email').text(res.data.data[0]['email']);
            $('.modal-address').text(res.data.data[0]['address']);
            $('.modal-c_at').text(res.data.data[0]['c_at']);
            $('.modal-u_at').text(res.data.data[0]['u_at']);
            $('.modal-description').text(res.data.data[0]['description']);
            if (res.data.data[0]['status'] == 'Enabled') {
                $('.modal-header').addClass('bg-blue');
            } else {
                $('.modal-header').addClass('bg-red');
            }
        } else {
            toastr.error(errorMessage + 'Người dùng không tồn tại.')
        }
    }, 'Có lỗi bất ngờ xảy ra!')
    if (callback) { callback(); }
}

function adminAction() {
    $('.reset-pass').on('click', function () {
        let url = $('#reset_pass_customer').val();
        let params = {
            'id': $(this).attr('data-id')
        }

        ajaxWithCsrf(url, params, function processResponse(res) {
            if (res.data.status === true) {
                toastr.success('Đặt lại mật khẩu thành công')
            } else {
                toastr.error(errorMessage + 'Đặt lại mật khẩu thành công')
            }
        }, 'Có lỗi bất ngờ xảy ra!')
    })

    $('.force-login').on('click', function () {
        let url = $('#logout_customer').val();
        let params = {
            'id': $(this).attr('data-id')
        }

        ajaxWithCsrf(url, params, function processResponse(res) {
            if (res.data.status === true) {
                toastr.success('Đăng xuất thành công.')
            } else {
                toastr.error(errorMessage + 'Đăng xuất không thành công.')
            }
        }, 'Có lỗi bất ngờ xảy ra!')
    })
}
