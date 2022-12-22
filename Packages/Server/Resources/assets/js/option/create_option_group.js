import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;
let errorMessage = 'Message Error: ';

$(document).ready(function () {
    $('.btn-submit').on('click', function () {
        let url = $(this).closest('.forms-sample').attr('data-route');

        let params = {
            'name': $('#optionGroupName').val(),
            'option_group': $('#optionGroupSelect').val(),
            'status': $('#optionGroupStatus').val(),
        }

        ajaxWithCsrf(url, params, function processResponse(res) {
            if (res.data.status) {
                toastr.success('Create option group success');
                setTimeout(() => {
                    $('.button-cancel span').trigger('click');
                }, 250)
                return;
            } else {
                toastr.error(res.data.errorMessage);
                return;
            }
        }, 'Something error!!!');
    })
})
