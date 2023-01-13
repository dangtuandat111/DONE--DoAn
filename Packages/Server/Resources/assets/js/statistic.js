import {ajaxWithCsrf} from "../js/app";
toastr.options.timeOut = 5000;
let errorMessage = 'Lỗi: ';

let currentParams;
var myChart, sellChart, countChart;

$(document).ready(function () {
    $(document).find('#buttonSearch').on('click', function () {
        getData();
        getChartData();
    })

    $('.data-order-table .page-link-page').on('click', function () {
        getData($(this).attr('data-page'));
    })
    getChartData();

    $(document).find('#buttonSearchSell').on('click', function () {
        getSellData();
        getSellChartData()
    })
    $('.data-count-sell-table .page-link-page').on('click', function () {
        getSellData($(this).attr('data-page'));
    })
    getSellChartData();
    getCountData();
})

function getData(page = 1, callback) {
    let url = $('#order_post').val();
    let params = {
        'page': page,
        'perPage': $('#perPage').val(),
        'month': $('#month').val(),
        'year': $('#year').val(),
    }

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status === true) {
            $('.data-order-table').html(res.data.html);
            $('.data-order-table .page-link-page').on('click', function () {
                getData($(this).attr('data-page'));
            })
        } else {
            toastr.error( 'Không có dữ liệu cho tìm kiếm này.')
        }
    }, 'Có lỗi bất ngờ xảy ra!')
    if (callback) { callback(); }
}

function getSellData(page = 1, callback) {
    let url = $('#order_post_sell').val();
    let params = {
        'page': page,
        'perPage': $('#perPageSell').val(),
        'month': $('#monthSell').val(),
        'year': $('#yearSell').val(),
    }

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status === true) {
            $('.data-count-sell-table').html(res.data.html);
            $('.data-count-sell-table .page-link-page').on('click', function () {
                getSellData($(this).attr('data-page'));
            })
        } else {
            toastr.error( 'Không có kết quả cho tìm kiếm này!')
        }
    }, 'Có lỗi bất ngờ xảy ra!')
    if (callback) { callback(); }
}

function getChartData() {
    let url = $('#order_post_chart').val();
    let params = {
        'month': $('#month').val(),
        'year': $('#year').val(),
    }

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status === true) {
            setupChart(res.data.total, res.data.pv_name);
        } else {
            toastr.error( 'Không có kết quả cho tìm kiếm này!')
        }
    }, 'Không có dữ liệu cho biểu đồ.')
}

function setupChart(datasets, labels ) {
    $('#myChart').remove();
    $('.mychart').append("<canvas id=\"myChart\"></canvas>");
    myChart = document.getElementById('myChart').getContext('2d');
    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    let chartProd = new Chart(myChart, {
        type:'bar', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data:{
            labels:labels,
            datasets:[{
                label:'Thống kê doanh thu theo từng sản phẩm ($)',
                data:datasets,
                //backgroundColor:'green',
                backgroundColor:[
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 99, 132, 0.6)'
                ],
                borderWidth:1,
                borderColor:'#2238d7',
                hoverBorderWidth:3,
                hoverBorderColor:'#000'
            }]
        },
        options:{
            title:{
                display:true,
                text:'Doanh thu sản phẩm',
                fontSize:25
            },
            legend:{
                display:true,
                position:'right',
                labels:{
                    fontColor:'#000'
                }
            },
            layout:{
                padding:{
                    left:50,
                    right:0,
                    bottom:0,
                    top:0
                }
            },
            tooltips:{
                enabled:true
            }
        }
    });
}

function getSellChartData() {
    let url = $('#order_post_sell_chart').val();
    let params = {
        'month': $('#monthSell').val(),
        'year': $('#yearSell').val(),
    }

    ajaxWithCsrf(url, params, function processResponse(res) {
        if (res.data.status === true) {
            setupSellChart(res.data.count, res.data.pname);
        } else {
            toastr.error( 'Có lỗi bất ngờ xảy ra!')
        }
    }, 'Không có dữ liệu cho biểu đồ.')
}

function setupSellChart(datasets, labels) {
    $('#countSellChart').remove();
    $('.count-sell-chart').append("<canvas id=\"countSellChart\"></canvas>");
    sellChart = document.getElementById('countSellChart').getContext('2d');
    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    let chartProd = new Chart(sellChart, {
        type:'doughnut', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data:{
            labels:labels,
            datasets:[{
                data:datasets,
                //backgroundColor:'green',
                backgroundColor:[
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 99, 132, 0.6)'
                ],
                borderWidth:1,
                borderColor:'#2238d7',
                hoverBorderWidth:3,
                hoverBorderColor:'#000'
            }]
        },
        options:{
            title:{
                display:true,
                text:'Số lượng sản phẩm bán',
                fontSize:25
            },
            legend:{
                display:true,
                position:'right',
                labels:{
                    fontColor:'#000'
                }
            },
            layout:{
                padding:{
                    left:50,
                    right:0,
                    bottom:0,
                    top:0
                }
            },
            tooltips:{
                enabled:true
            }
        }
    });
}

function getCountData() {
    let url = $('#order_post_count_chart').val();

    ajaxWithCsrf(url, {}, function processResponse(res) {
        if (res.data.status === true) {
            console.log(res.data.pv_name)
            console.log(res.data.total)
            setupCountChart(res.data.total, res.data.pv_name);
        } else {
            toastr.error( 'Có lỗi bất ngờ xảy ra!')
        }
    }, 'Không có dữ liệu cho biểu đồ.')
}

function setupCountChart(datasets, labels) {
    $('#countChart').remove();
    $('.count-chart').append("<canvas id=\"countChart\"></canvas>");
    countChart = document.getElementById('countChart').getContext('2d');
    // Global Options
    Chart.defaults.global.defaultFontFamily = 'Lato';
    Chart.defaults.global.defaultFontSize = 18;
    Chart.defaults.global.defaultFontColor = '#777';

    let chartProd = new Chart(countChart, {
        type:'doughnut', // bar, horizontalBar, pie, line, doughnut, radar, polarArea
        data:{
            labels:labels,
            datasets:[{
                data:datasets,
                //backgroundColor:'green',
                backgroundColor:[
                    'rgba(255, 99, 132, 0.6)',
                    'rgba(54, 162, 235, 0.6)',
                    'rgba(255, 206, 86, 0.6)',
                    'rgba(75, 192, 192, 0.6)',
                    'rgba(153, 102, 255, 0.6)',
                    'rgba(255, 159, 64, 0.6)',
                    'rgba(255, 99, 132, 0.6)'
                ],
                borderWidth:1,
                borderColor:'#2238d7',
                hoverBorderWidth:3,
                hoverBorderColor:'#000'
            }]
        },
        options:{
            title:{
                display:true,
                text:'Số lượng sản phẩm trong kho',
                fontSize:25
            },
            legend:{
                display:true,
                position:'right',
                labels:{
                    fontColor:'#000'
                }
            },
            layout:{
                padding:{
                    left:50,
                    right:0,
                    bottom:0,
                    top:0
                }
            },
            tooltips:{
                enabled:true
            }
        }
    });
}

