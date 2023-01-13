import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;
let errorMessage = 'Lỗi:';

import ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';


$(document).ready(function () {
    ClassicEditor
        .create(document.getElementById('product_variant_description'), {
            toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote', 'undo', 'redo', ],
            heading: {
                options: [
                    { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                    { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                    { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                    { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                    { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                    { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                    { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                ]
            },
            placeholder: 'Thêm mô tả biến thể sản phẩm',
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
        })
        .catch(error => {
            console.log(`error`, error)
        });

    uploadMutipleImage();
})

$('.btn-submit').on('click', function (e) {
    let status = true;
    if (!$('#product_variant_count').val()) {
        toastr.error(errorMessage + 'Thêm số lượng để tiếp tục');
        status = false;
    }

    let property_element = $('[id^="product_variant_property_"]');
    for (let pe of property_element) {
        if (!$(pe).val() || $(pe).val() < 0) {
            e.preventDefault();
            toastr.error(errorMessage + 'Chọn các thuộc tính để tiếp tục.');
            return;
        }
    }

    if ($('#product_variant_discount').is(':checked')) {
        if (!$('#product_variant_discount_percent').val() || !isNumeric($('#product_variant_discount_percent').val())) {
            if (parseFloat($('#product_variant_discount_percent').val()) >= 100 || parseFloat($('#product_variant_discount_percent').val()) < 0) {
                toastr.error(errorMessage + 'Giảm giá (%) không hợp lệ.');
                status = false;
            }
        } else if (!$('#product_variant_start_discount').val() || !$('#product_variant_end_discount').val()) {
            toastr.error(errorMessage + 'Chọn thời gian bắt đầu để tiếp tục');
            status = false;
        } else if (isNumeric($('#product_price').val())) {
            if (parseFloat($('#product_variant_discount_percent').val()) >= 100 || parseFloat($('#product_variant_discount_percent').val()) < 0) {
                toastr.error(errorMessage + 'Chọn thời gian kết thúc để tiếp tục.');
                status = false;
            }
        }
    }
    if (status == false) {
        e.preventDefault();
        return false;
    } else {
        return true;
    }
})

$('#product_variant_discount').change(function() {
    if(this.checked) {
        $('.product_variant_detail').removeClass('d-none');
    } else {
        $('.product_variant_detail').addClass('d-none');
    }
});

function isNumeric(value) {
    return /^-?\d*(\.\d+)?$/.test(value);
}

function uploadMutipleImage() {
    $('.dandev_insert_attach').click(function() {
        if ($('.dandev_attach_view').children().length >= 6) {
            return;
        }
        if ($('.list_attach').hasClass('show-btn') === false) {
            $('.list_attach').addClass('show-btn');
        }
        var _lastimg = $('.dandev_attach_view li').last().find('input[type="file"]').val();
        let key = $('.dandev_attach_view li').last().find('input[type="file"]').attr('data-key');

        if (_lastimg != '' || key) {
            var d = new Date();
            var _time = d.getTime();
            var _html = '<li id="li_files_' + _time + '" class="li_file_hide">';
            _html += '<div class="img-wrap">';
            _html += '<span class="close" onclick="DelImg(this)">×</span>';
            _html += ' <div class="img-wrap-box"></div>';
            _html += '</div>';
            _html += '<div class="' + _time + '">';
            _html += '<input type="file" class="hidden"  onchange="uploadImg(this)" id="files_' + _time + '" name="files_' + _time + '"  />';
            _html += '</div>';
            _html += '</li>';
            $('.dandev_attach_view').append(_html);
            $('.dandev_attach_view li').last().find('input[type="file"]').click();

            if ($('.dandev_attach_view').children().length >= 6) {
                $('.list_attach').find('.dandev_insert_attach').addClass('d-none');
            }
        } else {
            if (_lastimg == '') {
                $('.dandev_attach_view li').last().find('input[type="file"]').click();
            } else {
                if ($('.list_attach').hasClass('show-btn') === true) {
                    $('.list_attach').removeClass('show-btn');
                }
            }
        }
    });
}

window.DelImg = function (el) {
    $(el).closest('li').remove();

    if ($('.dandev_attach_view').children().length <= 5) {
        $('.list_attach').find('.dandev_insert_attach').removeClass('d-none');
    }
}

window.uploadImg = function (el) {
    var file_data = $(el).prop('files')[0];
    var type = file_data.type;
    var fileToLoad = file_data;

    var fileReader = new FileReader();

    fileReader.onload = function(fileLoadedEvent) {
        var srcData = fileLoadedEvent.target.result;

        var newImage = document.createElement('img');
        newImage.src = srcData;
        var _li = $(el).closest('li');
        if (_li.hasClass('li_file_hide')) {
            _li.removeClass('li_file_hide');
        }
        _li.find('.img-wrap-box').append(newImage.outerHTML);
    }
    fileReader.onerror = function (e) {
        console.log(e);
    }
    fileReader.readAsDataURL(fileToLoad);

}

