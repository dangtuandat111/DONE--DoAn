import {ajaxWithCsrf} from "./app";

import ClassicEditor from "@ckeditor/ckeditor5-build-classic";

let editor;
$(document).ready(function () {
    updateMail();
    ClassicEditor
        .create(document.getElementById('customer_description'), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo', ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            placeholder: 'Nhập thông tin mô tả',
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
        })
        .then( newEditor => {
            editor = newEditor;
        } )
        .catch(error => {
            console.log(`error`, error)
        });
})
$('#edit-profile').on('click', function () {
    updateProfile();
})

function updateProfile() {
    let url = $('#profile_update').val();
    let params = {
        'name': $('#customer_name').val(),
        'phone_number': $('#customer_phone_number').val(),
        'description':  editor.getData(),
        'gender': $('#customer_gender').val(),
        'address': $('#customer_address').val(),
    }
    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status == true) {
            toastr.success('Cập nhật thông tin thành công.');
            setTimeout(() => {
                location.reload();
            }, 350)
        }
    }, 'Có lỗi bất ngờ xảy ra');
}

function updateMail() {
    $('#send-mail').on('click', function () {
        let url = $('#profile_send_mail_password').val();
        let params = {
            'email': $('#base_mail').val()
        }
        ajaxWithCsrf(url, params, function processResponse(res) {
            if (res.data.status == true) {
                $('.step-1').addClass('d-none');
                $('.step-2').removeClass('d-none');
            }
        }, 'Có lỗi bất ngờ xảy ra');
    })
}
updatePassword();
function updatePassword() {
    $('#send-update-pass').on('click', function () {
        let url = $('#profile_update_pass').val();
        let params = {
            'otp': $('#customer_otp').val(),
            'pass': $('#customer_new_password').val()
        }
        ajaxWithCsrf(url, params, function processResponse(res) {
            if (res.data.status == true) {
                toastr.success('Thay đổi mật khẩu thành công.');
                setTimeout(() => {
                    location.reload();
                },350)
            }
        }, 'Có lỗi bất ngờ xảy ra');
    })
}

