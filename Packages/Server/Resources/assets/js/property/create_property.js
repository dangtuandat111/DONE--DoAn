import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;
let errorMessage = 'Lỗi ';

$(document).ready(function () {
    $('.btn-submit').on('click', function () {
        let url = $(this).closest('.forms-sample').attr('data-route');

        let params = {
            'name': $('#propertyName').val(),
            'property_group': $('#propertyGroupSelect').val(),
            'property_value': $('#propertyValue').val(),
        }

        checkParams(params, () => {
            ajaxWithCsrf(url, params, function processResponse(res) {
                if (res.data.status) {
                    toastr.success('Thêm thuộc tính thành công');
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
    if (!params['property_group']) {
        toastr.error(errorMessage + 'Nhóm thuộc tính là cần thiết.');
        return;
    }
    if (!params['property_value']) {
        toastr.error(errorMessage + 'Giá trị thuộc tính là cần thiết.');
        return;
    }

    if (callback) callback()
}
