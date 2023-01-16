import {ajaxWithCsrf} from "./app";

let errorMessage = 'Lỗi: ';

let params = {
    'id': '',
    'quantity': 0,
}

let product_variant_data = JSON.parse($('#product_data').val());
let current = JSON.parse($('#currentChoose').val());
let current_params = {
    color: current.color,
    size: null,
    width: null,
}
let default_description = '';
let default_price = ''
let ih = -1;
let ih_bonus = -1;
let sc = -1;
let sc_bonus = -1;

$(document).ready(function () {
    $('.btn-add-cart').on('click', function () {
        addCart();
    });

    let suit_size = [];
    let suit_width = [];
    for(let i = 0; i < product_variant_data.length; i++)  {
        if (
            product_variant_data[i].color == current_params.color
        ) {
            suit_size = suit_size + product_variant_data[i].size;
            suit_width = suit_width + product_variant_data[i].width;
        }
    }
    let button_size = $('.select_size').find('button');
    for( let button_size_item of button_size ) {
        if (!suit_size.includes($(button_size_item).attr('value'))) {
            $(button_size_item).addClass('disabled');
        }
    }
    let button_width = $('.select_width').find('button');
    for( let button_width_item of button_width ) {
        if (!suit_width.includes($(button_width_item).attr('value'))) {
            $(button_width_item).addClass('disabled');
        }
    }

    $('.small-image-list').on('click', '.single-small-image a', function () {
        let this_id = $(this).attr('id');
        $('[id*=product-tab-0]:not(#' +  this_id + ')').removeClass('active');
    })

})

function addCart() {
    let url = $('#add_cart').val();
    params.id = $('.btn-add-cart').attr('data-id');
    params.quantity = $('#qty_number').val();
    params.ih = ih;
    params.sc = sc;
    params.ih_bonus = ih_bonus;
    params.sc_bonus = sc_bonus;

    if (!params.quantity || params.quantity <= 0) {
        toastr.error(errorMessage + 'Số lượng không phù hợp');
        return;
    }

    if (!current_params.color || !current_params.width || !current_params.size) {
        toastr.error(errorMessage + 'Vui lòng chọn đầy đủ màu sắc và độ rộng và kích cỡ để tiếp tục.');
        return;
    }

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status === true) {
            toastr.success('Thêm giỏ hàng thành công:')
        } else {
            toastr.error(errorMessage + res.data.errorMessage)
        }
    }, 'Có lỗi bất ngờ xảy ra.')
}

/**
 * Choose size
 */
$(document).on('click', '.select_size .btn:not(.btn-outline-dark)', function (e) {
    if ($(this).hasClass('disabled')) return;
    current_params.size = $(this).text();
    $('.select_size').find('.btn').removeClass('btn-outline-dark');
    $(this).addClass('btn-outline-dark');
    sizeFindData()
    updateData();
    e.preventDefault()
})

$(document).on('click', '.select_size .btn.btn-outline-dark', function () {
    $(this).removeClass('btn-outline-dark');
    current_params.size = null;
    withourSizeFindData();
})

$(document).on('click', '.ih-options button', function (e) {
    if ($(this).hasClass('btn-outline-dark')) {
        $('.ih-options button').removeClass('btn-outline-dark');
        $('.regular-price').text(parseFloat($('.regular-price').text().split('$')) - parseFloat($(this).attr('data-bonus')) + '$')
        return;
    }
    $('.ih-options button').removeClass('btn-outline-dark');
    $('.regular-price').text(parseFloat($('.regular-price').text().split('$')) + parseFloat($(this).attr('data-bonus')) + '$')
    $(this).addClass('btn-outline-dark');
    ih = $(this).attr('data-ih');
    ih_bonus = $(this).attr('data-bonus');
})

