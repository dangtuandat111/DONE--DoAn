import {ajaxWithCsrf} from "./app";

var currentParam = {
    'page': 1,
    'product_name': '',
    'perPage': $('#product_per_page').val(),
    'id_category': -1,
    'id_brand': -1,
    'id_color': -2
}

var CATEGORY = 0;
var BRAND = 1;
var COLOR = 2;

$(document).ready(function () {
    getSearch();
    changePerPage();
    changeName();
    changeCategory();
    changeBrand();
    changeColor();
    removeFilter();
});

function getSearch(page = 1, callback) {
    currentParam['page'] = page;

    let params = currentParam;
    let url = $('#search_product').val();

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status === true) {
            if ($('.searchContent').html() == '') {
                console.log('empty')
            }
            // $('.searchContent').html('');
            $('.searchResult').html(res.data.html);
            $('.page-link-page').on('click', function () {
                getSearch($(this).attr('data-page'));
            })
        } else {
            toastr.error(errorMessage + 'Khách hàng này hiện  không tồn tại')
        }
    }, 'Có lỗi bất ngờ xảy ra.')

    if (callback) { callback(); }
}

function changePerPage() {
    $('#product_per_page').on('change', function () {
        currentParam['page'] = 1;
        currentParam['perPage'] = $('#product_per_page').val();
        getSearch();
    })
}

function changeName() {
    $('#product_name').on('change', function () {
        currentParam['product_name'] = $(this).val();
        getSearch();
    })
}

function changeCategory() {
    $('.change_category').on('click', function () {
        resetSearch(CATEGORY);
        currentParam['id_category'] = $(this).closest('.nav-link').attr('data-category');
        getSearch();
        $(this).addClass('bg-info text-white');
    })
}

function changeBrand() {
    $('.change_brand').on('click', function () {
        resetSearch(BRAND);
        currentParam['id_brand'] = $(this).closest('.nav-link').attr('data-brand');
        getSearch();
        $(this).addClass('bg-info text-white');
    })
}

function changeColor() {
    $('.change-color').on('click', function () {
        resetSearch(COLOR);
        currentParam['id_color'] = $(this).find('a').attr('data-color');
        getSearch();
        $(this).addClass('bg-info text-white');
    })
}

function removeFilter() {
    $('.reset-params').on('click', function () {
        resetSearch();
        getSearch();
    })
}

function resetSearch(type = '') {
    switch (type) {
        case CATEGORY:
            $('.change_category').removeClass('bg-info text-white');

            currentParam['page'] = 1

            break;
        case BRAND:
            $(document).find('.change_brand').removeClass('bg-info text-white');

            currentParam['page'] = 1

            break;
        case COLOR:
            $('.left-column').find('.sidebar-block.color div').removeClass('bg-info text-white');

            currentParam['page'] = 1

            break;
        default:
            $('.change_category').removeClass('bg-info text-white');
            $('.change_brand').removeClass('bg-info text-white');
            $('.change-color').removeClass('bg-info text-white');
            $('.sidebar-widget-option').find('div').removeClass('bg-info text-white');

            currentParam['page'] = 1
            currentParam['id_category'] = -1;
            currentParam['id_brand'] = -1;
            currentParam['id_color'] = -2;
    }
}
