import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;
let errorMessage = 'Lỗi: ';

let currentStep = 1;
let maxStep = 2;
import ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';

let formElement = $('.form-mutiple-step');

$(document).ready(function () {
    nextPrev();
    uploadMutipleImage();
    console.log($('.wysiwyg'));
    ClassicEditor
        .create(document.getElementById('product_description'), {
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
            placeholder: 'Thêm mô tả sản phẩm',
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
        })
        .catch(error => {
            console.log(`error`, error)
        });

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
    ClassicEditor
        .create(document.getElementById('product_feature'), {
            toolbar: ['bold', 'italic', 'bulletedList', 'numberedList',  'undo', 'redo', ],
            placeholder: 'Describe your product variant',
            fontSize: {
                options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                supportAllValues: true
            },
        })
        .catch(error => {
            console.log(`error`, error)
        });
})

function openStep(openStep = 1) {
    if (openStep > maxStep || openStep <= 0) {
        return;
    }
    if (openStep == maxStep && !checkMove()) {
        return;
    }

    currentStep = openStep;

    if (currentStep === 1) {
        $('.previous-button').addClass('disabled');
        $('.next-button').removeClass('disabled');
        $('.close-button').removeClass('d-none');
        $('.submit-button').addClass('d-none');
    } else if (currentStep === maxStep) {
        $('.previous-button').removeClass('disabled');
        $('.next-button').addClass('disabled');
        $('.close-button').addClass('d-none');
        $('.submit-button').removeClass('d-none');
    } else {
        $('.previous-button').removeClass('disabled');
        $('.next-button').removeClass('disabled');
        $('.close-button').removeClass('d-none');
        $('.submit-button').addClass('d-none');
    }

    let selectClass = 'step-' + currentStep;
    $('li[class*="step"]').removeClass('is-active');
    $(formElement).removeClass('step-1 step-2 step-3');
    $('.' + selectClass).addClass('is-active');
    $(formElement).addClass(selectClass);
}

function nextPrev() {
    $(document).on('click', '.previous-button', function () {
        openStep(currentStep - 1);
    })

    $(document).on('click', '.next-button', function () {
        openStep(currentStep + 1);
    })
}

function checkMove() {
    let status = true;
    if (currentStep == 1) {
        if ($('#product_select_create_option').val() == 0) {
            if (!$('#product_select_product').val()) {
                toastr.error(errorMessage + 'Chọn sản phẩm để tiếp tục');
                status = false;
            }
        } else if ($('#product_select_create_option').val() == 1) {
            if (!$('#id_brand').val()) {
                toastr.error(errorMessage + 'Chọn nhãn hàng để tiếp tục');
                status = false;
            } else if (!$('#id_category').val()) {
                toastr.error(errorMessage + 'Chọn loại giày để tiếp tục');
                status = false;
            }
            if (!$('#product_name').val()) {
                toastr.error(errorMessage + 'Nhập tên sản phẩm để tiếp tục');
                status = false;
            } else if (!$('#product_price').val() || !isNumeric($('#product_price').val())) {
                toastr.error(errorMessage + 'Nhập giá tiền để tiếp tục.');
                status = false;
            }
            if ($('#product_discount').is(':checked')) {
                if (!$('#product_discount_percent').val() || !isNumeric($('#product_discount_percent').val())) {
                    if (parseFloat($('#product_discount_percent').val()) >= 100 && parseFloat($('#product_discount_percent').val()) < 0) {
                        toastr.error(errorMessage + 'Giảm giá (%) không hợp lệ');
                        status = false;
                    }
                    status = true;
                } else if (!$('#product_start_discount').val() || !$('#product_end_discount').val()) {
                    toastr.error(errorMessage + 'Chọn thời gian bắt đầu và thời gian kết thúc để tiếp tục');
                    status = false;
                }
            }
        } else {
            toastr.error(errorMessage + 'Chọn tùy chọn để tiếp tục');
            status = false;
        }
    }
    if (currentStep == 2) {
        if (!$('#product_variant_count').val() || !isNumeric($('#product_variant_count').val())) {
            toastr.error(errorMessage + 'Chọn biến thể sản phẩm để tiếp tục');
            status = false;
        }
        if ($('#product_variant_discount').is(':checked')) {
            if (!$('#product_variant_discount_percent').val() || !isNumeric($('#product_variant_discount_percent').val())) {
                toastr.error(errorMessage + 'Giảm giá (%) không thành công.');
                status = false;
            } else if (!$('#product_variant_start_discount').val() || !$('#product_variant_end_discount').val()) {
                toastr.error(errorMessage + 'Chọn thời gian bắt đầu và thời gian kết thúc để tiếp tục.');
                status = false;
            }
        }
        if (!$("[name='product_variant_image[]']").val()) {
            toastr.error(errorMessage + 'Thêm ảnh đại diện để tiếp tục');
            status = false;
        }
        if (('.dandev_attach_view').children().length == 0) {
            toastr.error(errorMessage + 'Thêm ảnh sản phẩm để tiếp tục');
            status = false;
        }
    }

    if (status == false) {
        return false;
    } else {
        return true;
    }
}

function checkBeforeSubmit() {
    return checkMove();
}

$('.submit-button').on('submit', function (e) {
    if (!checkBeforeSubmit()) {
        e.preventDefault();
        toastr.error('Có lỗi bất ngờ xảy ra!');
    }
})

$('#product_discount').change(function() {
    if(this.checked) {
        $('.product_detail').removeClass('d-none');
    } else {
        $('.product_detail').addClass('d-none');
    }
});

$('#product_variant_discount').change(function() {
    if(this.checked) {
        $('.product_variant_detail').removeClass('d-none');
    } else {
        $('.product_variant_detail').addClass('d-none');
    }
});

$('#product_select_create_option').on('change', function () {
    if ($(this).val() == 1) {
        $('.create-product').removeClass('d-none');
        $('.select-product').addClass('d-none');
    } else if ($(this).val() == 0) {
        $('.create-product').addClass('d-none');
        $('.select-product').removeClass('d-none');
    } else {
        $('.create-product').addClass('d-none');
        $('.select-product').addClass('d-none');
    }

})


function uploadMutipleImage() {
    $('.dandev_insert_attach').click(function() {
        if ($('.dandev_attach_view').children().length >= 6) {
            return;
        }
        if ($('.list_attach').hasClass('show-btn') === false) {
            $('.list_attach').addClass('show-btn');
        }
        var _lastimg = $('.dandev_attach_view li').last().find('input[type="file"]').val();

        if (_lastimg != '') {
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

function isNumeric(value) {
    return /^-?\d*(\.\d+)?$/.test(value);
}

