$(document).ready(function ($) {
    anrDataRequired();
	
    $('#updateFrm').submit(function () {
        if (!$('#CustomerPONo').hasClass('disabled') && $('#CustomerPONo').val() == '') {
            showNoti('Customer PO No not empty!', 'Error', 'Err');
            if ($('#info-order').hasClass('in')) {
                $('#CustomerPONo').select2('open');
            }
            return false;
        }
    });
    $('body').on('click', '#Director', function () {

        //var Director1=0;
        var name = $(this).data('name');
        var id = $(this).data('id');
        var user = $(this).data('user');
        var month = $(this).data('month');
        //console.log(id);
        // console.log(parseFloat(string));

        $.alerts.confirm('Are you sure you confirm this item? Successfully confirming the system will lock the system cannot be adjusted. Please double check before doing, Thanks !!!<br />', 'Confirm ', function (r) {
            if (r == "a") {
                $.ajax({
                    url: site_url + $('#act').val() + '/director',
                    type: 'POST',
                    cache: false,
                    data: {id: id, type: 3},
                    success: function (string) {
                        $('#updateFrm').submit();
                        location.reload();

                    }
                })
            } else if (r == true) {
                $.ajax({
                    url: site_url + $('#act').val() + '/director',
                    type: 'POST',
                    cache: false,
                    data: {id: id, type: 1},
                    success: function (string) {

                        $('#updateFrm').submit();
                    }
                })

            }
            /*   if (r == true) {
                $.ajax({
                   url: site_url + $('#act').val() + '/director',
                   type: 'POST',
                   cache: false,
                   data: { id: id },
                   success: function(string) {

                   $('#updateFrm').submit();
               }})
           }*/

        });
    }).on('click', '#Leader', function () {
        var PrepareBy1 = 0;
        var name = $(this).data('name');
        var id = $(this).data('id');
        var user = $(this).data('user');
        $.alerts.confirm('Are you sure you confirm this item? Successfully confirming the system will lock the system cannot be adjusted. Please double check before doing, Thanks !!!<br />', 'Confirm ', function (r) {
            if (r == true) {
                $.ajax({
                    url: site_url + $('#act').val() + '/Leader',
                    type: 'POST',
                    cache: false,
                    data: {Leader: 1, id: id},
                    success: function (string) {
                        $('#updateFrm').submit();
                        location.reload();

                    }
                })
            }
        });
    }).on('click', '#PrepareBy', function () {
        //var PrepareBy1=0;
        var name = $(this).data('name');
        var id = $(this).data('id');
        var user = $(this).data('user');
        $.alerts.confirm('Are you sure you confirm this item? Successfully confirming the system will lock the system cannot be adjusted. Please double check before doing, Thanks !!!<br />', 'Confirm ', function (r) {
            if (r == true) {
                $.ajax({
                    url: site_url + $('#act').val() + '/PrepareBy',
                    type: 'POST',
                    cache: false,
                    data: {PrepareBy: 1, id: id},
                    success: function (string) {
                        $('#updateFrm').submit();
                        location.reload();

                    }
                })
            }
        });
    }).on('click', '#Manager', function () {
        var Manager1 = 0;
        var name = $(this).data('name');
        var id = $(this).data('id');
        var user = $(this).data('user');
        $.alerts.confirm('Are you sure you confirm this item? Successfully confirming the system will lock the system cannot be adjusted. Please double check before doing, Thanks  !!!<br />', 'Confirm ', function (r) {
            if (r == true) {
                $.ajax({
                    url: site_url + $('#act').val() + '/Manager',
                    type: 'POST',
                    cache: false,
                    data: {Manager: 1, id: id},
                    success: function (string) {
                        $('#updateFrm').submit();
                    }
                })
            }
        });
    }).on('change', '.order-qty', function () {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var UnitPriceUSD = $('[name="USDExchangeRate"]').val().replace(/\s/g, '').replace(/,/g, '');
        var e = $(this).parent().parent();
        $(this).val(accounting.formatMoney(val, '', 0));
        //console.log(val);

        var priceUSD = e.find('.unit-price-usd').val();
        var priceVND = priceUSD * UnitPriceUSD;
        var sumShipped = 0;
        e.find('.unit-price-usd').val(accounting.formatMoney(priceUSD, '', 2));
        e.find('.unit-price-vnd').val(accounting.formatMoney(priceVND, '', 0));
        updateDatayc(e);
    }).on('change', '.unit-price-usd', function () {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var UnitPriceUSD = $('[name="USDExchangeRate"]').val().replace(/\s/g, '').replace(/,/g, '');
        var e = $(this).parent().parent();
        $(this).val(accounting.formatMoney(val, '', 2));
        //console.log(val);
        e.find('.unit-price-vnd').val(accounting.formatMoney(val * UnitPriceUSD, '', 0));
        updateDatayc(e);
    }).on('change', '.unit-price-vnd', function () {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var UnitPriceUSD = $('[name="USDExchangeRate"]').val().replace(/\s/g, '').replace(/,/g, '');
        var e = $(this).parent().parent();
        //$(this).val(accounting.formatMoney(val, '', 4));
        // e.find('.unit-price-usd').val(accounting.formatMoney(val/, '', 4));
        e.find('.unit-price-usd').val(accounting.formatMoney(val / UnitPriceUSD, '', 2));
        updateDatayc(e);

        // e.find('.unit-price-usd').val(accounting.formatMoney(val/UnitPriceUSD, '', 4));

    }).on('change', '.vat', function () {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var UnitPriceUSD = $('[name="USDExchangeRate"]').val().replace(/\s/g, '').replace(/,/g, '');
        var e = $(this).parent().parent();

        //$(this).val(accounting.formatMoney(val, '', 4));
        // e.find('.unit-price-usd').val(accounting.formatMoney(val/, '', 4));
        //	 e.find('.unit-price-usd').val(accounting.formatMoney(val/UnitPriceUSD, '', 4));
        updateDatayc(e);

        // e.find('.unit-price-usd').val(accounting.formatMoney(val/UnitPriceUSD, '', 4));

    }).on('change', '.amout-vatvnd', function () {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var UnitPriceUSD = $('[name="USDExchangeRate"]').val().replace(/\s/g, '').replace(/,/g, '');
        var e = $(this).parent().parent();
        var amountvnd = e.find('.amount-vnd').val();
        e.find('.amout-vatvnd').val(accounting.formatMoney(val, '', 0));
        e.find('.amout-vatusd').val(accounting.formatMoney(val / UnitPriceUSD, '', 4));
        e.find('.vat').val((val / Number(amountvnd.replace(/\s/g, '').replace(/,/g, '')) * 100).toFixed(4));
        updateDataSum();

        //	 e.find('.unit-price-usd').val(accounting.formatMoney(val/UnitPriceUSD, '', 4));
        // updateDatayc(e);

        // e.find('.unit-price-usd').val(accounting.formatMoney(val/UnitPriceUSD, '', 4));

    }).on('click', '.delete-file-in-update', function () {
        var parent = $(this).closest('tr');
        var file = parent.data('file');
        var table = $(this).data('table');
        var dir = $(this).data('dir');
        $.alerts.confirm('Will you delete ' + file + ' file?', 'Alert', function (e) {
            if (e) {
                var id = parent.data('id');
                parent.remove();
                $.ajax({
                    url: site_url + $('#act').val() + '/delete_file_in_update',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id,
                        file: file,
                        table: table,
                        dir: dir
                    },
                    success: function (string) {
                        if (string == 0) {
                            showNoti('Fail', 'Error', 'Err');
                            return false;
                        } else {
                            showNoti('Deleted ' + file + ' file success.', 'Success', 'Ok');
                            parent.remove();
                        }
                    }
                })
            }
        })
        return false;
    });

});

