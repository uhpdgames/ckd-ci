$(document).ready(function($) {
    anrDataRequired();
    $('body').on('click', '#submitBtn', function () {
        if ($('#itemList table.table-part').length) {
            var table = $('#itemList table.table-part tr.highlightNoClick');
            var order_id = 0;
            var field = 'CPOID';
            var table_name = 'customer_purchase_order';
            order_id = $('#CustomerPONo').val();
            if ($('#CustomerPONo').hasClass('disabled') && $('#SOONo').val() != '') {
                table_name = 'sales_order';
                order_id = $('#SOONo').val();
                field = 'SalesOrderID';
            }
            if (table.length != 0) {
                var arr = [];
                var arrKey = [];
                table.find('input.mfr-part').each(function() {
                    arrKey.push($(this).closest('tr').find('.itemKey').val());
                    arr.push($(this).val());
                });
                $.ajax({
                    url: site_url + 'ajax/submitEndUserPrice',
                    type: 'POST',
                    cache: false,
                    data: {
                        arrPart: arr,
                        arrKey: arrKey,
                        table: table_name,
                        order_id: order_id,
                        field: field,
                    },
                    success: function(string) {
                        var getData = $.parseJSON(string);
                        for(var i = 0; i < getData.length; i++) {
                            if (getData[i]['itemKey'] == 0){
                            }else{
                                var trNew = $('input.itemKey[value="' + getData[i]['itemKey'] + '"]').closest('tr');
                                trNew.find('.end-user-price').val(accounting.formatMoney(getData[i]['EndUserPrice'], '', 4));
                                trNew.find('.selling-amount').val(accounting.formatMoney(getData[i]['SellingAmount'], '', 2));
                            }
                        }
                    }
                })
            }
        }
    }).on('click', '#remove-sub-part', function() {
        var btn = $(this).parent().parent().remove();
    })
/*    $('#updateFrm').submit(function() {
        if (!$('#CustomerPONo').hasClass('disabled') && $('#CustomerPONo').val() == '') {
            showNoti('Customer PO No not empty!', 'Error', 'Err');
            if ($('#info-order').hasClass('in')) {
                $('#CustomerPONo').select2('open');
            }
            return false;
        }
    });*/
    $('#VAT').bind('change', updateDataSum);
    $('#DiscountVND').bind('change', function() {
        var val = parseInt($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var DiscountUSD = val / parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#DiscountUSD').val(accounting.formatMoney(DiscountUSD, '', 4));
        $(this).val(accounting.formatMoney(val, '', 0));
        updateDataSum();
    });
    $('#DiscountUSD').bind('change', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var DiscountVND = val * parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#DiscountVND').val(accounting.formatMoney(DiscountVND, '', 0));
        $(this).val(accounting.formatMoney(val, '', 4));
        updateDataSum();
    });

    $('#OtherCostVND').bind('change', function() {
        var val = parseInt($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var OtherCostUSD = val / parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#OtherCostUSD').val(accounting.formatMoney(OtherCostUSD, '', 4));
        $(this).val(accounting.formatMoney(val, '', 0));
        updateDataSum();
    });

    $('#OtherCostUSD').bind('change', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var OtherCostVND = val * parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#OtherCostVND').val(accounting.formatMoney(OtherCostVND, '', 0));
        $(this).val(accounting.formatMoney(val, '', 4));
        updateDataSum();
    });

    $('#FreightChargeVND').bind('change', function() {
        var val = parseInt($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var FreightChargeUSD = val / parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#FreightChargeUSD').val(accounting.formatMoney(FreightChargeUSD, '', 4));
        $(this).val(accounting.formatMoney(val, '', 0));
        updateDataSum();
    });

    $('#FreightChargeUSD').bind('change', function() {
        var val = parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        var FreightChargeVND = val * parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#FreightChargeVND').val(accounting.formatMoney(FreightChargeVND, '', 0));
        $(this).val(accounting.formatMoney(val, '', 4));
        updateDataSum();
    });

    updateDataSum();
    function balance() {
        $( ".shipmentBalance" ).change(function() {
            var id = this.id;
            // var val = parseFloat(id);
            // var btn = $(this).closest('tr').parent();
            var value = $( this ).val();
            var btn = $(this).closest('tr').prev();
            if( id == 1){
                var sumshipment = parseFloat(btn.find('.OrderQuantity').val().replace(/\s/g, '').replace(/,/g, ''));
            }else{
                var sumshipment = parseFloat(btn.find('.balance').val().replace(/\s/g, '').replace(/,/g, ''));
            }
            var Balance = 0;
            // var orderQuantity12 = 0;
            // var orderQuantity = parseFloat(btn.find('.order-qty').val());
            console.log(value);
            // $('tr.sm-'+id).each(function () {
            //     orderQuantity12 +=  parseFloat($(this).find('.ship-'+id).val().replace(/\s/g, '').replace(/,/g, ''));
            // })
            // console.log(orderQuantity12);
            if( value > sumshipment){
                showNoti('Vui lòng chọn Số lượng Shipped Qty nhỏ hơn Order Qty', 'Cảnh báo', 'War');

            }else{
                Balance = (sumshipment - value);
                // console.log(Balance);
                $(this).closest('tr').find('.balance').val(accounting.formatMoney(Balance, '', 0));
            }
        });
    }
    $('body').on('click', '.btn-list-old', function() {
        var tr = $(this).closest('tr');
        var mfrPart = tr.find('.mfr-part').val();
        var orderqty = tr.find('.order-qty');
        var unitprice = tr.find('.unit-price-usd');
        $.ajax({
            url: site_url + $('#act').val() + '/list_old',
            type: 'POST',
            cache: false,
            data: { mfrPart: mfrPart },
            success: function(string) {
                $('#modal-list-old .modal-body tbody').empty().append(string);
                $('#modal-list-old').modal('show');
                $('.get-info-item').click(function() {
                    var tr_item = $(this).closest('tr');
                    orderqty.val(accounting.formatMoney(parseFloat(tr_item.find('.orderqty').text().replace(/\s/g, '').replace(/,/g, '')), '', 0));
                    unitprice.val(accounting.formatMoney(parseFloat(tr_item.find('.unitprice').text().replace(/\s/g, '').replace(/,/g, '')), '', 4));
                    showNoti('Mfr Part Number: ' + mfrPart, 'Cập nhật hoàn tất', 'Ok');
                    updateDataItem(tr);
                    updateDataSum();
                });
            }
        });
    }).on('change', '#NumberOfShipment', function() {
        var val = $(this).val();
        $('[data-shipped]').attr('data-shipped', val);
        anrDataRequired();
    }).on('click', '#addRowpo', function() {
        var btn = $(this).closest('tr').prev();
        var key = btn.find('.itemKey').val();
        var curStepIndex = $(this).closest('.highlightNoClick').index();
        // var numberOfShipment = btn.find('.numberOfShipment').val();
        var SupplierPart = btn.find('.supplier-part').val();
        var MfrPart = btn.find('.MfrPart').val();
        var Description = btn.find('.Description').val();
        // var OrderQuantity = btn.find('.order-qty').val();
        var Manufacturer = btn.find('.Manufacturer').val();
        var PackageCase = btn.find('.PackageCase').val();
        var Packaging = btn.find('.Packaging').val();
        var StandardPackageQty = btn.find('.StandardPackageQty').val();
        var OrderQuantity = btn.find('.OrderQuantity').val();
        var CustomerReceivedDate = btn.find('.CustomerReceivedDate').val();
        var LeadtimeComments = btn.find('.LeadtimeComments').val();
        var UnitPriceUsd = btn.find('.unit-price-usd').val();
        var numberShip = $('#itemList table tbody .lengthPart:contains('+SupplierPart+')').length;
        console.log(SupplierPart);
        if ($('#itemList table tbody .lengthPart').length == 0) {
            key = 1;
        }
        console.log(numberShip);
        if(numberShip > 1){
            sub_key = 'sub_'+key+'_'+numberShip;
            console.log(sub_key);
        }else{
            sub_key = 'sub_'+key+'_1';
        }
        var data = {
            key: key,
            sub_key: sub_key,
            numberShip: numberShip,
            // numberOfShipment: numberOfShipment,
            SupplierPart: SupplierPart,
            MfrPart: MfrPart,
            // OrderQuantity: OrderQuantity,
            Description: Description,
            Manufacturer: Manufacturer,
            PackageCase: PackageCase,
            Packaging: Packaging,
            StandardPackageQty: StandardPackageQty,
            OrderQuantity: OrderQuantity,
            CustomerReceivedDate: CustomerReceivedDate,
            UnitPriceUSD: UnitPriceUsd,
            LeadtimeComments: LeadtimeComments
        }
        console.log(data);
        add_row1(data);
        // updateNO();
        // $parentTR.clone().insertAfter(data);
        // setTimeout(function() { btn.removeAttr('disabled') }, 1000);
    }).on('click', '.minus-shipment', function() {
        var btn = $(this).closest('tr');
        var SupplierPart =  btn.find('.supplier-part').val().replace(/\./g,'');
        console.log(SupplierPart);
        $(".collapse-"+ SupplierPart).hide();
        btn.find('.col-collapse').html('<i class="fa fa-plus-circle plus-shipment"></i>');
    }).on('click', '.plus-shipment', function() {
        var btn = $(this).closest('tr');
        var SupplierPart =  btn.find('.supplier-part').val().replace(/\./g,'');
        console.log(SupplierPart);
        $(".collapse-"+ SupplierPart).show();
        btn.find('.col-collapse').html('<i class="fa fa-minus-circle minus-shipment"></i>');
    }).on('click', '.minus-shipment-total', function() {
        $(".highlightNoClick1").hide();
        $('.col-collapse-total').html('<i class="fa fa-plus-circle plus-shipment-total"></i>');
        $('.col-collapse').html('<i class="fa fa-plus-circle plus-shipment" ></i>');
    }).on('click', '.plus-shipment-total', function() {
        $(".highlightNoClick1").show();
        $('.col-collapse-total').html('<i class="fa fa-minus-circle minus-shipment-total" ></i>');
        $('.col-collapse').html('<i class="fa fa-minus-circle minus-shipment"></i>');
    })
    function add_row1(data) {
        $.ajax({
            url: site_url + 'ajax/add_sub_row',
            cache: false,
            type: 'POST',
            data: {
                act: $('#act').val(),
                data: data
            },
            success: function(string) {
                // $parentTR.clone().insertAfter(string);
                // $(string).insertAfter($(this));
                jQuery("#"+ data.sub_key).after(string);

                $('.select-supplier:not(.select-status)').chosen({ allow_single_deselect: true });
                $('.bootstrap-datepicker').datepicker({
                    format: 'yyyy-mm-dd',
                    language: 'vi',
                    autoclose: true,
                    todayHighlight: true
                });
                balanqty();
            }
        })
    }
});
/* # Ready */
function balanqty(){
    $( ".shipmentBalance" ).change(function() {
        var id = this.id;
        var value = $( this ).val();
        var btn = $(this).closest('tr').prev();
        if( id > 1){
            var sumshipment = parseFloat(btn.find('.balance').val().replace(/\s/g, '').replace(/,/g, ''));
        }else{
            var sumshipment =  parseFloat(btn.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
            console.log(sumshipment);
        }
        var Balance = 0;
        if( value > sumshipment){
            showNoti('Vui lòng chọn Số lượng Shipped Qty nhỏ hơn Order Qty', 'Cảnh báo', 'War');

        }else{
            Balance = (sumshipment - value);
            // console.log(Balance);
            $(this).closest('tr').find('.balance').val(accounting.formatMoney(Balance, '', 0));
        }
    });
}
function updateDataSum() {
    var exchange_rate = parseInt($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
    var sumTotal = 0.0;
    var sumTotalVND = 0.0;
    var sumSellingAmount = 0.0;
    var total = 0.0;
    var VAT = 0.0;
    var sumVAT = 0.0;
    var totalRMB = 0.0;
    var totalEUR = 0.0;
    var sumTotalRMB = 0.0;
    var sumTotalEUR = 0.0;
    var sumVATRMB = 0.0;
    var sumVATEUR = 0.0;
    var OtherCostEUR = 0.0;
    var FreightChargeEUR = 0.0;
    var OtherCostRMB = 0.0;
    var FreightChargeRMB = 0.0;
    var DiscountUSD = 0.0;
    var OtherCostUSD = 0.0;
    var FreightChargeUSD = 0.0;
    if ($('.amount-usd').length > 0) {
        $('.amount-usd').each(function() {
            sumTotal += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));

            sumSellingAmount += parseFloat($(this).closest('tr').find('.selling-amount').val().replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.amount-vnd').each(function() {
            sumTotalVND += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.amount-rmb').each(function() {
            sumTotalRMB += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
        });
        $('.amount-eur').each(function() {
            sumTotalEUR += parseFloat($(this).val().replace(/\s/g, '').replace(/,/g, ''));
            console.log(sumTotalEUR);
        });
        if ($('#DiscountVND').length) {
            DiscountUSD = parseFloat($('#DiscountUSD').val().replace(/\s/g, '').replace(/,/g, ''));
            $('#DiscountVND').val(accounting.formatMoney(DiscountUSD * exchange_rate, '', 0));
            $('#DiscountUSD').val(accounting.formatMoney(DiscountUSD, '', 2));
        }
        if ($('#FreightChargeUSD').length) {
            FreightChargeUSD = parseFloat($('#FreightChargeUSD').val().replace(/\s/g, '').replace(/,/g, ''));
            $('#FreightChargeVND').val(accounting.formatMoney(FreightChargeUSD * exchange_rate, '', 0));
            $('#FreightChargeUSD').val(accounting.formatMoney(FreightChargeUSD, '', 2));
        }

        OtherCostUSD = parseFloat($('#OtherCostUSD').val().replace(/\s/g, '').replace(/,/g, ''));
        OtherCostEUR = parseFloat($('#OtherCostEUR').val().replace(/\s/g, '').replace(/,/g, ''));
        OtherCostRMB = parseFloat($('#OtherCostRMB').val().replace(/\s/g, '').replace(/,/g, ''));
        FreightChargeEUR = parseFloat($('#FreightChargeEUR').val().replace(/\s/g, '').replace(/,/g, ''));
        FreightChargeRMB = parseFloat($('#FreightChargeRMB').val().replace(/\s/g, '').replace(/,/g, ''));
        $('#OtherCostVND').val(accounting.formatMoney(OtherCostUSD * exchange_rate, '', 0));
        $('#OtherCostUSD').val(accounting.formatMoney(OtherCostUSD, '', 2));
        $('#SubTotalRMB').val(accounting.formatMoney(sumTotalRMB, '', 2));
        $('#SubTotalEUR').val(accounting.formatMoney(sumTotalEUR, '', 2));
        $('#SubTotalVND').val(accounting.formatMoney(sumTotalVND, '', 0));
        $('#SubTotalUSD').val(accounting.formatMoney(sumTotal, '', 2));
        $('#TotalSellingAmount').val(sumSellingAmount);
        VAT = parseFloat($('#VAT').val().replace(/\s/g, '').replace(/,/g, ''));
        sumVAT = sumTotal * VAT / 100;
        sumVATEUR = sumTotalEUR  * VAT / 100;
        sumVATRMB = sumTotalRMB  * VAT / 100;
        sumVATVND = sumTotal * exchange_rate * VAT / 100;
        $('.vat-vnd').val(accounting.formatMoney(sumVAT * exchange_rate, '', 0));
        $('#VATTaxUSD').val(accounting.formatMoney(sumVAT, '', 2));
        total = sumTotal + sumVAT + OtherCostUSD - DiscountUSD + FreightChargeUSD;
        totalEUR = sumTotalEUR + sumVATEUR  + OtherCostEUR  + FreightChargeEUR;
        totalRMB = sumTotalRMB + sumVATRMB  + OtherCostRMB + FreightChargeRMB;
        totalvnd = sumTotalVND + sumVATVND + (OtherCostUSD * exchange_rate) + (DiscountUSD * exchange_rate) + (FreightChargeUSD * exchange_rate);
        $('#TotalVND').val(accounting.formatMoney(totalvnd, '', 0));
        $('#TotalUSD').val(accounting.formatMoney(total, '', 2));
        $('#TotalEUR').val(accounting.formatMoney(totalEUR, '', 2));
        $('#TotalRMB').val(accounting.formatMoney(totalRMB, '', 2));
    } else {
        $('#SubTotalUSD').val(accounting.formatMoney(0, '', 2));
        $('#TotalSellingAmount').val(0);
        $('#SubTotalVND').val(0);
        $('.vat-vnd').val(0);
        $('#VATTaxUSD').val(accounting.formatMoney(0, '', 2));
        $('#DiscountUSD').val(accounting.formatMoney(0, '', 2));
        $('#DiscountVND').val(0);
        $('#OtherCostUSD').val(accounting.formatMoney(0, '', 2));
        $('#OtherCostVND').val(0);
        $('#FreightChargeUSD').val(accounting.formatMoney(0, '', 2));
        $('#FreightChargeVND').val(0);
        $('#TotalUSD').val(accounting.formatMoney(0, '', 2));
        $('#TotalVND').val(0);
    }
    $('#FirstPayment').trigger('change');
}
$('#importModal').on('show.bs.modal', function() {
    if ($('#CustomerPONo').val() == '') {
        $('#importModal').modal('hide');
        if ($('#info-order').hasClass('in')) {
            $('#CustomerPONo').select2('open');
        }
        showNoti('Customer PO No not empty', 'Error', 'War');
        return false;
    }
})
$(document).ready(function () {
    $( ".shipmentBalance" ).change(function() {
        var id = this.id;
        // var val = parseFloat(id);
        // var btn = $(this).closest('tr').parent();
        var value = $( this ).val();
        var btn = $(this).closest('tr').prev();
        var test =  btn.find('.OrderQuantity').val();
        if( id > 1){
            var sumshipment = parseFloat(btn.find('.balance').val().replace(/\s/g, '').replace(/,/g, ''));
        }else{
            var sumshipment =  parseFloat(btn.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
            console.log(sumshipment);
        }
        var Balance = 0;
        // var orderQuantity12 = 0;
        // var orderQuantity = parseFloat(btn.find('.order-qty').val());
        // console.log(value);
        // $('tr.sm-'+id).each(function () {
        //     orderQuantity12 +=  parseFloat($(this).find('.ship-'+id).val().replace(/\s/g, '').replace(/,/g, ''));
        // })
        // console.log(orderQuantity12);
        if( value > sumshipment){
            showNoti('Vui lòng chọn Số lượng Shipped Qty nhỏ hơn Order Qty', 'Cảnh báo', 'War');

        }else{
            Balance = (sumshipment - value);
            // console.log(Balance);
            $(this).closest('tr').find('.balance').val(accounting.formatMoney(Balance, '', 0));
        }
    });
    function updateCPOdate() {
        var CPOdate = $('#CPODate').val();
        $('.CPODateShipment').val(CPOdate);
    }
    updateCPOdate();
    get_info_delivery();
    function get_info_delivery() {
        var CustomerPONo = $('#CustomerPONo').val();
        var dataString = {
            CustomerPONo : CustomerPONo
        };
        $.ajax({
            type: "POST",
            url: site_url + $('#act').val() + '/get_info_delivery',
            data: dataString,
            // dataType: "json",
            cache : false,
            success: function(data){
                $("#deliveryTime").html(data);
            } ,error: function(xhr, status, error) {
                alert(error);
            },
        });
    }
    $( "#Currency" ).change(function() {
        var val = $( this ).val();
        if (val == 'USD') {
            $('#PORates').val(accounting.formatMoney(1, '', 2));
        }else if(val == 'VND'){
            $('#Rates_lable').html('VND');
            $( ".col-unit_price_vnd" ).show();
            $( ".col-unit_price_vnd" ).show();
            $( ".col-end_user_price_vnd" ).show();
            $( ".col-selling_amount_vnd" ).show();
        }
        else if(val == 'RMB'){
            $('#Rates_lable').html('RMB');
            $( ".col-unit_price_rmb" ).show();
            $( ".col-amount_rmb" ).show();
            $( ".col-end_user_price_rmb" ).show();
            $( ".col-selling_amount_rmb" ).show();
            $( ".currency_vnd" ).hide();
            $( ".col-unit_price_eur" ).hide();
            $( ".col-amount_eur" ).hide();
            $( ".col-end_user_price_eur" ).hide();
            $( ".col-selling_amount_eur" ).hide();
        }else if(val == 'EUR'){
            $('#Rates_lable').html('EUR');
            $( ".col-unit_price_eur" ).show();
            $( ".col-amount_eur" ).show();
            $( ".col-end_user_price_eur" ).show();
            $( ".col-selling_amount_eur" ).show();
            $( ".currency_vnd" ).hide();
            $( ".col-unit_price_rmb" ).hide();
            $( ".col-amount_rmb" ).hide();
            $( ".col-end_user_price_rmb" ).hide();
            $( ".col-selling_amount_rmb" ).hide();
        }
    });
    get_info_Currency();
    function get_info_Currency() {
        var val =  $('#Currency').val();
        if (val == 'USD') {
            $('#PORates').val(accounting.formatMoney(1, '', 2));
        }else if(val == 'VND'){
            $('#Rates_lable').html('VND');
            $( ".col-unit_price_vnd" ).show();
            $( ".col-unit_price_vnd" ).show();
            $( ".col-end_user_price_vnd" ).show();
            $( ".col-selling_amount_vnd" ).show();
        }
        else if(val == 'RMB'){
            $('#Rates_lable').html('RMB');
            $( ".col-unit_price_rmb" ).show();
            $( ".col-amount_rmb" ).show();
            $( ".col-end_user_price_rmb" ).show();
            $( ".col-selling_amount_rmb" ).show();
            $( ".currency_vnd" ).hide();
            $( ".col-unit_price_eur" ).hide();
            $( ".col-amount_eur" ).hide();
            $( ".col-end_user_price_eur" ).hide();
            $( ".col-selling_amount_eur" ).hide();
        }else if(val == 'EUR'){
            $('#Rates_lable').html('EUR');
            $( ".col-unit_price_eur" ).show();
            $( ".col-amount_eur" ).show();
            $( ".col-end_user_price_eur" ).show();
            $( ".col-selling_amount_eur" ).show();
            $( ".currency_vnd" ).hide();
            $( ".col-unit_price_rmb" ).hide();
            $( ".col-amount_rmb" ).hide();
            $( ".col-end_user_price_rmb" ).hide();
            $( ".col-selling_amount_rmb" ).hide();
        }
    }
});