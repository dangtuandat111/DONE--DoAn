import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;
let errorMessage = 'Lỗi: ';

$(document).ready(function () {
    $('.btn-submit').on('click', function () {
        let url = $(this).closest('.forms-sample').attr('data-route');

        let params = {
            'name': $('#optionName').val(),
            'option_group': $('#optionGroupSelect').val(),
            'option_value': $('#optionValue').val(),
            'option_bonus': $('#optionBonus').val(),
        }

        checkParams(params, () => {
            ajaxWithCsrf(url, params, function processResponse(res) {
                if (res.data.status) {
                    toastr.success('Thêm tùy chọn thành công');
                    setTimeout(() => {
                        $('.button-cancel span').trigger('click');
                    }, 250)
                    return;
                } else {
                    toastr.error(res.data.errorMessage);
                    return;
                }
            }, 'Có lỗi bất ngờ xảy ra!');
        })
    })
})

function checkParams(params, callback) {
    if (!params['name']) {
        toastr.error(errorMessage + 'Option name is required.');
        return;
    }
    if (!params['option_group']) {
        toastr.error(errorMessage + 'Option group is required.');
        return;
    }
    if (!params['option_bonus']) {
        toastr.error(errorMessage + 'Option bonus is required.');
        return;
    }
    if (!params['option_value']) {
        toastr.error(errorMessage + 'Option value is required.');
        return;
    }

    if (callback) callback()
}