/* # Ready */


function updateDatayc(e) {
    var Orqty = parseFloat(e.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
    console.log(123);

    /* if (Orqty < 0) {
         Orqty = 1;
     }*/
    // var Orqty = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
    var vat1 = parseFloat(e.find('.vat').val());
    //var Orqty = parseFloat(e.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
    var priceUSD = parseFloat(e.find('.unit-price-usd').val().replace(/\s/g, '').replace(/,/g, ''));
    var priceVND = parseFloat(e.find('.unit-price-vnd').val().replace(/\s/g, '').replace(/,/g, ''));

    //console.log(vatUSD);
    var UnitPriceUSD = $('[name="USDExchangeRate"]').val().replace(/\s/g, '').replace(/,/g, '');
    var amountUSD = Orqty * priceUSD * ( 1 + vat1 / 100 );
    var UnitPriceVND = priceVND;
    var amountVND = Orqty * UnitPriceVND * ( 1 + vat1 / 100 );
    e.find('.amount-usd').val(accounting.formatMoney(amountUSD, '', 2));
    //  e.find('.unit-price-vnd').val(accounting.formatMoney(UnitPriceVND, '', 0));
    e.find('.amount-vnd').val(accounting.formatMoney(amountVND, '', 0));
    e.find('.amount-vnd-vat').val(accounting.formatMoney(amountVND, '', 0));
    // var amountUSD = parseFloat(e.find('.amount-usd').val().replace(/\s/g, '').replace(/,/g, ''));
    // var amountVND = parseFloat(e.find('.amount-vnd').val().replace(/\s/g, '').replace(/,/g, ''));

    //var vatVND = parseFloat(e.find('.unit-price-vnd').val().replace(/\s/g, '').replace(/,/g, ''));
    // var vatUSD = amountUSD * vat1 / 100;
    // var vatVND = amountVND * vat1 / 100;
    // e.find('.amout-vatusd').val(accounting.formatMoney(vatUSD, '', 2));
    // e.find('.amout-vatvnd').val(accounting.formatMoney(vatVND, '', 0));
    updateDataSum();
}

function check_exist_data() {
    var startRow = parseInt($('#headerInfo').val());
    var endRow = parseInt($('#footerInfo').val());
    var val = $('#selectMfrPartNumber').val();
    $('.divPreview .table.table-bordered tr').removeClass('excel-selected');
    $('.divPreview table tr').removeClass('exists');
    for (var j = startRow; j <= endRow; j++) {
        $('.divPreview .table.table-bordered tr:eq(' + j + ')').addClass('excel-selected');
        var part = $('.divPreview table tr:eq(' + j + ') td[data-label="' + val + '"]').text();
        if ($('input.mfr-part[value="' + part + '"]').length) {
            $('.divPreview table tr:eq(' + j + ')').addClass('exists');
            showNoti('Các dòng dữ liệu được tô đỏ đã có trong danh sách', 'Cảnh báo:', 'War');
        } else {
            $('.divPreview table tr:eq(' + j + ')').removeClass('exists');
        }
    }
}

function updateDataSum() {
    var sumTotal = 0.0;
    var sumTotalVND = 0.0;
    var total = 0.0;
    var totalVND = 0.0;
    var VAT = 0.0;
    var sumVATVND = 0.0;

    if ($('.amount-usd').length > 0) {
        $('.amount-usd').each(function () {
            sumTotal += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.amount-vnd').each(function () {
            sumTotalVND += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.amout-vatusd').each(function () {
            VAT += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
      /*  $('.amout-vatvnd').each(function () {
            sumVATVND += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });*/
       // $('#SubTotalVND').val(accounting.formatMoney(sumTotalVND, '', 0));
      //  $('#SubTotalUSD').val(accounting.formatMoney(sumTotal, '', 2));
       // $('.vat-vnd').val(accounting.formatMoney(sumVATVND, '', 0));
       // $('#VATTaxUSD').val(accounting.formatMoney(VAT, '', 2));
        total = sumTotal + VAT;
        totalVND = sumTotalVND + sumVATVND;
        $('#TotalVND').val(accounting.formatMoney(totalVND, '', 0));
        $('#TotalUSD').val(accounting.formatMoney(total, '', 2));
    } else {
       /* $('#SubTotalUSD').val(accounting.formatMoney(0, '', 2));
       // $('#SubTotalVND').val(0);
       // $('#VATTaxUSD').val(accounting.formatMoney(0, '', 2));
        $('#ShippingChargesUSD').val(accounting.formatMoney(0, '', 2));
        $('#ShippingChargesVND').val(0);
        $('#BankChargesUSD').val(accounting.formatMoney(0, '', 2));
        $('#BankChargesVND').val(0);
        $('#TotalUSD').val(accounting.formatMoney(0, '', 2));
        $('#TotalVND').val(0);*/
    }
}

$('#VAT').bind('change', function () {
    $val = $(this).val();
    if ($val < 0 || $val > 100) {
        $(this).val(0);
    }
    updateDataSum();
    updateDataItem();
});
$('#ShippingChargesUSD').bind('change', function () {
    var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
    $(this).val(accounting.formatMoney(val, '', 4));
    $('#ShippingChargesVND').val(accounting.formatMoney(val * parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, '')), '', 0));
    updateDataSum();
    //  updateDataItem();
});
$('#ShippingChargesVND').bind('change', function () {
    var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
    $(this).val(accounting.formatMoney(val, '', 0));
    $('#ShippingChargesUSD').val(accounting.formatMoney(val / parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, '')), '', 4));
    updateDataSum();
    //  updateDataItem();
});


$('#BankChargesUSD').bind('change', function () {
    var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
    $(this).val(accounting.formatMoney(val, '', 2));
    var BankChargeVND1 = val * $('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, '');
    $('#BankChargesVND').val(accounting.formatMoney(BankChargeVND1, '', 0));
    updateDataSum();
    // updateDataItem();

});
$('#BankChargesVND').bind('change', function () {
    var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
    $(this).val(accounting.formatMoney(val, '', 0));
    var BankChargesUSD1 = val / $('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, '');
    $('#BankChargesUSD').val(accounting.formatMoney(BankChargesUSD1, '', 4));
    updateDataSum();
    // updateDataItem();
});
$('#importModal').on('show.bs.modal', function () {
    if ($('#CustomerPONo').val() == '') {
        $('#importModal').modal('hide');
        if ($('#info-order').hasClass('in')) {
            $('#CustomerPONo').select2('open');
        }
        showNoti('Customer PO No not empty', 'Error', 'War');
        return false;
    }
})
