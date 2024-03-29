const mix = require('laravel-mix');
const server_resources_path = 'Packages/Server/Resources/skydash'
const client_resources_path = 'Packages/Client/Resources/skydash'
const server_resources_custom_path = 'Packages/Server/Resources/assets'
const client_resources_custom_path = 'Packages/Client/Resources/assets'
const server_public_path = 'public/DoAnTotNghiep/server'
const client_public_path = 'public/DoAnTotNghiep/client'

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

mix
    .copy(server_resources_path + '/css/vertical-layout-light/style.css', server_public_path)
    .copy(server_resources_custom_path + '/images/', server_public_path + '/assets/images/')

mix
    .sass(server_resources_custom_path + '/sass/app.scss', server_public_path + '/css/app.css')
    .sass(server_resources_custom_path + '/sass/product.scss', server_public_path + '/css/product.css')
    .sass(server_resources_custom_path + '/sass/modal/modal.scss', server_public_path + '/css/modal/modal.css')
    .sass(server_resources_custom_path + '/sass/auth/login.scss', server_public_path + '/css/auth/login.css')
    .sass(client_resources_custom_path + '/sass/profile.scss', client_public_path + '/assets/css/profile.css')

mix
    .js(server_resources_custom_path + '/js/brand/brand.js', server_public_path + '/assets/js/brand/brand.js')

    .js(server_resources_custom_path + '/js/category/category.js', server_public_path + '/assets/js/category/category.js')
    .js(server_resources_custom_path + '/js/customer/customer.js', server_public_path + '/assets/js/customer/customer.js')

    .js(server_resources_custom_path + '/js/profiler/profiler.js', server_public_path + '/assets/js/profiler/profiler.js')

    .js(server_resources_custom_path + '/js/option/option.js', server_public_path + '/assets/js/option/option.js')
    .js(server_resources_custom_path + '/js/option/create_option.js', server_public_path + '/assets/js/option/create_option.js')
    .js(server_resources_custom_path + '/js/option/create_option_group.js', server_public_path + '/assets/js/option/create_option_group.js')

    .js(server_resources_custom_path + '/js/property/property.js', server_public_path + '/assets/js/property/property.js')
    .js(server_resources_custom_path + '/js/property/create_property_group.js', server_public_path + '/assets/js/property/create_property_group.js')
    .js(server_resources_custom_path + '/js/property/create_property.js', server_public_path + '/assets/js/property/create_property.js')

    .js(server_resources_custom_path + '/js/product/product.js', server_public_path + '/assets/js/product/product.js')
    .js(server_resources_custom_path + '/js/product/product_create.js', server_public_path + '/assets/js/product/product_create.js')
    .js(server_resources_custom_path + '/js/product/edit_product.js', server_public_path + '/assets/js/product/edit_product.js')
    .js(server_resources_custom_path + '/js/product/edit_product_variant.js', server_public_path + '/assets/js/product/edit_product_variant.js')

    .js(client_resources_custom_path + '/js/app.js', client_public_path + '/assets/js/app.js')
    .js(client_resources_custom_path + '/js/search.js', client_public_path + '/assets/js/search.js')
    .js(client_resources_custom_path + '/js/login.js', client_public_path + '/assets/js/login.js')
    .js(client_resources_custom_path + '/js/signup.js', client_public_path + '/assets/js/signup.js')
    .js(client_resources_custom_path + '/js/product_detail.js', client_public_path + '/assets/js/product_detail.js')
    .js(client_resources_custom_path + '/js/cart.js', client_public_path + '/assets/js/cart.js')

    .js(client_resources_custom_path + '/js/profile.js', client_public_path + '/assets/js/profile.js')
    .js(client_resources_custom_path + '/js/checkout.js', client_public_path + '/assets/js/checkout.js')

    .js(server_resources_custom_path + '/js/order/order.js', server_public_path + '/assets/js/order/order.js')
    .js(server_resources_custom_path + '/js/statistic.js', server_public_path + '/assets/js/statistic.js')

    .js(server_resources_custom_path + '/js/export/export.js', server_public_path + '/assets/js/export/export.js')

    .js(server_resources_custom_path + '/js/user/user.js', server_public_path + '/assets/js/user/user.js')
    .js(server_resources_custom_path + '/js/tablesort.js', server_public_path + '/js/tablesort.js')
