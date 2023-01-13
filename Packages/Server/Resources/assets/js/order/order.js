import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;
let errorMessage = 'Lỗi: ';

let currentParams;

$(document).ready(function () {
    getOrderDetail();

})

function getOrderDetail(page = 1) {
    $(document).find('tr').not(':first').on('dblclick', function () {
        let order_id = $(this).data('id');
        let currentModal = $('#orderTable');

        getOrderDetailList(order_id, page, () => {
            let optionModal = {}
            $(currentModal).modal(optionModal);
            $(currentModal).modal('show');
            $(currentModal).modal('hide');
        })
    });
}

function getOrderDetailList(order_id, page = 1, callback) {
    let url = $('#order_detail_list').val();
    let params = {
        'id': order_id,
        'page': page
    }

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status === true) {
            $('#orderTable .card-body').html('');
            $('#orderTable .card-body').append(res.data.html);
            $('.page-link-page').on('click', function () {
                getOrderDetailList(order_id, $(this).attr('data-page'));
            })
        } else {
            toastr.error(errorMessage + 'Chi tiết đơn hàng không tồn tại.')
        }
    }, 'Có lỗi bất ngờ xảy ra!')
    if (callback) { callback(); }
}


