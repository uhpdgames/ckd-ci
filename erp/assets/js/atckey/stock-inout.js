$(document).ready(function() {
    $('body').on('click', '.tools-link.edit', function () {
        var toolsDiv = $(this).parent();
        toolsDiv.children('.delete').toggleClass('delete cancel').children('span').text('Cancel');
        $(this).toggleClass('edit apply').children('i').toggleClass('fa-edit fa-check').next('span').text('Apply');
    }).on('click', '.tools-link.apply', function () {
        var toolsDiv = $(this).parent();
        toolsDiv.children('.cancel').toggleClass('cancel delete').children('span').text('Delete');
        $(this).toggleClass('apply edit').children('i').toggleClass('fa-check fa-edit').next('span').text('Edit');
    }).on('click', '.tools-link.cancel', function () {
        var toolsDiv = $(this).parent();
        toolsDiv.children('.apply').toggleClass('apply edit').children('i').toggleClass('fa-check fa-edit').next('span').text('Edit');
        $(this).toggleClass('cancel delete').children('span').text('Delete');
    }).on('click', '#itemList .del a', function() {
        $(this).parent().parent().remove();
        for (var i = 0; i < $('#itemList .highlightNoClick').length; i++) {
            $('#itemList .highlightNoClick:eq(' + i + ') td:eq(1) span').text(i + 1);
            // $('#itemList .highlightNoClick:eq(' + i + ') .sortItem').val(i + 1);
        }
        sum_all();
    }).on('keyup keydown', '.qtyItem, .priceUSDItem, .VATUSDItem', function() {
        if ($(this).val() == '') {
            $(this).val(0).select();
        }
        var row = $(this).parent().parent();
        sum_item(row);
    }).on('keyup keydown', '.qtyItem', function() {
        $(this).val(accounting.formatMoney($(this).val(), '', 0));
    }).on('change', '.priceUSDItem', function() {
        $(this).prev('.priceUSDItemHide').val($(this).val());
        $(this).val(accounting.formatMoney($(this).val(), '', 4));
    }).on('click', '.btn-list-old', function() {
        var tr = $(this).closest('tr');
        var part = tr.find('.supplier-part').val();
        var category = tr.find('.category');
        var lot_code = tr.find('.lot_code input');
        $.ajax({
            url: site_url + $('#act').val() + '/list_old',
            type: 'POST',
            cache: false,
            data: {
                part: part,
            },
            success: function(string) {
                $('#modal-list-old .modal-body tbody').empty().append(string);
                $('#modal-list-old').modal('show');
                $('.get-info-item').click(function() {
                    var tr_item = $(this).closest('tr');
                    category.val(tr_item.find('.category').text());
                    lot_code.val(tr_item.find('.lot_code').text());
                    showNoti('ATCOM Part Number: ' + part, 'Cập nhật hoàn tất', 'Ok');
                });
            }
        });
    }).on('change', '.etd-control, .etd-control-plus', function() {
        var date_added = $(this).closest('.end_sell_date').find('.date_added').val();
        if (date_added == 'undefined') {
            date_added = _today();
        }
        estimateDate($(this), date_added);
    }).on('change', '.TAXItem', function() {
        handleTAX($(this));
    }).on('keyup', '.qtyItem', function() {
        if ($('#act').val() == 'stock_export') {
            var thisQty = $(this);
            var parent = $(this).closest('tr');
            var qty = parseInt($(this).val().replace(/,/g, ''));
            var supplier_part = parent.find('.part_number .supplier-part').val();
            var lot_code = parent.find('.lot_code input').val();
            var warehouse = $('#warehouseid').val();
            var cpo = parent.find('.cpo select').val();
            var currentYear = new Date().getFullYear();
            $.ajax({
                url: site_url + 'stock_inout/get_inventory',
                type: 'POST',
                cache: false,
                data: {
                    supplier_part: supplier_part,
                    lot_code: lot_code,
                    warehouse: warehouse,
                    cpo: cpo,
                    year: currentYear,
                },
                success: function(string) {
                    var inventory = parseInt(string);
                    if (inventory < qty) {
                        showNoti('Số lượng xuất không được lớn hơn tồn kho (' + accounting.formatMoney(inventory, '', 0) + ')', 'Cảnh báo', 'War');
                        thisQty.val(0);
                        return false;
                    }
                }
            })
        }
    })

    // .on('focus', 'td.cpo .select-status', function() {
    //     var id = $(this).attr('id');
    //     var old_val = $(this).val();
    //     $(this).empty().append(optionCPO).val(old_val).chosen();
    // }).on('focus', 'td.sc .select-status', function() {
    //     var id = $(this).attr('id');
    //     var old_val = $(this).val();
    //     $(this).empty().append(optionSC).val(old_val).chosen();
    // })

    // $('td.sc .select-status, td.cpo .select-status').each(function() {
    //         var id = $(this).attr('id');
    //         var old_val = $(this).val();
    //         $(this).empty().append(optionSC).val(old_val).chosen().delay(10);
    // });
    //
    //     $('td.sc .select-status, td.cpo .select-status').each(function(index) {
    //         (function(that, i) {
    //             var t = setTimeout(function() {
    //                 var id = $(this).attr('id');
    //                 var old_val = $(this).val();
    //                 $(this).empty().append(optionSC).val(old_val).chosen();
    //                 }, 500 * i);
    //         })(this, index);
    //     });
    .on('focus', 'td.cpo .select-status', function() {
        var id = $(this).attr('id');
        var old_val = $(this).val();
        $(this).empty().append(optionCPO).val(old_val).chosen();
        setTimeout(function(){$('#'+id+'_chosen').trigger('mousedown');; }, 100);
    }).on('focus', 'td.sc .select-status', function() {
        var id = $(this).attr('id');
        var old_val = $(this).val();
        $(this).empty().append(optionSC).val(old_val).chosen();
        setTimeout(function(){$('#'+id+'_chosen').trigger('mousedown');; }, 100);

    })

    // $('#table_stock_begin').DataTable(
    //     {
    //         responsive: true,
    //         paging: false,
    //         "searching": false,
    //         "lengthChange": false,
    //         "bInfo" : false
    //
    //     }
    // );
    $('.money').autoNumeric('init', {
        'mDec': 0
    });

    $('.money2').autoNumeric('init', {
        'mDec': 2
    });

    $('.money3').autoNumeric('init', {
        'mDec': 3
    });

    $('.money4').autoNumeric('init', {
        'mDec': 4
    });

    $('#importBtn, #updateBtn').click(function() {
        if ($('.group-required').is(':visible') && $('#cpo').val() == '') {
            showNoti('Chọn CPO trước khi import file', 'Cảnh báo', 'War');
            return false;
        }
        if ($('#warehouseid').val() == '') {
            showNoti('Chọn Warehouse trước khi import file', 'Cảnh báo', 'War');
            return false;
        }
        if ($(this).attr('id') == 'updateBtn') $('#importModal .btn-modal-submit').attr('id', 'updateRow');
        $('#importModal').modal('show');
        return false;
    });

});
$(document).ready(function() {
    $('#frmSearch').submit(function() {
        $('#divSearch').show();
        $('#divSearch div').css('max-height', '300px');
        $('#divSearch tbody').html('<tr><td class="fr center" colspan="13"><div style="padding:10px"><img src="assets/images/spinner-mini.gif" /></div></td></tr>');
        var controlAjax = site_url + 'stock_inout/search_part';
        if (moduleOut == 1) {
            controlAjax = site_url + 'stock_inout/list_part';
        }
        $.ajax({
            url: controlAjax,
            type: 'POST',
            cache: false,
            data: {
                q: $('[name="q"]').val()
            },
            success: function(string) {
                $('#divSearch tbody').empty().append(string);
                $('#divSearch tr:not(".no-data")').click(function(e) {
                    var _this = $(this);
                    var part = $(this).find('td.supplier_part').text();
                    var lot_code = $(this).find('td.lot_code').text();
                    if ($('.group-required').is(':visible') && $('#cpo').val() == '') {
                        showNoti('Chọn CPO trước khi nhập part', 'Cảnh báo', 'War');
                        return false;
                    }
                    if (!Array.isArray(arrqp)) {
                        arrqp = $.parseJSON(arrqp);
                    }
                    var result = [];
                    console.log(arrqp);
                    if (arrqp.length) {
                        result = arrqp.map(a => a.SupplierPart !== undefined ? a.SupplierPart.trim() : a.SupplierPart);
                    }
                    // var result = arrqp.map(a => a.SupplierPart);
                    // if (moduleOut == 1 || $('#warehouseid').val() == 1) {
                    //     result = arrqp.map(a => a.supplier_part);
                    // }
                    if ($('#act').val() != 'stock_begin' && !result.includes(part) && $('#warehouseid').val() != 1) {
                        if ($('.group-required').is(':visible') && $('#cpo').val() == '') {
                            showNoti(part + ' không tồn tại trong ' + $('#cpo').find('option[value="' + $('#cpo').val() + '"]').text().split(' - ')[1], 'Cảnh báo', 'War');
                        } else {
                            showNoti(part + ' không tồn tại trong Warehouse', 'Cảnh báo', 'War');
                        }
                        return false;
                    }
                    if ($('#itemList .highlightNoClick').length) {
                        var key = parseInt($('#itemList .highlightNoClick:last-child .keyItem').val()) + 1;
                    } else {
                        var key = 1;
                    }
                    if ($('#act').val() == 'stock_export' && $('#warehouseid').val() != 1) {
                        $.ajax({
                            url: site_url + 'stock_inout/get_part_inout',
                            type: 'POST',
                            data: {
                                part: part,
                                cpo: $('#cpoid').val(),
                                warehouse: $('#warehouseid').val(),
                            },
                            success: function(string) {
                                console.log(string)
                                if (string != 0) {
                                    if ($('#itemList .highlightNoClick').length) {
                                        var key = parseInt($('#itemList .highlightNoClick:last-child .keyItem').val()) + 1;
                                    } else {
                                        var key = 1;
                                    }
                                    var getData = $.parseJSON(string);
                                    var data = {
                                        key: key,
                                        category: getData.category,
                                        cpo: getData.cpono ? getData.cpono : '',
                                        cpoid: getData.cpo ? getData.cpo : '',
                                        sc: '',
                                        po: getData.pono ? getData.pono : '',
                                        poid: getData.po ? getData.po : '',
                                        cus: getData.cusname ? getData.cusname : '',
                                        cusid: getData.cus ? getData.cus : '',
                                        import_method: getData.import_method ? getData.import_method : '',
                                        supplier_part: _this.find('td.supplier_part').text(),
                                        manufacturer_part_number: _this.find('.manufacturer_part_number').text(),
                                        description: _this.find('span.desc').text(),
                                        manufacturer: _this.find('td.manufacturer').text(),
                                        qty: 0,
                                        priceusd: _this.find('td.priceusd').text().replace(/,/g, ''),
                                        pricevnd: 0,
                                        lot_no: getData.lot_no ? getData.lot_no : '',
                                        lot_code: getData.lot_code ? getData.lot_code : '',
                                        date_code: getData.date_code ? getData.date_code : '',
                                        coo: getData.coo ? getData.coo : '',
                                        packaging: getData.packaging ? getData.packaging : '',
                                        warehouse: getData.warehouse ? getData.warehouse : '',
                                        minimum_stock: getData.minimum_stock ? getData.minimum_stock : '',
                                        end_sell_date: getData.end_sell_date ? getData.end_sell_date : '',
                                        end_sell_date_numb: getData.end_sell_date_numb ? getData.end_sell_date_numb : '',
                                        firmware: getData.firmware ? getData.firmware : '',
                                        imei: getData.imei ? getData.imei : '',
                                        package_case: getData.package_case ? getData.package_case : '',
                                        spq: getData.spq_quantity ? getData.spq_quantity : '',
                                        vat: getData.vat ? getData.vat : '',
                                        import_tax: getData.import_tax ? getData.import_tax : '',
                                    };
                                    add_item(data);
                                    sum_all();
                                } else {
                                    showNoti(_this.find('td.supplier_part').text() + ' không tồn tại trong kho ' + $('#warehouseid_chosen .chosen-single span').text(), 'Cảnh báo', 'War');
                                }
                            }
                        });
                    } else {
                        var data = {
                            key: key,
                            category: _this.data('category'),
                            cpoid: _this.data('cpo'),
                            sc: '',
                            scid: $('#scid').length ? $('#scid').val() : '',
                            po: '',
                            poid: 0,
                            cus: 0,
                            cusid: '',
                            import_method: '',
                            supplier_part: _this.find('td.supplier_part').text(),
                            manufacturer_part_number: _this.find('.manufacturer_part_number').text(),
                            description: _this.find('span.desc').text(),
                            manufacturer: _this.find('td.manufacturer').text(),
                            qty: 0,
                            priceusd: _this.find('td.priceusd').text().replace(/,/g, ''),
                            pricevnd: 0,
                            lot_no: _this.data('lot_no'),
                            lot_code: _this.data('lot_code'),
                            date_code: _this.data('date_code'),
                            coo: _this.data('coo'),
                            packaging: _this.find('td.packaging').text(),
                            warehouse: ($('#warehouseid').val() > 0 ? $('#warehouseid').val() : 0),
                            minimum_stock: _this.data('minimum_stock'),
                            end_sell_date: _this.data('end_sell_date'),
                            end_sell_date_numb: _this.data('end_sell_date_numb'),
                            firmware: _this.data('firmware'),
                            imei: _this.data('imei'),
                            package_case: _this.data('package_case'),
                            spq: _this.find('td.spq_quantity').text(),
                            vat: 10,
                            import_tax: 0
                        };
                        add_item(data);
                        sum_all();
                        _this.remove();
                    }
                });
            }
        });

        // $('[name="q"]').val('').blur();
        return false;
    });
    $('#updateFrm').submit(function(event) {

        if ($('#itemList .priceUSDItem').length == 0) {
            showNoti('Phiếu nhập kho trống', 'Lỗi nhập liệu', 'Err');
            return false;
        }
        if ($('.group-required').is(':visible') && $('#cpo').val() == '') {
            showNoti('CPO trống', 'Lỗi nhập liệu', 'Err');
            return false;
        }
        var arr = [];
        var arrNew = [];
        var current = null;
        var cnt = 0;
        $('#itemList').find('.inpd-required').each(function() {
            $(this).removeAttr('style');
            arr.push($(this).val());
        })
        arr.sort();
        if (arr.length > 0) {
            for (var i = 0; i < arr.length; i++) {
                if (arr[i] != current) {
                    if (cnt > 1) arrNew.push(current);
                    current = arr[i];
                    cnt = 1;
                } else {
                    cnt++;
                }
            }
        }
        if (cnt > 1) arrNew.push(current);
        if (arrNew.length > 0) {
            for (var j = 0; j < arrNew.length; j++) {
                $('#itemList').find('.inpd-required').filter(function() { return this.value == arrNew[j] }).css('border-color', 'red');
            }
            showNoti('Lot code không được giống nhau', 'Cảnh báo', 'War');
            return false;
        }
        var flag = false;
        if (!Array.isArray(arrqp)) {
            arrqp = $.parseJSON(arrqp);
        }
        // if ($('#act').val() == 'stock_export') result = arrqp.map(a => a.supplier_part);
        if ($('#act').val() != 'stock_begin' && $('#warehouseid').length && $('#warehouseid').val() != 1) {
            var result = arrqp.map(a => a.SupplierPart);
            $('#itemList tbody tr').each(function() {
                $(this).find('td').css({'background': '#fff' });
                // var partNum = $(this).find('td.part_number input').val().replace('&', '&amp;');
                var partNum = $(this).find('td.part_number input').val();
                if (!result.includes(partNum)) {
                    $(this).find('td').css({'background': '#ffb4b4'});
                    console.log(partNum);
                    flag = true;
                }
            })
        } else {
            $('#itemList tbody tr').each(function() {
                $(this).find('td.cpo select').removeAttr('data-required');
                if ($('#act').val() == 'stock_begin') $('td.packaging select, td.coo select').removeAttr('data-required');
            });
        }
        // return false;
        if (flag) {
            if ($('#act').val() == 'stock_export') {
                showNoti('Part không tồn tại trong ' + $('#cpoid').find('option[value="' + $('#cpoid').val() + '"]').text().split(' - ')[1], 'Cảnh báo', 'War');
            }
            if ($('#act').val() == 'stock_import') {
                showNoti('Part không tồn tại trong ' + $('#scid').find('option[value="' + $('#scid').val() + '"]').text().split(' - ')[1], 'Cảnh báo', 'War');
            }
            return false;
        }
        var flagQty = false;
        $('#itemList tbody tr').each(function() {
            if ($(this).find('td.quantity .qtyItem').val() <= 0) {
                $(this).find('td.quantity .qtyItem').css('border-color', 'red');
                flagQty = true;
            }
        });

        if (flagQty) {
            $('.group-process [type="button"]').removeAttr('disabled', true);
            showNoti('Số lượng phải lớn hơn 0', 'Lỗi nhập liệu', 'Err');
            return false;
        }

        if ($('#act').val() != 'stock_export') {
            event.preventDefault();
            var arrID = [];
            var arrLotcode = [];
            var arrPart = [];
            var arrCPO = [];
            var flagLot = false;
            $('#itemList tbody tr').each(function() {
                $(this).find('td.quantity .qtyItem').removeAttr('style');
                if ($(this).find('td.lot_code input').val() == '' || ($('#act').val() != 'stock_begin' && $(this).find('td.packaging select').val() == '') || ($('#act').val() != 'stock_begin' && $(this).find('td.coo select').val() == '') || $(this).find('td.end_sell_date input.bootstrap-datepicker').val() == '') {
                    flagLot = true;
                    return false;
                } else {
                    arrID.push($(this).find('td.stt input.idItem').val());
                    arrLotcode.push($(this).find('td.lot_code input').val());
                    arrPart.push($(this).find('td.part_number .supplier-part').val());
                    arrCPO.push($(this).find('td.cpo select').val());
                }
            });
            if (flagLot){
                $('.group-process [type="button"]').removeAttr('disabled', true);
                showNoti('Kiểm tra 1 số trường bắt buộc <b>(*)</b> không được trống', 'Lỗi nhập liệu', 'Err');
            } else {
                if(Array.isArray(arrLotcode) && Array.isArray(arrPart)) {
                    $.ajax({
                        url: site_url + 'stock_inout/checkLotcode',
                        type: 'POST',
                        data: {
                            arrID: arrID,
                            arrLotcode: arrLotcode,
                            arrPart: arrPart,
                            arrCPO: arrCPO,
                            warehouse: $('#warehouseid').val(),
                            year: $('#create_date').val(),
                        },
                        success: function(arr) {
                            if (arr != '') {
                                var getData = $.parseJSON(arr);
                                if (Array.isArray(getData)) {
                                    for (var i = 0; i < getData.length; i++) {
                                        $('#itemList').find('td.lot_code input').filter(function() { return this.value == getData[i] }).css('border-color', 'red');
                                        flagLot = true;
                                    }
                                }
                            }
                            if(flagLot){
                                $('.group-process [type="button"]').removeAttr('disabled', true);
                                showNoti('Lot code đã tồn tại', 'Cảnh báo', 'War');
                            } else {
                                console.log('ok');
                                event.currentTarget.submit();
                            }
                        }
                    })
                }
            }
            console.log('fail');
        }
    });

    $('#importRow, #updateRow').click(function() {
        var starRow = parseInt($('#starRow').val());
        var endRow = parseInt($('#endRow').val());
        var dataRow = parseInt($('#sheetData tr').length) - 1;
        var rowSelect = parseInt($('#sheetData tr.excel-selected').length);
        index = starRow;
        num = (endRow > dataRow || isNaN(endRow) || endRow == 0) ? dataRow : endRow;
        $('#sheetData tr').removeClass('updated notfound');
        $('.progress-bar').css({
            width: '0%'
        });
        $('#person').text('0% (' + index + '/' + num + ')');
        if ($(this).attr('id') == 'updateRow') {
            setTimeout(function() {
                update_row();
            }, 500);
        } else {
            setTimeout(function() {
                import_row();
            }, 500);
        }
        return false;
    });

});
function sum_item(row) {
    var USDExchangeRate = parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
    var qty = parseInt(row.find('.qtyItem').val().replace(/\s/g, '').replace(/,/g, ''));
    var priceusd = parseFloat(row.find('.priceUSDItem').val().replace(/\s/g, '').replace(/,/g, ''));
    var pricevnd = accounting.formatMoney(priceusd * USDExchangeRate, '', 0).replace(/\s/g, '').replace(/,/g, '');
    var amountusd = qty * priceusd;
    var amountvnd = qty * pricevnd;
    var VAT = parseFloat(row.find('.VATUSDItem').val());
    row.find('.priceVNDItem').val(accounting.formatMoney(pricevnd, '', 0));
    row.find('.amountUSDItem').val(accounting.formatMoney(amountusd, '', 2));
    row.find('.amountVNDItem').val(accounting.formatMoney(amountvnd, '', 0));

    // var amountUSD = parseFloat(parent.find('.amountUSDItem').val().replace(/,/g,''));
    if (VAT > 0) {
        row.find('.amountVATVNDItem').val(accounting.formatMoney(parseFloat(amountvnd + (amountvnd * VAT / 100)), '', 0));
    } else {
        row.find('.amountVATVNDItem').val(0);
    }
    sum_all();
}

