import {ajaxWithCsrf} from "./app";

let params = {
    'name': '',
    'email': '',
    'password': '',
}

$(document).ready(function () {
    $('.btn-sign-up').on('click', function () {
        signup();
    });
})

function signup() {
    let url = $('#signup_post').val();
    params.name = $('#RegisterForm-name').val();
    params.email = $('#RegisterForm-email').val();
    params.password = $('#RegisterForm-pass').val();

    if (!checkSubmit()) return;

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status === true) {
            toastr.success('Đăng kí thành công.')
            setTimeout(() => {
                window.location.reload();
            }, 500)
        } else {
            toastr.error(errorMessage + res.data.message)
        }
    }, 'Something error!!!')
}

function checkSubmit() {
    let emailRegex = /^([a-z0-9.\/\+%&,|}#\"_~:-]+)\@([a-z0-9_])([a-z0-9._-]*)\.([a-z]+$)/;
    let passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$|^([0-9]{8})+$/;
    if (!params.name) {
        toastr.error('Lỗi: ' + 'Tên người dùng không hợp lệ.');
        return false;
    }
    if (!emailRegex.test(params.email)) {
        toastr.error('Lỗi: ' + 'Địa chỉ email không hợp lệ.');
        return false;
    }
    if (params.password && !passRegex.test(params.password)) {
        toastr.error('Lỗi:  ' + 'Mật khẩu không hợp lệ.');
        return false;
    }
    return true;
}
