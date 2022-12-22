import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;
let errorMessage = 'Message Error: ';

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
                    toastr.success('Create property successfull');
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
})

function checkParams(params, callback) {
    if (!params['property_group']) {
        toastr.error(errorMessage + 'Property group is required.');
        return;
    }
    if (!params['property_value']) {
        toastr.error(errorMessage + 'Property value is required.');
        return;
    }

    if (callback) callback()
}
