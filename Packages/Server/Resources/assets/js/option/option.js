import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;
let errorMessage = 'Message Error: ';

let currentParams

$(document).ready(function () {
    getSearchOption();
})

$('#buttonSearch').on('click', function () {
    getSearchOption();
})

function getSearchOption(page = 1) {
    let url = $('#search_option').val();
    let params = {
        'perPage': ($("select[name='order-listing_length'] :selected").val()),
        'option_group': ($("select[name='filter_search_group'] :selected").val()),
        'name': $("#search_option_value").val(),
        'page': page
    }
    currentParams = params;

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.html) {
            appendResponse(res, () => {
                openOption();
                changePageLink();
                updateEditGroup();
                updateEditOption();
                updateOptionGroup();
            })
        } else {
            toastr.error('Tùy chọn không tồn tại');
            return;
        }
        toastr.success('Cập nhật thành công.');
    }, 'Có lỗi bất ngờ xảy ra!');

    function appendResponse(res, callback) {
        $('.data-option-table').html(res.data.html);

        if(callback) callback();
    }
}

function openOption() {
    $('.details-control').on('click', function () {
        let toggleElement = $($(this).attr('data-element-id'));
        if (toggleElement.hasClass('d-none')) {
            toggleElement.removeClass('d-none');
        } else {
            console.log(11);
            toggleElement.addClass('d-none');
        }
    })
}

function changePageLink() {
    $('.page-link-page').on('click', function () {
        getSearchOption($(this).attr('data-page'));
    })

}

function updateEditGroup() {
    let current;
    $('.edit-option-group').on('click', function () {
        $(document).find('#edit-option-group .confirm-save').attr('data-id', $(this).attr('data-id'));
        current = $(this).closest('tr').find('.og_name');
    })
    $('#edit-option-group .confirm-save').on('click', function () {
        let id = $(this).data('id');
        let url = $('#update_option_group').val();
        let name = $('#optionGroupName').val();
        let params = {
            'id': id,
            'name': name
        }
        let errorMessage = 'Cập nhật nhóm tùy chọn thất bại.';
        ajaxWithCsrf(url, params, function processResponse(res) {
            if (res.data.status) {
                toastr.success('Cập nhật nhóm tùy chọn thành công');
                $(current).text(name);
            } else {
                toastr.error('Cập nhật nhóm tùy chọn thất bại.');
            }
            $('#edit-option-group').modal('hide');
        }, errorMessage)
    })
}

function updateOptionGroup() {
    $('.update_status_option_group_disabled').on('click', function () {
        let id = $(this).data('id');
        let status = 0;
        let url = $('#update_status_option_group').val();
        let params = {
            'id': id,
            'status': status
        }
        let errorMessage = 'Cập nhật nhóm tùy chọn thất bại.';
        let that = $(this);
        let row_id = $(this).closest('td');
        ajaxWithCsrf(url, params, function processResponse(res) {
            toastr.success('Cập nhật nhóm tùy chọn thành công.');
            $(that).removeClass('btn btn-light btn-rounded disabled');
            $(that).addClass('badge-danger');
            $(row_id).find('.update_status_option_group_enabled').removeClass('badge-warning');
            $(row_id).find('.update_status_option_group_enabled').addClass('btn btn-light btn-rounded disabled');
        }, errorMessage)
    })

    $('.update_status_option_group_enabled').on('click', function () {
        let id = $(this).data('id');
        let status = 1;
        let url = $('#update_status_option_group').val();
        let params = {
            'id': id,
            'status': status
        }
        let errorMessage = 'Cập nhật nhóm tùy chọn thất bại.';
        let that = $(this);
        let row_id = $(this).closest('td');
        ajaxWithCsrf(url, params, function processResponse(res) {
            toastr.success('Cập nhật nhóm tùy chọn thất bại.');
            $(that).removeClass('btn btn-light btn-rounded disabled');
            $(that).addClass('badge-warning');
            $(row_id).find('.update_status_option_group_disabled').removeClass('badge-danger');
            $(row_id).find('.update_status_option_group_disabled').addClass('btn btn-light btn-rounded disabled');
        }, errorMessage)
    })
}

function updateEditOption() {
    let current;
    $('.edit-option').on('click', function () {
        $(document).find('#edit-option .confirm-save').attr('data-id', $(this).attr('data-id'));
        $(document).find('#edit-option .confirm-save').attr('data-name', $(this).attr('data-name'));
        $(document).find('#edit-option .confirm-save').attr('data-value', $(this).attr('data-value'));
        $(document).find('#edit-option .confirm-save').attr('data-bonus', $(this).attr('data-bonus'));

        $(document).find('#edit-option #optionName').val($(this).attr('data-name'));
        $(document).find('#edit-option #optionValue').val($(this).attr('data-value'));
        $(document).find('#edit-option #optionBonusCost').val($(this).attr('data-bonus'));

        current = $(this).closest('tr');
    })
    $('#edit-option .confirm-save').on('click', function () {
        let id = $(this).data('id');
        let url = $('#update_option_group').val();
        let name = $('#optionName').val();
        let value = $('#optionValue').val();
        let bonus = $('#optionBonusCost').val();
        let params = {
            'id': id,
            'name': name,
            'value': value,
            'bonus': bonus,
        }
        let errorMessage = 'Cập nhật tùy chọn thất bại';
        ajaxWithCsrf(url, params, function processResponse(res) {
            if (res.data.status) {
                toastr.success('Cập nhật tùy chọn thành công');
                $(current).find('.option_name').text(name);
                $(current).find('.option_value').text(value);
                $(current).find('.option_bonus').text(bonus);
            } else {
                toastr.error('Cập nhật tùy chọn thất bại');
            }
            $('#edit-option-group').modal('hide');
        }, errorMessage)
    })
}