function sum_all() {
    var totalAmountVND = 0.0,
        totalAmountUSD = 0.0,
        totalQty = 0;

    if ($('#itemList .amountUSDItem').length > 0) {
        $('#itemList .qtyItem').each(function() {
            totalQty += parseInt($(this).val().replace(/,/g, ''));
        });
        $('#totalQty').val(accounting.formatMoney(totalQty, '', 0));

        $('#itemList .amountUSDItem').each(function() {
            totalAmountUSD += parseFloat($(this).val().replace(/,/g, ''));
        });
        $('#totalAmountUSD').val(accounting.formatMoney(totalAmountUSD, '', 2));

        $('#itemList .amountVNDItem').each(function() {
            totalAmountVND += parseFloat($(this).val().replace(/,/g, ''));
        });
        $('#totalAmountVND').val(accounting.formatMoney(totalAmountVND, '', 0));
    } else {
        $('#totalAmount').val(0);
    }
}

function add_item(data) {
    var flagModule = false;
    var flagWarehouse = false;
    if ($('#act').val() == 'stock_export') flagModule = true;
    if ($('#warehouseid').val() == 1) flagWarehouse = true;
    var key = data.key;
    var stt = $('#itemList .highlightNoClick').length + 1;
    var html = '<tr class="highlightNoClick" data-lot_code="' + data.lot_code + '">' +
        '<td class="list-col center del"><a href="javascript:;" data-placement="bottom" title="Xoá" class="tooltip-link font-size-18"><i class="glyph-icon icon-remove"></i></a></td>' +
        '<td class="list-col center stt">' +
        '<span>' + stt + '</span>' +
        '<input name="details[' + key + '][category]" type="hidden" value="' + data.category + '">' +
        '<input type="hidden" name="details[' + key + '][sort]" class="keyItem" value="' + key + '">' +
        '<input type="hidden" name="details[' + key + '][id]" class="idItem" value="">';

    html += '<input type="hidden" class="keyItem" value="' + key + '">' +
        '</td>' +
        '<td class="list-col center"><a href="javascript:;" name="details[' + key + '][list]" class="btn btn-default btn-list-old"><i class="glyph-icon icon-list-alt"></i></a></td>' +
        '<td class="list-col cpo" style="width: 200px; min-width: 200px; max-width: 200px"><select  name="details[' + key + '][cpo]" id="selCPO' + key + '" class="form-control" data-required="1"></select><div class="errordiv selCPO' + key + '"><div class="arrow"></div>Not empty!</div><input type="hidden" id="cponohd' + key + '" name="details[' + key + '][cpono]" value="' + data.cpo + '"></td>' +
        '<td class="list-col sc" style="width: 200px; min-width: 200px; max-width: 200px"><select name="details[' + key + '][sc]" id="selSC' + key + '" class="form-control"></select><div class="errordiv selSC' + key + '"><div class="arrow"></div>Not empty!</div><input type="hidden" id="scnohd' + key + '" name="details[' + key + '][scno]" value="' + data.sc + '"></td>' +
        '<td class="list-col po"><input type="hidden" id="pohd' + key + '" name="details[' + key + '][po]" class="form-control" value="' + data.poid + '"/><input type="hidden" id="ponohd' + key + '" name="details[' + key + '][pono]" value="' + data.po + '"><span>' + data.po + '</span></td>' +
        '<td class="list-col cus"><input type="hidden" id="cushd' + key + '" name="details[' + key + '][cus]" class="form-control" value="' + data.cusid + '"/><input type="hidden" id="cusnamehd' + key + '" name="details[' + key + '][cusname]" value="' + data.cusname + '"><span>' + (data.cusid > 0 ? data.cusid + ' - ' + data.cusname : '') + '</span></td>' +
        '<td class="list-col import_method"><input type="text" name="details[' + key + '][import_method]" class="form-control" value="' + data.import_method + '"/></td>' +
        '<td class="list-col lot_no"><input type="text" name="details[' + key + '][lot_no]" class="form-control" value="' + data.lot_no + '"/></td>' +
        '<td class="list-col lot_code"><input type="text" id="lot_code_' + key + '" name="details[' + key + '][lot_code]" class="form-control inpd-required" value="' + data.lot_code + '" data-required="1"/><div class="errordiv lot_code_' + key + '"><div class="arrow"></div>Not empty!</div></td>' +
        '<td class="list-col part_number">' + data.supplier_part.replace('&', '&amp;') + '<input name="details[' + key + '][supplier_part]" type="hidden" id="supplier_part_' + key + '" class="form-control supplier-part" value="' + data.supplier_part + '"><div class="errordiv supplier_part_' + key + '"><div class="arrow"></div>Not empty!</div></td>' +
        '<td class="list-col mfr_number">' + data.manufacturer_part_number.replace('&', '&amp;') + '<input name="details[' + key + '][manufacturer_part_number]" type="hidden" class="form-control" value="' + data.manufacturer_part_number + '"></td>' +
        '<td class="list-col description"><input type="text" name="details[' + key + '][description]" class="form-control expand" value="' + data.description + '"/></td>' +
        '<td class="list-col manufacturer"><input type="text" name="details[' + key + '][manufacturer]" class="form-control expand" value="' + data.manufacturer + '"/></td>';
    // '<td class="list-col manufacturer" style="width: 200px; min-width: 200px; max-width: 200px"><select name="details[' + key + '][manufacturer]" id="selMFR' + key + '" class="form-control"></select></td>';

    html += '<td class="list-col package_case' + (flagModule ? ' disabled' : '') + '"><input type="text" name="details[' + key + '][package_case]" class="form-control" value="' + data.package_case + '"/></td>' +
        '<td class="list-col packaging' + (flagModule ? ' disabledd' : '') + '"><select name="details[' + key + '][packaging]" id="packaging_' + key + '" class="form-control"' + (flagWarehouse ? '' : 'data-required="1"') + '></select><div class="errordiv packaging_' + key + '"><div class="arrow"></div>Not empty!</div></td>' +
        '<td class="list-col spq' + (flagModule ? ' disabled' : '') + '"><input type="text" name="details[' + key + '][spq]" class="form-control" value="' + data.spq + '"/></td>' +
        '<td class="list-col date_code' + (flagModule ? ' disabled' : '') + '"><input type="text" name="details[' + key + '][date_code]" class="form-control" value="' + data.date_code + '"/></td>' +
        '<td class="list-col coo' + (flagModule ? ' disabledd' : '') + '" style="width: 100px; min-width: 100px; max-width: 100px"><select name="details[' + key + '][coo]" id="coo_' + key + '" class="form-control"' + (flagWarehouse ? '' : 'data-required="1"') + '></select><div class="errordiv coo_' + key + '"><div class="arrow"></div>Not empty!</div></td>' +

        '<td class="list-col firmware' + (flagModule ? ' disabled' : '') + '"><input type="text" name="details[' + key + '][firmware]" class="form-control" value="' + data.firmware + '"/></td>' +
        '<td class="list-col imei' + (flagModule ? ' disabled' : '') + '"><input type="text" name="details[' + key + '][imei]" class="form-control" value="' + data.imei + '"/></td>' +
        '<td class="list-col warehouse' + (flagModule ? ' disabled' : '') + '"><input type="text" name="details[' + key + '][warehouse]" class="form-control" value="' + data.warehouse + '"/></td>' +
        '<td class="list-col minimum_stock' + (flagModule ? ' disabled' : '') + '"><input type="text" name="details[' + key + '][minimum_stock]" class="form-control" value="' + data.minimum_stock + '"/></td>' +
        '<td class="list-col end_sell_date' + (flagModule ? ' disabled' : '') + '"><input type="hidden" class="date_added" value="' + data.date_added + '"><div class="input-group-text"><input type="text" id="esd_' + key + '" name="details[' + key + '][end_sell_date]" class="form-control bootstrap-datepicker etd-control" value="' + data.end_sell_date + '"' + (flagWarehouse ? '' : 'data-required="1"') + '/><input type="text" name="details[' + key + '][end_sell_date_numb]" class="form-control etd-control-plus bootstrap-date-plus bootstrap-date-plus' + key + '" value="' + data.end_sell_date_numb + '" placeholder="Day"></div><div class="errordiv esd_' + key + '"><div class="arrow"></div>Not empty!</div></td></td>';

    html += '<td class="list-col right quantity"><input type="text" name="details[' + key + '][qty]" class="form-control qtyItem order-qty" value="' + (flagModule ? 0 : data.qty) + '"/></td>' +
        '<td class="list-col right unit_price_usd"><input type="hidden" class="priceUSDItemHide" value="' + data.priceusd + '"><input type="text" name="details[' + key + '][priceusd]" class="form-control priceUSDItem unit-price-usd" value="' + data.priceusd + '"/></td>' +
        '<td class="list-col right unit_price_vnd"><input type="text" name="details[' + key + '][pricevnd]" class="form-control priceVNDItem no-border unit-price-vnd" value="' + data.pricevnd + '"/></td>' +
        '<td class="list-col right amount_usd"><input type="text" name="details[' + key + '][amountusd]" class="form-control amountUSDItem no-border" value="0" readonly/></td>' +
        '<td class="list-col right amount_vnd"><input type="text" name="details[' + key + '][amountvnd]" class="form-control amountVNDItem no-border" value="0" readonly/></td>' +
        '<td class="list-col right import_tax' + (flagModule ? ' hidden' : '') + '"><input type="text" name="details[' + key + '][import_tax]" class="form-control TAXItem TAXItem' + key + '" value="' + data.import_tax + '"/></td>' +
        '<td class="list-col right vat"><input type="text" name="details[' + key + '][vat]" class="form-control VATUSDItem" value="' + data.vat + '"/></td>' +
        '<td class="list-col right amount_vat"><input type="text" name="details[' + key + '][amount_vat]" class="form-control amountVATVNDItem" value="' + data.amount_vat + '"/></td>';

    $('#itemList tbody').append(html);

    $('.money').autoNumeric('init', {
        'mDec': 0
    });

    $('.money2').autoNumeric('init', {
        'mDec': 2
    });

    $('.money3').autoNumeric('init', {
        'mDec': 3
    });

    $('.money4').autoNumeric('init', {
        'mDec': 4
    });

    // for (var i = 0; i < $('#itemList .highlightNoClick').length; i++) {
    //     $('#itemList .highlightNoClick:eq(' + i + ') td:eq(1) span').text(i + 1);
    // }
    $('#selMFR' + key).append(optionMFR).chosen({allow_single_deselect: true});
    $('#coo_' + key).append(optionCountry).chosen({allow_single_deselect: true});
    $('#coo_' + key).val(data.coo).trigger('chosen:updated');
    $('#packaging_' + key).append(optionPackaging).chosen({allow_single_deselect: true});
    $('#packaging_' + key).val(data.packaging).trigger('chosen:updated');
    $('#selCPO' + key).append(optionCPO).val(data.cpoid).chosen({allow_single_deselect: true});
    $('#selSC' + key).append(optionSC).val(data.scid).chosen({allow_single_deselect: true});
    $('#selMFR' + key + '_chosen .chosen-single div, #selCPO' + key + '_chosen .chosen-single div, #coo_' + key + '_chosen .chosen-single div, #packaging_' + key + '_chosen .chosen-single div, #selSC' + key + '_chosen .chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
    // $('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
    $('.bootstrap-date-plus').trigger('change');
    sum_item($('#itemList .highlightNoClick:last-child'));
    if (data.end_sell_date != '') {
        var newDate = new Date();
        estimateDate($('.bootstrap-date-plus' + key), _today());
    }
    if (data.import_tax != '') {
        handleTAX($('.TAXItem' + key));
    }
    $('#itemList .bootstrap-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        autoclose: true,
        todayHighlight: true
    });
    // }
}

