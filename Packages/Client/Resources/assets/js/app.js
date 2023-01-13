import axios from "axios";

export function ajaxWithCsrf(url, params, callback, errorMessage) {
    const config = {
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
        withCredentials: true,
    }
    return axios
        .post(url, params, config)
        .then(function (res) {
            callback(res)
        })
        .catch(function () {
            axiosErrorHandler(errorMessage)
        });
}

function axiosErrorHandler (errorMessage) {
    if (errorMessage) {
        toastr.error(errorMessage);
    }
}