$(document).on('click', '.sc-options button', function (e) {
    if ($(this).hasClass('btn-outline-dark')) {
        $('.sc-options button').removeClass('btn-outline-dark');
        $('.regular-price').text(parseFloat($('.regular-price').text().split('$')) - parseFloat($(this).attr('data-bonus')) + '$')
        return;
    }
    $('.sc-options button').removeClass('btn-outline-dark');
    $('.regular-price').text(parseFloat($('.regular-price').text().split('$')) + parseFloat($(this).attr('data-bonus')) + '$')
    $(this).addClass('btn-outline-dark');
    sc = $(this).attr('data-sc');
    sc_bonus = $(this).attr('data-bonus');
})

function sizeFindData() {
    let suitable_prod = [];
    let suit_width = [], suit_color = [];
    let j = 0;
    for(let i = 0; i < product_variant_data.length; i++)  {
        if (current_params.size && product_variant_data[i].size != current_params.size) {
            continue;
        }
        if (current_params.width && product_variant_data[i].width != current_params.width) {
            continue;
        }
        suit_color = suit_color + product_variant_data[i].color;
        if (
            product_variant_data[i].color == current_params.color &&
            product_variant_data[i].size == current_params.size
        ) {
            suit_width = suit_width + product_variant_data[i].width
        }
    }

    console.log(current_params);
    console.log(product_variant_data);

    let button_color = $('.select_color').find('button');
    for( let button_color_item of button_color ) {
        if (!suit_color.includes($(button_color_item).attr('value'))) {
            $(button_color_item).addClass('disabled');
        } else {
            $(button_color_item).removeClass('disabled');
        }
    }
    let button_width = $('.select_width').find('button');
    for( let button_width_item of button_width ) {
        if (!suit_width.includes($(button_width_item).attr('value'))) {
            $(button_width_item).addClass('disabled');
        } else {
            $(button_width_item).removeClass('disabled');
        }
    }
}

function withourSizeFindData() {
    updateWithoutData();
    let suitable_prod = [];
    let j = 0;
    let suit_color = [];
    let suit_width = [];
    for(let i = 0; i < product_variant_data.length; i++)  {
        if (current_params.size && product_variant_data[i].size != current_params.size) {
            continue;
        }
        // if (current_params.width && product_variant_data[i].width != current_params.width) {
        //     continue;
        // }
        suit_color = suit_color + product_variant_data[i].color;
        if (
            product_variant_data[i].color == current_params.color
        ) {
            suit_width = suit_width + product_variant_data[i].width
        }
    }

    console.log(current_params);
    console.log(product_variant_data);
    console.log(JSON.stringify(suitable_prod));

    let button_color = $('.select_color').find('button');
    for( let button_color_item of button_color ) {
        if (!suit_color.includes($(button_color_item).attr('value'))) {
            $(button_color_item).addClass('disabled');
        } else {
            $(button_color_item).removeClass('disabled');
        }
    }
    let button_width = $('.select_width').find('button');
    for( let button_width_item of button_width ) {
        if (!suit_width.includes($(button_width_item).attr('value'))) {
            $(button_width_item).addClass('disabled');
        } else {
            $(button_width_item).removeClass('disabled');
        }
    }
}

/**
 * Choose color
 */
$(document).on('click', '.select_color .btn:not(.btn-outline-dark)', function (e) {
    if ($(this).hasClass('disabled')) return;
    current_params.color = $(this).text();
    $('.select_color').find('.btn').removeClass('btn-outline-dark');
    $(this).addClass('btn-outline-dark');
    colorFindData()
    updateData();
    changeImage();
    e.preventDefault()
})

function colorFindData() {
    let suitable_prod = [];
    let j = 0;
    for(let i = 0; i < product_variant_data.length; i++)  {
        if (current_params.size && product_variant_data[i].size != current_params.size) {
            continue;
        }
        if (current_params.width && product_variant_data[i].width != current_params.width) {
            continue;
        }
        if (
            product_variant_data[i].color == current_params.color
        ) {
            suitable_prod[j++] = product_variant_data[i];
        }
    }

    console.log(current_params);
    console.log(product_variant_data);
    console.log((suitable_prod));

    let suit_color = [];
    let suit_width = [];
    let suit_size = [];
    for(let i = 0; i < suitable_prod.length; i++)  {
        suit_color = suit_color + suitable_prod[i].color;
        suit_width = suit_width + suitable_prod[i].width;
        suit_size = suit_size + suitable_prod[i].size;
    }

    let button_width = $('.select_width').find('button');
    for( let button_width_item of button_width ) {
        if (!suit_width.includes($(button_width_item).attr('value'))) {
            $(button_width_item).addClass('disabled');
        } else {
            $(button_width_item).removeClass('disabled');
        }
    }
    let button_size = $('.select_size').find('button');
    for( let button_size_item of button_size ) {
        if (!suit_size.includes($(button_size_item).attr('value'))) {
            $(button_size_item).addClass('disabled');
        } else {
            $(button_size_item).removeClass('disabled');
        }
    }
}