$(document).ready(function() {
    // $('#sheetPreview').css({
    //     width: $(window).width() - 400 + 'px'
    // });

    $('#starRow').on('change', function() {
        $('#endRow option').attr('disabled', false);
        for (i = 0; i < parseInt($(this).val()) - 1; i++) {
            $('#endRow option:eq(' + i + ')').attr('disabled', true);
        }
        $('#endRow option:last-child').prop('selected', true);
        $('#endRow').trigger('chosen:updated');

        $('#sheetData tr').removeClass('excel-selected');
        for (i = parseInt($(this).val()); i <= parseInt($('#endRow').val()); i++) {
            $('#sheetData #row' + i).addClass('excel-selected');
        }
        check_exists();
    });

    $('#endRow').on('change', function() {
        $('#sheetData tr').removeClass('excel-selected');
        for (i = parseInt($('#starRow').val()); i <= parseInt($(this).val()); i++) {
            $('#sheetData #row' + i).addClass('excel-selected');
        }
        check_exists();
    });

    $('#headerRow').on('change', function() {
        var headerRow = parseInt($(this).val());
        $('.field-update').empty().append('<option value="">Chọn ...</option>');
        $('#sheetData tr').removeClass('excel-header');
        $('#sheetData #row' + headerRow).addClass('excel-header').find('td:not(.excel-left)').each(function() {
            $('.field-update').append('<option value="' + $(this).data('col') + '" data-fieldname="' + $(this).text() + '">' + $(this).data('col') + ' - ' + $(this).text() + '</option>');
        });
        $('.field-update').each(function() {
            var fieldname = $(this).data('fieldname');
            $(this).find('option[data-fieldname="' + fieldname + '"]').attr('selected', 'selected');
        });
        $('.field-update').trigger('chosen:updated');
        check_exists();
    });

    $('#supplier_part').change(function() {
        check_exists();
    });

    $('#sheet').on('change', function() {
        read_sheet($(this).val());
    });

    if ($('#fileuploader').length) {
        var dir = $('#fileuploader').data('dir');
        $('#fileuploader').uploadFile({
            url: site_url + 'ajax/upload',
            fileName: 'myfile',
            formData: {
                dir: dir
            },
            uploadButtonClass: 'btn btn-border btn-alt btn-hover border-primary font-primary waves-effect',
            dragDropStr: '<span> Kéo và thả file ở đây</span>',
            allowedTypes: 'xlsx,xls',
            uploadErrorStr: 'File không đúng danh mục!',
            onSubmit: function(files) {
                var starRow = parseInt($('#starRow').val());
                var endRow = parseInt($('#endRow').val());
                if (endRow < starRow && endRow > 0) {
                    showNoti('Vị trí dòng bắt đầu lớn hơn dòng kết thúc!', 'Lỗi nhập liệu', 'Err');
                    return false;
                }
            },
            onSuccess: function(files, data, xhr) {
                $('[type="submit"], [type="button"]').attr('disabled', true);

                showNoti('Đang đọc dữ liệu file. Vui lòng đợi!', 'Upload file thành công', 'War');
                showProcess(1);

                $('#fileName').val(data.split('/').pop());

                read_sheet($('#sheet').val());
            }
        });
    }

    $('#addRowstock').on('click', function() {
        var key = 1;
        if ($('#itemList .highlightNoClick').length) {
            key = parseInt($('#itemList .highlightNoClick:last-child .keyItem').val()) + 1;
        }

        var data = {
            key: key,
            category: '',
            cpo: '',
            cpoid: '',
            sc: '',
            po: '',
            poid: '',
            cus: '',
            cusid: '',
            import_method: '',
            lot_no: '',
            lot_code: '',
            supplier_part: '',
            manufacturer_part_number: '',
            description: '',
            manufacturer: '',
            package_case: '',
            packaging: '',
            spq: '',
            date_code: '',
            coo: '',
            firmware: '',
            imei: '',
            warehouse: ($('#warehouseid').val() > 0 ? $('#warehouseid').val() : 0),
            minimum_stock: 0,
            end_sell_date: '',
            qty: 0,
            priceusd: 0,
            pricevnd: 0,
            vat: 10,
            import_tax: 0,
        };
        add_item(data);
        $('#itemList input[name="details[' + key + '][supplier_part]"').attr('type', 'text').attr('data-required', 1);
        $('#itemList input[name="details[' + key + '][manufacturer_part_number]"').attr('type', 'text');
    })
});

