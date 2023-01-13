import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;
let errorMessage = 'Lỗi: ';

let currentParams;

$(document).ready(function () {
    getSearchProduct();
})

$('#buttonSearch').on('click', function () {
    getSearchProduct();
})

function getSearchProduct(page = 1) {
    let url = $('#search_product').val();
    let params = {
        'perPage': ($("select[name='order-listing_length'] :selected").val()),
        'search_brand_group': ($("select[name='search_brand_group'] :selected").val()),
        'search_category_group': ($("select[name='search_category_group'] :selected").val()),
        'name': $("#search_product_name").val(),
        'page': page
    }
    currentParams = params;

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status) {
            appendResponse(res, () => {
                $("#product-table").tablesort();
                expandRow();
                getProductVariant();
                $('.page-link-page').on('click', function () {
                    getSearchProduct($(this).attr('data-page'));
                })
            })
        } else {
            toastr.error('Nhóm thuộc tính không tồn tại.');
            return;
        }
        toastr.success('Cập nhật thành công');
    }, 'Có lỗi bất ngờ xảy ra!');

    function appendResponse(res, callback) {
        $('.data-product-group-table').html(res.data.html);

        if(callback) callback();
    }
}

function expandRow() {
    $('.expand-button').on('click', function () {
        let id = $(this).attr('data-id');
        let this_detail = $(this).closest('tbody').find('.product_detail[data-id=' + id + ']');
        if ($(this_detail).hasClass('d-none')) {
            $(this_detail).removeClass('d-none');
        } else {
            $(this_detail).addClass('d-none');
        }
    })
}

function getProductVariant() {
    $(document).find('tr').not(':first').on('dblclick', function () {
        let product_id = $(this).data('id');
        let currentModal = $('#productVariant');

        getProductVariantData(product_id, () => {
            let optionModal = {}
            $(currentModal).modal(optionModal);
            $(currentModal).modal('show');
            $(currentModal).modal('hide');
        })
    });

    function getProductVariantData(product_id, callback) {
        let url = $('#get_product_variant').val();
        let params = {
            'id': product_id
        }

        ajaxWithCsrf(url, params, function processResponse(res) {
            if (res.data.status === true) {
                $('#productVariant .card-body').html('');
                $('#productVariant .card-body').append(res.data.html);
            } else {
                toastr.error(errorMessage + 'Người dùng không tồn tại.')
            }
        }, 'Có lỗi bất ngờ xảy ra!')
        if (callback) { callback(); }
    }
}


