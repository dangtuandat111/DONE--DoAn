import {ajaxWithCsrf} from "./app";

let params = {
    'email': '',
    'password': '',
    'remember': 0
}

$(document).ready(function () {
    $('.btn-sign-in').on('click', function () {
        login();
    });
    logout();
})

function login() {
    let url = $('#login_post').val();
    params.email = $('#LoginForm-name').val();
    params.password = $('#LoginForm-pass').val();
    params.remember = $('#remember_me').is(':checked');

    if (!checkSubmit()) return;

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status === true) {
            toastr.success('Đăng nhập thành công')
            setTimeout(() => {
                window.location.reload();
            }, 500)
        } else {
            toastr.error('Email hoặc mật khẩu không đúng.')
        }
    }, 'Có lỗi bất ngờ xảy ra')
}

function checkSubmit() {
    let emailRegex = /^([a-z0-9.\/\+%&,|}#\"_~:-]+)\@([a-z0-9_])([a-z0-9._-]*)\.([a-z]+$)/;
    let passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$|^([0-9]{8})+$/;
    if (!emailRegex.test(params.email)) {
        toastr.error('Lỗi ' + 'Địa chỉ email không hợp lệ');
        return false;
    }
    if (params.password && !passRegex.test(params.password)) {
        toastr.error('Lỗi:  ' + 'Mật khẩu không hợp lệ.');
        return false;
    }
    return true;
}

function logout() {
    $('.btn-logout').on('click', function () {
        let url = $('#logout_post').val()
        ajaxWithCsrf(url, params, function processResponse(res) {
            if (res.data.status === true) {
                toastr.success('Đăng xuất thành công.')
                setTimeout(() => {
                    location.href = res.data.redirect_url
                }, 500)
            } else {
                toastr.error(errorMessage + res.data.message)
            }
        }, 'Có lỗi bất ngờ xảy ra.')
    })
}