function changeImage() {
    let product_variant_image_data;
    for(let i = 0; i < product_variant_data.length; i++) {
        if (product_variant_data[i].color == current_params.color) {
            product_variant_image_data = product_variant_data[i];
            break;
        }
    }
    if (product_variant_image_data.image.length) {
        $('.product-large-image').children().not(':last').remove();
        $('.owl-stage').children().remove();
        let index = 0;
        product_variant_image_data.image.forEach((image) => {
            let id = 'product-0' + index;
            $('.product-large-image').prepend($('.default-image #product-0xxx').clone().attr('id', id));
            $('#' + id).attr('aria-labelledby', 'product-tab-0' + index);
            $('#' + id).find('a img').attr('src', $('#imageURL').val() + '/' + image.name);
            $('#' + id).find('.zoomImg').attr('src', $('#imageURL').val() + '/' + image.name);

            let tab_id = 'product-tab-0' + index;
            let element = $('.small-image-list .owl-stage-outer .owl-stage').prepend($('.default-small-image .owl-item').clone().attr('id', 'pd-0' + index));
            $('#pd-0' + index).find('a').attr('id', 'product-tab-0' + index);

            $('#' + tab_id).attr('href', '#product-0' + index);
            $('#' + tab_id).find('img').attr('src', $('#imageURL').val() + '/' + image.name);
            $('#' + tab_id).closest('.owl-item').addClass('active');


            if (index == 0) {
                $('#' + id).addClass('active show');
            }
            index++;
        })
    }

}


/**
 * Choose width
 */
$(document).on('click', '.select_width .btn:not(.btn-outline-dark)', function (e) {
    if ($(this).hasClass('disabled')) return;
    current_params.width = $(this).text();
    $('.select_width').find('.btn').removeClass('btn-outline-dark');
    $(this).addClass('btn-outline-dark');
    widthFindData()
    updateData();
    e.preventDefault()
})

$(document).on('click', '.select_width .btn.btn-outline-dark', function () {
    $(this).removeClass('btn-outline-dark');
    current_params.width = null;
    updateWithoutData();
    withoutWidthFindData();
})

function widthFindData() {
    let suitable_prod = [];
    let suit_color = [], suit_size = [];
    let j = 0;
    for(let i = 0; i < product_variant_data.length; i++)  {
        if (current_params.size && product_variant_data[i].size != current_params.size) {
            continue;
        }
        if (current_params.width && product_variant_data[i].width != current_params.width) {
            continue;
        }
        suit_color = suit_color + product_variant_data[i].color;
        if (
            product_variant_data[i].color == current_params.color
        ) {
            suit_size = suit_size + product_variant_data[i].size
        }
    }

    console.log(current_params);
    console.log(product_variant_data);
    console.log(JSON.stringify(suitable_prod));

    let button_color = $('.select_color').find('button');
    for( let button_color_item of button_color ) {
        if (!suit_color.includes($(button_color_item).attr('value'))) {
            $(button_color_item).addClass('disabled');
        } else {
            $(button_color_item).removeClass('disabled');
        }
    }
    let button_size = $('.select_size').find('button');
    for( let button_size_item of button_size ) {
        if (!suit_size.includes($(button_size_item).attr('value'))) {
            $(button_size_item).addClass('disabled');
        } else {
            $(button_size_item).removeClass('disabled');
        }
    }
}

