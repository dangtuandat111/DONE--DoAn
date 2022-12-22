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
                $("#sortable-table-1").tablesort();
                expandRow();
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
