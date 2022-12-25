import {ajaxWithCsrf} from "../app";
toastr.options.timeOut = 5000;
let errorMessage = 'Message Error: ';

import ClassicEditor from '@ckeditor/ckeditor5-build-classic/build/ckeditor';


$(document).ready(function () {
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
            placeholder: 'Describe your product',
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

$('.btn-submit').on('click', function (e) {
    let status = true;
    if (!$('#id_brand').val()) {
        toastr.error(errorMessage + 'Select brand to continue');
        status = false;
    } else if (!$('#id_category').val()) {
        toastr.error(errorMessage + 'Select category to continue');
        status = false;
    }
    if (!$('#product_name').val()) {
        toastr.error(errorMessage + 'Select category to continue');
        status = false;
    } else if (!$('#product_price').val() || !isNumeric($('#product_price').val())) {
        toastr.error(errorMessage + 'Fill valid price to continue');
        status = false;
    }
    if ($('#product_discount').is(':checked')) {
        if (!$('#product_discount_percent').val() || !isNumeric($('#product_discount_percent').val())) {
            if (parseFloat($('#product_discount_percent').val()) >= 100 || parseFloat($('#product_discount_percent').val()) < 0) {
                toastr.error(errorMessage + 'Fill valid discount percent to continue.');
                status = false;
            }
        } else if (!$('#product_start_discount').val() || !$('#product_end_discount').val()) {
            toastr.error(errorMessage + 'Select discount time to continue');
            status = false;
        } else if (isNumeric($('#product_price').val())) {
            if (parseFloat($('#product_discount_percent').val()) >= 100 || parseFloat($('#product_discount_percent').val()) < 0) {
                toastr.error(errorMessage + 'Fill valid discount percent to continue.');
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

$('#product_discount').change(function() {
    if(this.checked) {
        $('.product_detail').removeClass('d-none');
    } else {
        $('.product_detail').addClass('d-none');
    }
});

function isNumeric(value) {
    return /^-?\d*(\.\d+)?$/.test(value);
}