function withoutWidthFindData() {
    let j = 0;
    let suit_color = [];
    let suit_size = [];
    for(let i = 0; i < product_variant_data.length; i++)  {
        // if (current_params.size && product_variant_data[i].size != current_params.size) {
        //     continue;
        // }
        if (current_params.width && product_variant_data[i].width != current_params.width) {
            continue;
        }
        suit_color = suit_color + product_variant_data[i].color;
        if (
            product_variant_data[i].color == current_params.color
        ) {
            suit_size = suit_size + product_variant_data[i].size
        }
    }

    console.log(current_params);
    console.log(product_variant_data);
    console.log(JSON.stringify(suit_size));

    let button_color = $('.select_color').find('button');
    for( let button_color_item of button_color ) {
        if (!suit_color.includes($(button_color_item).attr('value'))) {
            $(button_color_item).addClass('disabled');
        } else {
            $(button_color_item).removeClass('disabled');
        }
    }
    let button_size = $('.select_size').find('button');
    for( let button_size_item of button_size ) {
        if (!suit_size.includes($(button_size_item).attr('value'))) {
            $(button_size_item).addClass('disabled');
        } else {
            $(button_size_item).removeClass('disabled');
        }
    }
}

function updateData() {
    if (current_params.size && current_params.color && current_params.width) {
        let item;
        for(let i = 0; i < product_variant_data.length; i++)  {
            console.log(product_variant_data[i]);
            if (i==0) {
                default_description = product_variant_data[i].description;
            }

            if (
                product_variant_data[i].color == current_params.color &&
                product_variant_data[i].size == current_params.size &&
                product_variant_data[i].width == current_params.width
            ) {
                item = product_variant_data[i];
            }
        }

        if (item.discount == 0 || Date.parse(item.end_at) >= (new Date).getTime()) {
            $('.sales .sales_discount').text(item.discount + '%');
            $('.regular-price').text(
                ((100 - item.discount) * $('#prod_price').val() / 100).toFixed(3) + '$');
        }

        default_price = $('.regular-price').text().split('$')[0];
        $('.description').html('');
        console.log(item);
        if (item.pv_description && item.pv_description != '') {
            $('.description').append(item.pv_description);
        }
        if (item.insole_height) {
            $('.select_insole_height').html('');
            item.insole_height.forEach((ih) => {
                let e_clone = $('.default_insole_height_element').clone();
                e_clone.removeClass('default_insole_height_element d-none');
                $('.ih-options').removeClass('d-none');
                e_clone.attr('data-ih' , ih.value);
                e_clone.attr('id', 'ih_' + ih.value);
                e_clone.attr('data-bonus',ih.bonus);
                e_clone.text(ih.value + 'cm');
                e_clone.appendTo('.select_insole_height')
                $('.select_insole_height').removeClass('d-none');
                $('.ih-options').removeClass('d-none');
                $('.ih-options').addClass('d-flex');
            })
        }
        if (item.shoelace_color) {
            $('.select_shoeslace_color').html('');
            item.shoelace_color.forEach((sc) => {
                let e_clone = $('.default_shoeslace_color_element').clone();
                e_clone.removeClass('default_shoeslace_color_element d-none');
                $('.sc-options').removeClass('d-none');
                e_clone.attr('data-sc' , sc.value);
                e_clone.attr('id', 'sc_' + sc.value);
                e_clone.attr('data-bonus', sc.bonus);
                e_clone.text(sc.value);
                e_clone.appendTo('.select_shoeslace_color')
                $('.select_shoeslace_color').removeClass('d-none');
                $('.sc-options').removeClass('d-none');
                $('.sc-options').addClass('d-flex');
            })
        }
        $('.btn-add-cart').attr('data-id', item.id);
    }
}

function updateWithoutData () {
    $('.ih-options').addClass('d-none');
    $('.sc-options').addClass('d-none');
    $('.ih-options').removeClass('d-flex');
    $('.sc-options').removeClass('d-flex');

    if (default_description != '') {
        $('.description').html('');
        $('.description').append(default_description);
    }
}


