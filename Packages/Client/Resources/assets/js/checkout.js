import {ajaxWithCsrf} from "./app";

let errorMessage = 'Lỗi:';

$(document).ready(function () {
    updateCart();
})

function updateCart() {
    $('#checkoutButton').on('click', function () {
        let url = $('#post_checkout').val();

        let params = {};
        params.address = $('#address').val();
        params.phone_number = $('#phone_number').val();

        if (!params.address) {
            toastr.error('Thông tin địa chỉ không được bỏ trống')
        }

        if (!params.phone_number) {
            toastr.error('Thông tin số điện thoại không được bỏ trống')
        }

        ajaxWithCsrf(url, params, function processResponse(res) {
            if (res.data.status === true) {
                toastr.success('Đặt hàng thành công.')
                setTimeout(() => {
                    location.href = '/customer/';
                },350)
                // location.href = '/customer/'
            } else {
                toastr.error(errorMessage + res.data.errorMessage)
            }
        }, 'Có lỗi bất ngờ xảy ra')
    })
}

