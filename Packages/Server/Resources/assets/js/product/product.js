import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;
let errorMessage = 'Message Error: ';

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
            })
        } else {
            toastr.error('Property group is not exist.');
            return;
        }
        toastr.success('Search updated');
    }, 'Something error!!!');

    function appendResponse(res, callback) {
        $('.data-product-group-table').html(res.data.html);

        if(callback) callback();
    }
}

function expandRow() {
    $('.expand-button').on('click', function () {
        let this_detail = $(this).closest('tbody').find('.product_detail');
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
                toastr.error(errorMessage + 'Customer is not exist.')
            }
        }, 'Something error!!!')
        if (callback) { callback(); }
    }
}


