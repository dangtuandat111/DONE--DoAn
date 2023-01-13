import {ajaxWithCsrf} from "./app";

let errorMessage = 'Lỗi: ';
let id_product_variant;

$(document).ready(function () {
    updateCart();
})

function updateCart() {
    $('.table-p-qty').on('change', function () {
        let url = $('#update_cart').val();

        let params = {};
        params.count = $(this).find('input').val();
        params.id = $(this).closest('tr').attr('data-id');

        if (!params.count || params.count <= 0) {
            return;
        }

        let that = $(this);
        ajaxWithCsrf(url, params, function processResponse(res) {
            if (res.data.status === true) {
                toastr.success('Add cart successfull.')
                let price = parseFloat($(that).closest('tr').find('.table-p-price p').text());
                let count = parseFloat($(that).closest('tr').find('.table-p-qty input').val());
                $(that).closest('tr').find('.table-total p').text(price * count);
                let totalBill = 0, element;
                $(document).find('.table-total p').each(function () {
                    totalBill += parseFloat($(this).text());
                });
                $('.c-total-price').text(totalBill.toFixed(3));
            } else {
                toastr.error(errorMessage + res.data.errorMessage)
            }
        }, 'Có lỗi bất ngờ xảy ra.')
    })
}

$('.table-remove').on('click', function () {
    id_product_variant = $(this).closest('tr').attr('data-id');
})

$('.btn-save').on('click', function () {
    if (id_product_variant) {
        let url = $('#delete_cart').val();

        let params = {};
        params.status = 0;
        params.id = id_product_variant;

        let that = $(this);
        ajaxWithCsrf(url, params, function processResponse(res) {
            if (res.data.status === true) {
                toastr.success('Cập nhật thành công.');
                ($('tr[data-id=' + id_product_variant + ']').remove());
            } else {
                toastr.error(errorMessage + res.data.errorMessage)
            }
        }, null)
    } else {
        toastr.error(errorMessage + 'Chọn lấy sản phẩm để thực hiện.')
    }
})
