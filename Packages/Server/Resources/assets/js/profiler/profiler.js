import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;
let errorMessage = 'Message Error: ';

$(document).ready(function () {
    setUpTab();
    editProfile();
})

function setUpTab() {
    $('#nav-history-tab').on('click', function () {
        if ($(this).hasClass('active')) return;
        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active')
        $('.tab-pane').addClass('d-none')

        $(this).addClass('active');
        $($(this).data('target')).addClass('show active')
        $($(this).data('target')).removeClass('d-none')
    })
    $('#nav-profile-tab').on('click', function () {
        if ($(this).hasClass('active')) return;

        $('.nav-link').removeClass('active');
        $('.tab-pane').removeClass('show active')
        $('.tab-pane').addClass('d-none')

        $(this).addClass('active');
        $($(this).data('target')).addClass('show active')
        $($(this).data('target')).removeClass('d-none')
    })
}

function editProfile() {
    $('#editProfileForm').on('submit', function (e) {
        e.preventDefault();
        let name = $('#name').val();
        let user_id = $('#user_id').val();
        let email = $('#email').val();
        let phone_number = $('#phone_number').val();
        let password = $('#password').val();
        let password_confirm = $('#password_confirm').val();
        if (checkValidData(name, email, phone_number, password, password_confirm)) {
            let url = $('#update_profile').val();
            let params = {
                'name': name,
                'email': email,
                'phone_number': phone_number,
                'password': password,
                'id': user_id
            }

            ajaxWithCsrf(url, params, function processResponse(res) {
                toastr.success('Profile updated.');
                location.reload();
            }, 'Something error!!!');
        }
    })
}

function checkValidData(name, email, phone_number, password, password_confirm) {
    console.log(name + '/' + email + '/' + phone_number);
    if (!name || !email || !phone_number) {
        toastr.error('ERROR MESSAGE: ' + 'All fields are required.');
        return false;
    } else {
        let emailRegex = /^([a-z0-9.\/\+%&,|}#\"_~:-]+)\@([a-z0-9_])([a-z0-9._-]*)\.([a-z]+$)/;
        let passRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$|^([0-9]{8})+$/;
        if (!emailRegex.test(email)) {
            toastr.error('ERROR MESSAGE: ' + 'Email address is invalid.');
            return false;
        }
        if (password && !passRegex.test(password)) {
            toastr.error('ERROR MESSAGE: ' + 'Password is invalid.');
            return false;
        }
        if (password !== password_confirm) {
            toastr.error('ERROR MESSAGE: ' + 'Password and Password confirm are not the same.');
            return false;
        }
        return true;
    }
}

$('.btn-change-avatar').on('click', function () {
    if ($('#change_avatar').hasClass('d-none')) {
        $('#change_avatar').removeClass('d-none');
    } else {
        $('#change_avatar').addClass('d-none');
    }
})