function read_sheet(sheet) {
    $.ajax({
        url: site_url + 'ajax/read_sheet',
        type: 'POST',
        data: {
            file: $('#fileName').val(),
            sheet: sheet
        },
        dataType: 'json',
        success: function(data) {
            if (data == '') {
                showNoti('Tệp tin không tồn tại!', 'Không thể đọc thông tin file', 'Err');
            } else {
                var headerRow = parseInt($('#headerRow').val());
                var html = '';

                $('#sheet').empty();
                for (i = 0; i < data.sheets.length; i++) {
                    $('#sheet').append('<option value="' + i + '"' + (i == sheet ? ' selected="selected"' : '') + '>' + data.sheets[i] + '</option>');
                }
                $('#sheet').trigger('chosen:updated');

                $('#headerRow, #starRow, #endRow').empty();
                $.each(data.sheetData, function(i, row) {
                    if (i == 1) {
                        html += '<tr>';
                        $.each(row, function(columnLetter, value) {
                            if (columnLetter == 'A') {
                                html += '<td class="excel-top"><div class="excel-angel"></div></td>';
                            }
                            html += '<td class="excel-top">' + columnLetter + '</td>';
                        });
                        html += '</tr>';
                    }
                    html += '<tr id="row' + i + '"' + (i == headerRow ? ' class="excel-header"' : '') + '>';
                    $.each(row, function(columnLetter, value) {
                        if (columnLetter == 'A') {
                            html += '<td class="excel-left">' + i + '</td>';
                        }
                        html += '<td data-col="' + columnLetter + '" nowrap="nowrap" class="excel-cell">' + (value != null ? value : '') + '</td>';
                        if (i == headerRow) {
                            $('.field-update').append('<option value="' + columnLetter + '" data-fieldname="' + value + '">' + columnLetter + ' - ' + value + '</option>');
                        }
                    });
                    html += '</tr>';
                    $('#headerRow, #starRow, #endRow').append('<option value="' + i + '">' + i + '</option>');
                });

                $('#starRow').val(2);
                for (i = 0; i < parseInt($('#starRow').val()) - 1; i++) {
                    $('#endRow option:eq(' + i + ')').attr('disabled', true);
                }
                $('#endRow option:last-child').prop('selected', true);

                $('.field-update').each(function() {
                    var fieldname = $(this).data('fieldname');
                    $(this).find('option[data-fieldname="' + fieldname + '"]').attr('selected', 'selected');
                });
                $('#sheetData').html(html);
                $('#sheet, #starRow, #endRow, #headerRow, .field-update').attr('disabled', false).trigger('chosen:updated');

                $('#sheetData tr').removeClass('excel-selected');
                for (i = parseInt($('#starRow').val()); i <= parseInt($('#endRow').val()); i++) {
                    $('#sheetData #row' + i).addClass('excel-selected');
                }

                $('[type="submit"], [type="button"]').attr('disabled', false);
                $('#person').text('0% (0/' + (parseInt($('#sheetData tr').length) - 1) + ')');
                check_exists();
                $('.amaran-wrapper').remove();
                hideLoading();
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            showNoti('Lỗi:' + xhr.status + ' ' + thrownError, 'Không thể đọc thông tin file', 'Err');
        }
    });
}

function check_exists() {
    var supplier_part_col = $('#supplier_part').val();
    $('#sheetData .excel-selected').removeClass('exists');
    $('#sheetData .excel-selected [data-col="' + supplier_part_col + '"]').each(function() {
        var supplier_part = $(this).text();
        if ($('#itemList tbody tr[data-supplier_part="' + supplier_part + '"]').length) {
            $(this).parent().addClass('exists');
        }
    });
}

function import_row() {
    var tr = $('#sheetData tr:eq(' + index + ')');
    var supplier_part_col = $('#supplier_part').val();
    var supplier_part = tr.find('[data-col="' + supplier_part_col + '"]').text().trim();
    if (!tr.hasClass('exists') && supplier_part) {
        $.ajax({
            url: site_url + 'stock_inout/get_category',
            type: 'POST',
            data: {
                part: supplier_part
            },
            success: function(string) {
                // if (category && arrqp.includes(supplier_part)) {
                var getData = $.parseJSON(string);
                if (string != 0) {
                    var lot_no_col = $('#lot_no').val();
                    var lot_no = tr.find('[data-col="' + lot_no_col + '"]').text().trim();
                    var import_method_col = $('#import_method').val();
                    var import_method = tr.find('[data-col="' + import_method_col + '"]').text().trim();
                    var lot_code_col = $('#lot_code').val();
                    var lot_code = tr.find('[data-col="' + lot_code_col + '"]').text().trim();
                    var manufacturer_part_number_col = $('#manufacturer_part_number').val();
                    var manufacturer_part_number = tr.find('[data-col="' + manufacturer_part_number_col + '"]').text().trim();
                    var firmware_col = $('#firmware').val();
                    var firmware = tr.find('[data-col="' + firmware_col + '"]').text().trim();
                    var imei_col = $('#imei').val();
                    var imei = tr.find('[data-col="' + imei_col + '"]').text().trim();
                    var manufacturer_col = $('#manufacturer').val();
                    var manufacturer = tr.find('[data-col="' + manufacturer_col + '"]').text().trim();
                    var description_col = $('#description').val();
                    var description = tr.find('[data-col="' + description_col + '"]').text().trim();
                    var date_code_col = $('#date_code').val();
                    var date_code = tr.find('[data-col="' + date_code_col + '"]').text().trim();
                    var coo_col = $('#coo').val();
                    var coo = tr.find('[data-col="' + coo_col + '"]').text().trim();
                    var packaging_col = $('#packaging').val();
                    var packaging = tr.find('[data-col="' + packaging_col + '"]').text().trim();
                    var minimum_stock_col = $('#minimum_stock').val();
                    var minimum_stock = tr.find('[data-col="' + minimum_stock_col + '"]').text().trim();
                    var end_sell_date_col = $('#end_sell_date').val();
                    var end_sell_date = tr.find('[data-col="' + end_sell_date_col + '"]').text().trim();
                    var package_case_col = $('#package_case').val();
                    var package_case = tr.find('[data-col="' + package_case_col + '"]').text().trim();
                    var spq_col = $('#spq').val();
                    var spq = tr.find('[data-col="' + spq_col + '"]').text().trim();
                    var qty_col = $('#qty').val();
                    var qty = parseInt(tr.find('[data-col="' + qty_col + '"]').text().replace(/\s/g, '').replace(/,/g, ''));
                    var priceusd_col = $('#priceusd').val();
                    var priceusd = parseFloat(tr.find('[data-col="' + priceusd_col + '"]').text().replace('$', '').replace('đ', '').replace('₫', '').replace(/\s/g, '').replace(/,/g, ''));
                    var pricevnd_col = $('#pricevnd').val();
                    var pricevnd = parseInt(tr.find('[data-col="' + pricevnd_col + '"]').text().replace('$', '').replace('đ', '').replace('₫', '').replace(/\s/g, '').replace(/,/g, ''));
                    var warehouse_col = $('#warehouse').val();
                    var warehouse = tr.find('[data-col="' + warehouse_col + '"]').text().trim();
                    if ($('#itemList .highlightNoClick').length) {
                        var key = parseInt($('#itemList .highlightNoClick:last-child .keyItem').val()) + 1;
                    } else {
                        var key = 1;
                    }
                    var data = {
                        key: key,
                        category: getData.category,
                        cpo: '',
                        cpoid: '',
                        sc: '',
                        po: '',
                        poid: '',
                        cus: '',
                        cusid: '',
                        import_method: import_method,
                        lot_no: lot_no,
                        lot_code: lot_code,
                        supplier_part: supplier_part,
                        manufacturer_part_number: manufacturer_part_number,
                        description: description,
                        manufacturer: manufacturer,
                        package_case: package_case,
                        packaging: packaging,
                        spq: spq,
                        date_code: date_code,
                        coo: coo,
                        firmware: firmware,
                        imei: imei,
                        // warehouse: warehouse,
                        warehouse: $('#warehouseid').val(),
                        minimum_stock: minimum_stock ? minimum_stock : 0,
                        end_sell_date: end_sell_date,
                        qty: isNaN(qty) ? 1 : qty,
                        priceusd: isNaN(priceusd) ? 0 : priceusd,
                        pricevnd: isNaN(pricevnd) ? (isNaN(priceusd) ? 0 : priceusd * parseInt($('#USDExchangeRate').val())) : pricevnd,
                        vat: 10,
                        import_tax: 0,
                    };
                    tr.addClass('updated');
                    add_item(data);
                    // sum_item($('#itemList .highlightNoClick:last-child'));
                } else {
                    tr.addClass('notfound');
                }
                var percent = (index / num * 100).toFixed(0);
                $('.progress-bar').css({
                    width: percent + '%'
                });

                $('#person').text(percent + '% (' + index + '/' + num + ')');
                index++;

                if (index <= num) {
                    import_row();
                } else {
                    if ($('#sheetData .notfound').length) {
                        showNoti('Có ' + $('#sheetData .notfound').length + ' mục không tìm thấy danh mục', 'Cảnh báo!', 'War');
                    } else {
                        $('[data-dismiss="modal"]').click();
                    }
                }
            }
        });
    } else {
        var percent = (index / num * 100).toFixed(0);
        $('.progress-bar').css({
            width: percent + '%'
        });

        $('#person').text(percent + '% (' + index + '/' + num + ')');
        index++;

        if (index <= num) {
            import_row();
        } else {
            $('[data-dismiss="modal"]').click();
        }
    }
}

function update_row() {
    var tr = $('#sheetData tr:eq(' + index + ')');
    var lot_code_col = $('#lot_code').val();
    var lot_code = tr.find('[data-col="' + lot_code_col + '"]').text().trim();
    var supplier_part_col = $('#supplier_part').val();
    var supplier_part = tr.find('[data-col="' + supplier_part_col + '"]').text().trim();
    if (!tr.hasClass('exists') && supplier_part && lot_code) {
        $.ajax({
            url: site_url + 'stock_inout/checkPartUpdate',
            type: 'POST',
            data: {
                lot_code: lot_code,
                part: supplier_part,
                id: $('#id').val()
            },
            success: function(string) {
                if (string != 0) {
                    var getData = $.parseJSON(string);
                    var lot_no_col = $('#lot_no').val();
                    var lot_no = tr.find('[data-col="' + lot_no_col + '"]').text().trim();
                    var import_method_col = $('#import_method').val();
                    var import_method = tr.find('[data-col="' + import_method_col + '"]').text().trim();
                    var manufacturer_part_number_col = $('#manufacturer_part_number').val();
                    var manufacturer_part_number = tr.find('[data-col="' + manufacturer_part_number_col + '"]').text().trim();
                    var firmware_col = $('#firmware').val();
                    var firmware = tr.find('[data-col="' + firmware_col + '"]').text().trim();
                    var imei_col = $('#imei').val();
                    var imei = tr.find('[data-col="' + imei_col + '"]').text().trim();
                    var manufacturer_col = $('#manufacturer').val();
                    var manufacturer = tr.find('[data-col="' + manufacturer_col + '"]').text().trim();
                    var description_col = $('#description').val();
                    var description = tr.find('[data-col="' + description_col + '"]').text().trim();
                    var date_code_col = $('#date_code').val();
                    var date_code = tr.find('[data-col="' + date_code_col + '"]').text().trim();
                    var coo_col = $('#coo').val();
                    var coo = tr.find('[data-col="' + coo_col + '"]').text().trim();
                    var packaging_col = $('#packaging').val();
                    var packaging = tr.find('[data-col="' + packaging_col + '"]').text().trim();
                    var minimum_stock_col = $('#minimum_stock').val();
                    var minimum_stock = tr.find('[data-col="' + minimum_stock_col + '"]').text().trim();
                    var end_sell_date_col = $('#end_sell_date').val();
                    var end_sell_date = tr.find('[data-col="' + end_sell_date_col + '"]').text().trim();
                    var package_case_col = $('#package_case').val();
                    var package_case = tr.find('[data-col="' + package_case_col + '"]').text().trim();
                    var spq_col = $('#spq').val();
                    var spq = tr.find('[data-col="' + spq_col + '"]').text().trim();
                    var qty_col = $('#qty').val();
                    var qty = parseInt(tr.find('[data-col="' + qty_col + '"]').text().replace(/\s/g, '').replace(/,/g, ''));
                    var priceusd_col = $('#priceusd').val();
                    var priceusd = parseFloat(tr.find('[data-col="' + priceusd_col + '"]').text().replace('$', '').replace('đ', '').replace('₫', '').replace(/\s/g, '').replace(/,/g, ''));
                    var pricevnd_col = $('#pricevnd').val();
                    var pricevnd = parseInt(tr.find('[data-col="' + pricevnd_col + '"]').text().replace('$', '').replace('đ', '').replace('₫', '').replace(/\s/g, '').replace(/,/g, ''));
                    // var warehouse_col = $('#warehouse').val();
                    // var warehouse = tr.find('[data-col="' + warehouse_col + '"]').text().trim();
                    if (getData.parent && getData.parent > 0) {
                        var trUpdate = $('#itemList tbody tr.highlightNoClick[data-lot_code="' + getData.lot_code + '"]');
                        if (qty_col != '') trUpdate.find('.qtyItem').val(isNaN(qty) ? 1 : qty);
                        if (priceusd_col != '') trUpdate.find('.priceUSDItem').val(isNaN(priceusd) ? 0 : priceusd);
                        if (minimum_stock_col != '') trUpdate.find('td.minimum_stock input').val(isNaN(minimum_stock) ? 0 : minimum_stock);
                        if (imei_col != '') trUpdate.find('td.imei input').val(imei);
                        if (firmware_col != '') trUpdate.find('td.firmware input').val(firmware);
                        if (coo_col != '') trUpdate.find('td.coo select').val(coo).trigger('chosen:updated');
                        if (date_code_col != '') trUpdate.find('td.date_code input').val(date_code);
                        if (spq_col != '') trUpdate.find('td.spq input').val(spq);
                        if (packaging_col != '') trUpdate.find('td.packaging select').val(packaging).trigger('chosen:updated');
                        if (package_case_col != '') trUpdate.find('td.package_case input').val(package_case);
                        if (end_sell_date != '') trUpdate.find('td.end_sell_date .bootstrap-date-plus').val(end_sell_date).trigger('change');
                        if (manufacturer_col != '') trUpdate.find('td.manufacturer input').val(manufacturer);
                        if (description_col != '') trUpdate.find('td.description input').val(description);
                        if (lot_no_col != '') trUpdate.find('td.lot_no input').val(lot_no);
                        tr.addClass('update');
                        sum_item(trUpdate);
                    } else {
                        if ($('#itemList .highlightNoClick').length) {
                            var key = parseInt($('#itemList .highlightNoClick:last-child .keyItem').val()) + 1;
                        } else {
                            var key = 1;
                        }
                        var data = {
                            key: key,
                            category: getData.category,
                            cpo: '',
                            cpoid: '',
                            sc: '',
                            po: '',
                            poid: '',
                            cus: '',
                            cusid: '',
                            import_method: import_method,
                            lot_no: lot_no,
                            lot_code: lot_code,
                            supplier_part: supplier_part,
                            manufacturer_part_number: manufacturer_part_number,
                            description: description,
                            manufacturer: manufacturer,
                            package_case: package_case,
                            packaging: packaging,
                            spq: spq,
                            date_code: date_code,
                            coo: coo,
                            firmware: firmware,
                            imei: imei,
                            warehouse: $('#warehouseid').val(),
                            minimum_stock: minimum_stock ? minimum_stock : 0,
                            end_sell_date: end_sell_date,
                            qty: isNaN(qty) ? 1 : qty,
                            priceusd: isNaN(priceusd) ? 0 : priceusd,
                            pricevnd: isNaN(pricevnd) ? (isNaN(priceusd) ? 0 : priceusd * parseInt($('#USDExchangeRate').val())) : pricevnd,
                            vat: 10,
                            import_tax: 0,
                        };
                        tr.addClass('updated');
                        add_item(data);
                    }
                } else {
                    tr.addClass('notfound');
                }
                var percent = (index / num * 100).toFixed(0);
                $('.progress-bar').css({
                    width: percent + '%'
                });

                $('#person').text(percent + '% (' + index + '/' + num + ')');
                index++;

                if (index <= num) {
                    update_row();
                } else {
                    if ($('#sheetData .notfound').length) {
                        showNoti('Có ' + $('#sheetData .notfound').length + ' mục không tìm thấy danh mục', 'Cảnh báo!', 'War');
                        $('#updateRow').attr('disabled');
                    } else {
                        $('[data-dismiss="modal"]').click();
                    }
                }
            }
        })
    }
}

function updateDataItem(e) {
    var Orqty = parseFloat(e.find('.order-qty').val().replace(/\s/g, '').replace(/,/g, ''));
    var totalAmountUSD = 0;
    var totalAmountVND = 0;
    if (Orqty < 0) {
        Orqty = 0;
    }
    //var amountVND = (Orqty * priceUSD) * parseFloat($('#USDExchangeRate').val().replace(/\s/g, '').replace(/,/g, ''));
    var priceUSD = parseFloat(e.find('.unit-price-usd').val().replace(/\s/g, '').replace(/,/g, ''));
    var priceVND = parseFloat(e.find('.unit-price-vnd').val().replace(/\s/g, '').replace(/,/g, ''));
    var amountVND = Orqty * priceVND;
    e.find('.amountUSDItem').val(accounting.formatMoney(Orqty * priceUSD, '', 2));
    e.find('.amountVNDItem').val(accounting.formatMoney(amountVND, '', 0));

    $('#itemList .amountUSDItem').each(function() {
        totalAmountUSD += parseFloat($(this).val().replace(/,/g, ''));
    });
    $('#totalAmountUSD').val(accounting.formatMoney(totalAmountUSD, '', 2));

    $('#itemList .amountVNDItem').each(function() {
        totalAmountVND += parseFloat($(this).val().replace(/,/g, ''));
    });
    $('#totalAmountVND').val(accounting.formatMoney(totalAmountVND, '', 0));

    updateDataSum();
}

function updateDataSum() {}

function handleTAX(inp) {
    var parent = inp.closest('tr');
    var val = inp.val();
    var priceUSDItemHide = parseFloat(parent.find('.priceUSDItemHide').val().replace(/,/, ''));
    var amountUSDItem = parent.find('.amountUSDItem');
    var priceUSDItemTAX = parseFloat(priceUSDItemHide + (priceUSDItemHide * val / 100));
    parent.find('.priceUSDItem').val(accounting.formatMoney(priceUSDItemTAX, '', 4));
    amountUSDItem.val(accounting.formatMoney(parseFloat(priceUSDItemTAX * parent.find('.qtyItem').val().replace(/,/g, '')), '', 2));
    // handleVAT(parent.find('.VATUSDItem'));
    sum_item(parent);
}

// function handleVAT(inp) {
//     var parent = inp.closest('tr');
//     var val = inp.val().replace(/,/g, '');
//     var amountUSD = parseFloat(parent.find('.amountUSDItem').val().replace(/,/g,''));
//     parent.find('.amountVATVNDItem').val(accounting.formatMoney(parseFloat(amountUSD + (amountUSD * val / 100)), '', 2));
// }