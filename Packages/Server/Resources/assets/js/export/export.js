$(document).ready(function () {
    $('#exportDoanhThu').on('submit', function (e) {
        $('#export_month').val($('#month').val());
        $('#export_year').val($('#year').val());
    });
})
