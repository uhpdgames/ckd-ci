$(document).ready(function($) {

    $('#VAT').bind('change', updateDataSum);

    $('.costs-incurred').bind('change', function() {
        var field = $(this).data('field');
        var currency = $(this).data('currency');
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var residualValue = 0;
        var residualCurrency = '';
        var fMoney = 0;
        var residualFMoney = 0;
        if (currency == 'USD') {
            residualCurrency = 'VND';
            fMoney = 2;
            residualValue = val * parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        } else {
            residualCurrency = 'USD';
            residualFMoney = 2;
            residualValue = val / parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        }
        $(this).val(accounting.formatMoney(val, '', fMoney));
        $('#' + field + residualCurrency).val(accounting.formatMoney(residualValue, '', residualFMoney));
        updateDataSum();
    });
    updateDataSum();

    $('body').on('change', '.order-qty', function() {
        if ($('#act').val() == 'sales_order_online') {
            var Orqty = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
            var e = $(this).parent().parent();
            var priceUSD = e.find('.unit-price-usd').val();
            var part = e.find('.supplier-part').val();
            $.ajax({
                url: site_url + 'ajax/get_price',
                type: 'POST',
                cache: false,
                data: {
                    qty: Orqty,
                    part: part
                },
                success: function (string) {
                    var sumShipped = 0;
                    $(e.find('.shipped-qty')).each(function() {
                        sumShipped += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
                    });
                    if (Orqty >= sumShipped) {
                        e.find('.the-rest-qty').val(accounting.formatMoney(Orqty - sumShipped, '', 0));
                    } else {
                        e.find('.shipped-qty').val(0);
                        e.find('.the-rest-qty').val(0);
                    }
                    if (string > 0) {
                        var priceVND = string * parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
                        e.find('.unit-price-usd').val(accounting.formatMoney(string, '', 4));
                        e.find('.unit-price-vnd').val(accounting.formatMoney(priceVND, '', 0));
                    }
                    updateDataItem(e);
                }
            })
        }
    }).on('change', '.spqp', function(event) {
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
            url: site_url + 'sales_order/list_old',
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
                    showNoti('ATCOM Part Number: ' + part, 'Cập nhật hoàn tất', 'Ok');
                });
            }
        });
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
    var discount = 0.0;
    var discountUSD = 0.0;
    var ship = 0.0;
    var shipUSD = 0.0;
    var bank = 0.0;
    var bankUSD = 0.0;
    var usd_currency = parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
    if ($('.amount-vnd').length > 0) {
        $('.amount-vnd').each(function() {
            sumTotal += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.amount-usd').each(function() {
            sumTotalUSD += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        discountUSD = parseFloat($('#DiscountUSD').val().replace(/\s/g, '').replace(/,/g, ''));
        discount = parseFloat($('#DiscountVND').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#DiscountUSD').val(accounting.formatMoney(discountUSD, '', 2));
        $('#DiscountVND').val(accounting.formatMoney(discount, '', 0));
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
        total = sumTotal + sumVAT + ship + bank - discount;
        totalUSD = sumTotalUSD + sumVATUSD + shipUSD + bankUSD - discountUSD;
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
    $('#FirstPayment').trigger('change');
}
