import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;
let errorMessage = 'Lỗi: ';

let currentParams;

$(document).ready(function () {
    getSearchPropertyGroup();
})

$('#buttonSearch').on('click', function () {
    getSearchPropertyGroup();
})

function getSearchPropertyGroup(page = 1) {
    let url = $('#search_property_group').val();
    let params = {
        'perPage': ($("select[name='order-listing_length'] :selected").val()),
        'property_group': ($("select[name='filter_search_group'] :selected").val()),
        'name': $("#search_property_name").val(),
        'page': page
    }
    currentParams = params;

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status) {
            appendResponse(res, () => {
                openProperty();
                $("#sortable-table-1").tablesort();
            })
        } else {
            toastr.error('Nhóm thuộc tính không tồn tại.');
            return;
        }
        toastr.success('Cập nhật thành công');
    }, 'Có lỗi bất ngờ xảy ra!');

    function appendResponse(res, callback) {
        $('.data-property-group-table').html(res.data.html);

        if(callback) callback();
    }
}

function getSearchProperty(id, current) {
    let url = $('#search_property').val();
    let params = {
        'property_group': id,
        'name': $("#search_property_name").val(),
        'page': 1
    }
    currentParams = params;

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status) {
            appendResponse(res,current, () => {
            })
        } else {
            toastr.error('Nhóm thuộc tính không tồn tại');
            return;
        }
        toastr.success('Cập nhật thành công');
    }, 'Có lỗi bất ngờ xảy ra!');

    function appendResponse(res,current, callback) {
        $(current).html(res.data.html);

        if(callback) callback();
    }
}

function openProperty() {
    $('.details-control').on('click', function () {
        let id = $(this).attr('data-id');
        let current = $(this).closest('tbody').find('.property-table-' + id);
        if ($(current).hasClass('d-none')) {
            if (!$.trim($(current).html())) {
                getSearchProperty(id, current);
            }
            $(current).removeClass('d-none')
        } else {
            $(current).addClass('d-none')
        }
    })
}
