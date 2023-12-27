$(document).ready(function($) {
    $('#submitBtn').on('click', function() {
        var flag = false;
        var customerID = $('#CustomerID').val();
        var currency = $('#Currency').val().toLowerCase();
        var total = parseFloat($('.total-' + currency).val().replace(/\s/g, '').replace(/,/g, ''));
        if ($('#id').val() == '') {
            total = parseFloat($('#RestPayment').val().replace(/\s/g, '').replace(/,/g, ''));
        }
        console.log(total);
        $.ajax({
            url: site_url + $('#act').val() + '/get_debt',
            type: 'POST',
            cache: false,
            data: {
                CustomerID: customerID,
            },
            success: function(string) {
                var getData = $.parseJSON(string);
                var curDebt = parseFloat(getData.Debt) + total;
                var debtLimit = parseFloat(getData.DebtLimit);
                if (curDebt > debtLimit) {
                    flag = true;
                }
                if (flag) {
                    $.alerts.confirm('Order value and total debt are greater than the debt limit.<br>Are you sure to create an order?', 'Confirm', function(e) {
                        if (e) {
                            $('#updateFrm').submit();
                        }
                    });
                    return false;
                }
                $('#updateFrm').submit();
            }
        })
        return false;
    });

    $('#VAT').bind('change', updateDataSum);

    $('#ShippingChargesUSD').bind('change', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var ShippingChargesVND = val * parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#ShippingChargesVND').val(accounting.formatMoney(ShippingChargesVND, '', 0));
        $(this).val(accounting.formatMoney(val, '', 4));
        updateDataSum();
    });

    $('#ShippingChargesVND').bind('change', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var ShippingChargesUSD = val / parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#ShippingChargesUSD').val(accounting.formatMoney(ShippingChargesUSD, '', 4));
        $(this).val(accounting.formatMoney(val, '', 0));
        updateDataSum();
    });

    $('#BankChargesVND').bind('change', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var BankChargesUSD = val / parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#BankChargesUSD').val(accounting.formatMoney(BankChargesUSD, '', 4));
        $(this).val(accounting.formatMoney(val, '', 0));
        updateDataSum();
    });

    $('#BankChargesUSD').bind('change', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var BankChargesVND = val * parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#BankChargesVND').val(accounting.formatMoney(BankChargesVND, '', 0));
        $(this).val(accounting.formatMoney(val, '', 4));
        updateDataSum();
    });

    updateDataSum();

    $('body').on('change', '.spqp', function(event) {
        $(this).val(accounting.formatMoney($(this).val(), '', 4));
    }).on('change', '.shipped-qty', function() {
        if ($(this).val() > 0) {
            var thisShipped = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
            var e = $(this).closest('tr');
            var sumShipped = 0;
            var Orqty = parseFloat(e.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
            $(e.find('.shipped-qty')).each(function() {
                sumShipped += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
            });
            if (sumShipped <= Orqty) {
                $(this).val(accounting.formatMoney(thisShipped, '', 0));
            } else {
                $(this).val(0);
                sumShipped = 0;
                $(e.find('.shipped-qty')).each(function() {
                    sumShipped += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
                });
            }
            e.find('.the-rest-qty').val(accounting.formatMoney(Orqty - sumShipped, '', 0));
        } else {
            $(this).val(0);
        }
    }).on('click', '.btn-list-old', function() {
        var tr = $(this).closest('tr');
        var part = tr.find('.supplier-part').val();
        var qty_spq = tr.find('.spq');
        var spqp = tr.find('.spqp');
        var order_qty = tr.find('.order-qty');
        var unit_price_usd = tr.find('.unit-price-usd');
        var unit_price_vnd = tr.find('.unit-price-vnd');
        $.ajax({
            url: site_url + 'customer_sales_contract/list_old',
            type: 'POST',
            cache: false,
            data: {
                part: part,
                customerID: $('#CustomerID').val()
            },
            success: function(string) {
                $('#modal-list-old .modal-body tbody').empty().append(string);
                $('#modal-list-old').modal('show');
                $('.get-info-item').click(function() {
                    var tr_item = $(this).closest('tr');
                    qty_spq.val(accounting.formatMoney(parseFloat(tr_item.find('.qty-spq-old').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    spqp.val(accounting.formatMoney(parseFloat(tr_item.find('.spqp-old').text().replace(/\s/g, '').replace(/,/g, '')), '', 4));
                    order_qty.val(accounting.formatMoney(parseFloat(tr_item.find('.qty-nspq-old').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    unit_price_usd.val(accounting.formatMoney(parseFloat(tr_item.find('.nspqp-old').text().replace(/\s/g, '').replace(/,/g, '')), '', 4));
                    unit_price_vnd.val(accounting.formatMoney(parseFloat(tr_item.find('.nspqp-old').text().replace(/\s/g, '').replace(/,/g, '')) * parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    updateDataItem(tr);
                    updateDataSum();
                    showNoti('Supplier Part Number: ' + part, 'Update completed', 'Ok');
                });
            }
        });
    }).on('change', '#NumberOfDepositPayment', function() {
        var val = $(this).val();
        var parent = $('[data-gDP]');
        parent.attr('data-gDP', val);
        parent.find('.gDP:hidden').find('.bootstrap-datepicker').val('');
        parent.find('.gDP:hidden').find('.depositpayment').val(0);
        var totalDP = 0.0;
        var total = 0.0;
        var currency = $('#Currency').val();
        if (currency == 'USD') {
            total = parseFloat($('input.total-usd').val().replace(/\s/g, '').replace(/,/g, ''));

            if ($('.gDP')) {
                parent.find('.gDP').each(function() {
                    totalDP += parseFloat($(this).find('.depositpayment').val().replace(/\s/g, '').replace(/,/g, ''));
                });
            }
            if (totalDP > total) {
                showNoti('Deposit Payment lớn hơn total', 'Lỗi tính toán', 'Err');
                $(this).val(accounting.formatMoney(0, '', 2));
                $('#RestPayment').val(accounting.formatMoney(0, '', 2));
                return false;
            }
            $('#RestPayment').val(accounting.formatMoney(total - totalDP, '', 2));
        }
        if (currency == 'VND') {
            total = parseFloat($('input.total-vnd').val().replace(/\s/g, '').replace(/,/g, ''));

            if ($('.gDP')) {
                parent.find('.gDP').each(function() {
                    totalDP += parseFloat($(this).find('.depositpayment').val().replace(/\s/g, '').replace(/,/g, ''));
                });
            }
            if (totalDP > total) {
                showNoti('Deposit Payment lớn hơn total', 'Lỗi tính toán', 'Err');
                $(this).val(accounting.formatMoney(0, '', 0));
                $('#RestPayment').val(accounting.formatMoney(0, '', 0));
                return false;
            }
            $('#RestPayment').val(accounting.formatMoney(total - totalDP, '', 0));
        }
    }).on('change', '.depositpayment', function() {
        var thisInp = $(this);
        var val = $(this).val();
        var parent = $('[data-gDP]');
        var totalDP = 0.0;
        var total = 0.0;
        var currency = $('#Currency').val();
        if (currency == 'USD') {
            total = parseFloat($('input.total-usd').val().replace(/\s/g, '').replace(/,/g, ''));
            thisInp.val(accounting.formatMoney(val, '', 2));
            if ($('.gDP')) {
                parent.find('.gDP').each(function() {
                    totalDP += parseFloat($(this).find('.depositpayment').val().replace(/\s/g, '').replace(/,/g, ''));
                });
            }
            if (totalDP > total) {
                showNoti('Deposit Payment lớn hơn total', 'Lỗi tính toán', 'Err');
                thisInp.val(0);
                totalDP = 0.0;
                parent.find('.gDP').each(function() {
                    totalDP += parseFloat($(this).find('.depositpayment').val().replace(/\s/g, '').replace(/,/g, ''));
                });
            }
            $('#RestPayment').val(accounting.formatMoney(total - totalDP, '', 2));
        }
        if (currency == 'VND') {
            total = parseFloat($('input.total-vnd').val().replace(/\s/g, '').replace(/,/g, ''));
            thisInp.val(accounting.formatMoney(val, '', 0));
            if ($('.gDP')) {
                parent.find('.gDP').each(function() {
                    totalDP += parseFloat($(this).find('.depositpayment').val().replace(/\s/g, '').replace(/,/g, ''));
                });
            }
            if (totalDP > total) {
                showNoti('Deposit Payment lớn hơn total', 'Lỗi tính toán', 'Err');
                thisInp.val(0);
                totalDP = 0.0;
                parent.find('.gDP').each(function() {
                    totalDP += parseFloat($(this).find('.depositpayment').val().replace(/\s/g, '').replace(/,/g, ''));
                });
            }
            $('#RestPayment').val(accounting.formatMoney(total - totalDP, '', 0));
        }
    });
});
/* #Ready */

function updateDataSum() {
    var sumTotal = 0.0;
    var sumTotalUSD = 0.0;
    var total = 0.0;
    var totalUSD = 0.0;
    var VAT = 0.0;
    var sumVAT = 0.0;
    var sumVATUSD = 0.0;
    var ship = 0.0;
    var bank = 0.0;
    var usd_currency = parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
    if ($('.amount-vnd').length > 0) {
        $('.amount-vnd').each(function() {
            sumTotal += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.amount-usd').each(function() {
            sumTotalUSD += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        shipUSD = parseFloat($('#ShippingChargesUSD').val().replace(/\s/g, '').replace(/,/g, ''));
        ship = parseFloat($('#ShippingChargesVND').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#ShippingChargesUSD').val(accounting.formatMoney(shipUSD, '', 2));
        $('#ShippingChargesVND').val(accounting.formatMoney(ship, '', 0));
        bankUSD = parseFloat($('#BankChargesUSD').val().replace(/\s/g, '').replace(/,/g, ''));
        bank = parseFloat($('#BankChargesVND').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#BankChargesUSD').val(accounting.formatMoney(bankUSD, '', 2));
        $('#BankChargesVND').val(accounting.formatMoney(bank, '', 0));
        $('.sub-total-usd').val(accounting.formatMoney(sumTotalUSD, '', 2));
        $('#SubTotalVND').val(accounting.formatMoney(sumTotal, '', 0));
        VAT = parseFloat($('#VAT').val().replace(/\s/g, '').replace(/,/g, ''));
        sumVAT = sumTotal * VAT / 100;
        sumVATUSD = sumTotalUSD * VAT / 100;
        $('.vat-usd').val(accounting.formatMoney(sumVATUSD, '', 2));
        $('#VATVND').val(accounting.formatMoney(sumVAT, '', 0));
        total = sumTotal + sumVAT + ship + bank;
        totalUSD = sumTotalUSD + sumVATUSD + shipUSD + bankUSD;
        $('.total-usd').val(accounting.formatMoney(totalUSD, '', 2));
        $('#TotalVND').val(accounting.formatMoney(total, '', 0));

    } else {
        $('#SubTotalVND').val(0);
        $('.sub-total-usd').val(accounting.formatMoney(0, '', 2));
        $('.total-usd').val(accounting.formatMoney(0, '', 2));
        $('#TotalVND').val(0);
        $('.vat-usd').val(accounting.formatMoney(0, '', 2));
        $('#VATVND').val(0);
        $('#ShippingChargesUSD').val(accounting.formatMoney(0, '', 2));
        $('#ShippingChargesVND').val(0);
        $('#BankChargesUSD').val(accounting.formatMoney(0, '', 2));
        $('#BankChargesVND').val(0);
    }
    $('#DepositPayment1').trigger('change');
}

function updateDataItem(e) {
    var Orqty = parseFloat(e.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
    if (Orqty < 0) {
        Orqty = 0;
    }
    var priceUSD = parseFloat(e.find('.unit-price-usd').val().replace(/\s/g, '').replace(/,/g, ''));
    var priceVND = parseFloat(e.find('.unit-price-vnd').val().replace(/\s/g, '').replace(/,/g, ''));
    var amountVND = Orqty * priceVND;
    e.find('.amount-usd').val(accounting.formatMoney(Orqty * priceUSD, '', 2));
    e.find('.amount-vnd').val(accounting.formatMoney(amountVND, '', 0));
    updateDataSum();
}