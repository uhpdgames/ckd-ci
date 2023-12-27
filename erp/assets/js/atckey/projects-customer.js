var allCates = allCates || {};
var tmphtml = '';
$.each(allCates, function (k, i) {
    if (!!i) {
        if (i.parent == 0) {
            tmphtml += '<optgroup label="' + i.name_vn + '">';
            $.each(allCates, function (kk, $subcat) {
                if ($subcat.parent == i.id) {
                    tmphtml += '<option value="' + $subcat.id + '"' +'>' + $subcat.id + ' - ' + $subcat.name_vn + ' (' + $subcat.item + ')</option>';
                }
            });
            tmphtml += '</optgroup>';
        }
    }
});
$(document).ready(function () {
    $('#frmSearch').submit(function () {
        $('#divSearch').show();
        $('#divSearch div').css('max-height', '300px');
        $('#divSearch tbody').html('<tr><td class="fr center" colspan="10"><div style="padding:10px"><img src="assets/images/spinner-mini.gif"/></div></td></tr>');
        $.ajax({
            url: site_url + 'ajax/search_part',
            type: 'POST',
            cache: false,
            data: {
                q: $('[name="q"]').val()
            },
            success: function (string) {
                $('#divSearch tbody').empty().append(string);
                $('#divSearch tr:not(".no-data, .nodrop")').click(function () {
                    var part = $(this).find('span.mfr-part').text();
                    /*var key = parseInt($('#itemList table tbody .highlightNoClick:last td input.itemKey').val()) + 1;
                    if ($('#itemList table tbody .highlightNoClick').length == 0) {
                        key = 1;
                    }*/
                    var key = 0;
                    if ($('.PotentialLineCard').length) {
                        key = parseInt($('.PotentialLineCard:last .key').val()) + 1;
                    }
                    if ($('input.mfr-part[value="' + part + '"]').length) {
                        $('input.mfr-part[value="' + part + '"]').closest('tr.highlightNoClick').addClass('exists').delay(7000).queue(function (next) {
                            $(this).removeClass("exists");
                            next();
                        });
                        showNoti('Manufacturer Part Number: ' + part, 'Cảnh báo nhập liệu', 'War');
                    } else {
                        add_potentiallinecard(key);
                        $('[name="PotentialLineCard[' + key + '][category]"]').val($(this).data('category'));
                        $('[name="PotentialLineCard[' + key + '][manufacturer_part_number]"]').val($(this).find('span.mfr-part').text());
                        $('[name="PotentialLineCard[' + key + '][Image]"]').val($(this).find('img').data('url'));
                        $('[name="PotentialLineCard[' + key + '][Image]"]').parent('td').find('img').attr('src', $(this).find('img').data('url'));
                        $('[name="PotentialLineCard[' + key + '][Description]"]').val($(this).find('span.desc').text());
                        $('[name="PotentialLineCard[' + key + '][Manufacturer]"]').val($(this).find('td.manufacturer').text());
                        $('[name="PotentialLineCard[' + key + '][SPQ]"]').val($(this).find('td.spq').text());
                        $('[name="PotentialLineCard[' + key + '][UnitPrice]"]').val($(this).find('td.unit-price').text());
                        $('[name="PotentialLineCard[' + key + '][LeadtimeComment]"]').val($(this).find('td.leadtime').text());
                    }
                    $(this).remove();
                    if ($('#divSearch tbody tr').length == 0) {
                        $('#divSearch').hide();
                    }
                });
            }
        });
        $('[name="q"]').val('').blur();
        return false;
    });

    $('body').on('click', '.add-samples', function () {
        var key = 0;
        if ($('.Samples').length) {
            key = parseInt($('.Samples:last .key').val()) + 1;
        }
        var html = '<tr class="Samples editing" id="Samples' + key + '">' +
            '<td nowrap="nowrap">' +
            '<input type="hidden" class="key" value="' + key + '"/>' +
            '<a href="javascript:;" class="edit-samples"><i class="glyph-icon icon-edit"></i></a>&nbsp;&nbsp;' +
            '<a href="javascript:;" class="remove-samples" data-id=""><i class="glyph-icon icon-remove"></i></a>' +
            '</td>' +
            '<td><span class="form-text PartNumber"></span><input type="text" name="Samples[' + key + '][manufacturer_part_number]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][Manufacturer]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][Quantity]" class="form-control money" style="text-align: left;"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][DateOfTesting]" class="form-control date"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][Result]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][LastModifiedDate]" class="form-control date"/></td>';
        if ($('.Samples').length) {
            $('.Samples:last').after(html);
        } else {
            $('.samples-list').append(html);
        }

        $('#Samples' + key + ' .date').datepicker({
            format: 'yyyy-mm-dd',
            language: 'vi',
            autoclose: true,
            todayHighlight: true
        });

        $('#Samples' + key + ' .money').autoNumeric('init', {
            'mDec': 0
        });
    }).on('click', '.add-potentiallinecard', function () {
        var key = 0;
        var numb = 1;
        if ($('.PotentialLineCard').length) {
            key = parseInt($('.PotentialLineCard:last .key').val()) + 1;
            numb = parseInt($('.PotentialLineCard:last .numb').text()) + 1;
        }
        var html = '<tr class="PotentialLineCard editing" id="PotentialLineCard' + key + '">' +
            '<td nowrap="nowrap">' +
            '<input type="hidden" class="key" value="' + key + '"/>' +
            '<a href="javascript:;" class="edit-samples"><i class="glyph-icon icon-edit"></i></a>&nbsp;&nbsp;' +
            '<a href="javascript:;" class="remove-samples" data-id=""><i class="glyph-icon icon-remove"></i></a>' +
            '</td>' +
            '<td nowrap="nowrap">' +
            '<span class="numb">' + numb + '</span>' +
            '</td>' +
            // '<td style="min-width: 50px; max-width: 50px;" class="center"><img src="" style="max-width: 27px;" ><input type="hidden" name="PotentialLineCard[' + key + '][Image]"></td>' +
            '<td><div class="ps-relative"><span class="form-text PartNumber"></span><input type="text" id="PotentialLineCard' + key + 'PartNumber" name="PotentialLineCard[' + key + '][manufacturer_part_number]" class="form-control" data-required="1"><div class="errordiv PotentialLineCard' + key + 'PartNumber"><div class="arrow"></div>Not Empty!</div></div></td>' +
            '<td><div class="ps-relative"><select id="PotentialLineCard' + key + 'category" class="select2 field-update editing" name="PotentialLineCard[' + key + '][category]" data-required="1" ><option value="">Chọn ...</option>' +tmphtml+'</select><div class="errordiv PotentialLineCard' + key + 'category"><div class="arrow"></div>Not Empty!</div></div></td>' +
            '<td><div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'Description" name="PotentialLineCard[' + key + '][Description]" class="form-control"><div class="errordiv PotentialLineCard' + key + 'Description"><div class="arrow"></div>Not Empty!</div></div></td>' +
            // '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][Manufacturer]" class="form-control"/></td>' +
            '<td style="min-width: 250px; max-width: 250px;">' +
            '    <div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'Manufacturer" name="PotentialLineCard[' + key + '][Manufacturer]" class="form-control"><div class="errordiv PotentialLineCard' + key + 'Manufacturer"><div class="arrow"></div>Not Empty!</div></div>' +
            '    <div class="input-group double-input ps-relative"">' +
            '        <input class="form-control ChooseSup" value="" autocomplete="off" placeholder="ID">' +
            '        <div class="errordiv SupplierID' + key + '"><div class="arrow"></div>Not Empty!</div>' +
            '        <select id="SupplierID' + key + '" name="PotentialLineCard[' + key + '][SupplierID]" class="select-status select-supplier">' + suppliers_options + '</select>' +
            '        <div class="result-suppliers" data-for="SupplierID' + key + '"></div>' +
            '        <div class="input-group-btn"><button type="button" class="btn btn-default empty-supplier"><i class="fa fa-times" aria-hidden="true"></i></button></div>' +
            '    </div>' +
            '</td>' +
            // '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][SPQ]" class="form-control money" style="text-align: left;"/></td>' +
            '<td><div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'AnnualQty" name="PotentialLineCard[' + key + '][AnnualQty]" class="form-control eau-qty"><div class="errordiv PotentialLineCard' + key + 'AnnualQty"><div class="arrow"></div>Not Empty!</div></div></td>' +
            '<td><div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'UnitPrice" name="PotentialLineCard[' + key + '][UnitPrice]" class="form-control unit-price"><div class="errordiv PotentialLineCard' + key + 'UnitPrice"><div class="arrow"></div>Not Empty!</div></div></td>' +
            '<td><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'AmountEAU" name="PotentialLineCard[' + key + '][AmountEAU]" class="form-control eau-amount"></td>' +
            '<td><div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'LeadtimeComment" name="PotentialLineCard[' + key + '][LeadtimeComment]" class="form-control"><div class="errordiv PotentialLineCard' + key + 'LeadtimeComment"><div class="arrow"></div>Not Empty!</div></div></td>' +
            '<td><div class="ps-relative"><span class="form-text"></span><select id="PotentialLineCard' + key + 'RegistrationStatus" name="PotentialLineCard[' + key + '][RegistrationStatus]" class="select-status select-approve-pi">' + registration_status_options + '</select><div class="errordiv PotentialLineCard' + key + 'RegistrationStatus"><div class="arrow"></div>Not Empty!</div></div></td>';
        if ($('.PotentialLineCard').length) {
            $('.PotentialLineCard:last').after(html);
        } else {
            $('.potentiallinecard-list').append(html);
        }

        $('#PotentialLineCard' + key + 'category').chosen();
        $('#PotentialLineCard' + key + ' .date').datepicker({
            format: 'yyyy-mm-dd',
            language: 'vi',
            autoclose: true,
            todayHighlight: true
        });

        $('#PotentialLineCard' + key + ' .money').autoNumeric('init', {
            'mDec': 0
        });
    }).on('click', '.add-specialpricerequests', function () {
        var key = 0;
        if ($('.SpecialPriceRequests').length) {
            key = parseInt($('.SpecialPriceRequests:last .key').val()) + 1;
        }
        var html = '<tr class="SpecialPriceRequests editing" id="SpecialPriceRequests' + key + '">' +
            '<td nowrap="nowrap">' +
            '<input type="hidden" class="key" value="' + key + '"/>' +
            '<a href="javascript:;" class="edit-samples"><i class="glyph-icon icon-edit"></i></a>&nbsp;&nbsp;' +
            '<a href="javascript:;" class="remove-samples" data-id=""><i class="glyph-icon icon-remove"></i></a>' +
            '</td>' +
            '<td><span class="form-text PartNumber"></span><input type="text" name="SpecialPriceRequests[' + key + '][manufacturer_part_number]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][Manufacturer]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][AnnualQuantity]" class="form-control money" style="text-align: left;"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][CurrentPrice]" class="form-control money2" style="text-align: left;"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][SpecialPrice]" class="form-control money2" style="text-align: left;"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][Probability]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][LastModifiedDate]" class="form-control date"/></td>';
        if ($('.SpecialPriceRequests').length) {
            $('.SpecialPriceRequests:last').after(html).trigger('chosen:updated');
        } else {
            $('.specialpricerequests-list').append(html).trigger('chosen:updated');
        }
        $('#SpecialPriceRequests' + key + 'category').chosen();
        $('#SpecialPriceRequests' + key + ' .date').datepicker({
            format: 'yyyy-mm-dd',
            language: 'vi',
            autoclose: true,
            todayHighlight: true
        });

        $('#SpecialPriceRequests' + key + ' .money').autoNumeric('init', {
            'mDec': 0
        });

        $('#SpecialPriceRequests' + key + ' .money2').autoNumeric('init', {
            'mDec': 2
        });
    }).on('click', '.remove-samples, .remove-potentiallinecard, .remove-specialpricerequests', function () {
        var id = $(this).closest('tr').find('.rowid').val();
        var tr = $(this).parent().parent();
        $.alerts.confirm('Will you delete this item?<br/><b>' + tr.find('.PartNumber').text() + '</b>', 'Confirm delete', function (r) {
            if (r == true) {
                tr.remove();
                if (!!id) {
                    $.ajax({
                        url: site_url + 'projects_customer/ajax_delete_potential_line_card',
                        method: "POST",
                        data: {id: id},
                        dateType: "json",
                        cache: false
                    });
                }
            }
        });
    }).on('click', '.edit-samples, .edit-potentiallinecard, .edit-specialpricerequests', function () {
        var tr = $(this).closest('tr');
        $(this).parent().parent().addClass('editing');
        tr.find('.mycate').chosen();
        tr.find('.mycate').removeClass('disabled');
        tr.find('.mycate').hide();
    }).on('change', '.unit-price, .eau-qty', function () {
        var parent = $(this).closest('tr');
        var price = parseFloat(parent.find('.unit-price').val().replace(/\s/g, '').replace(/,/g, ''));
        var qty = parseFloat(parent.find('.eau-qty').val().replace(/\s/g, '').replace(/,/g, ''));
        parent.find('.unit-price').val(accounting.formatMoney(price, '', 4));
        parent.find('.eau-qty').val(accounting.formatMoney(qty, '', 0));
        parent.find('.eau-amount').val(accounting.formatMoney(price * qty, '', 2));
    })

    $('.money-usd').autoNumeric('init', {
        'mDec': 2,
        'aSign': '$'
    });
    var setup_number = function () {
        $(this).val($(this).val().replace(/[^0-9\.]/g, ''));
        if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
            //showNoti('Only enter a number', 'Price List', 'Err');
            event.preventDefault();
        }
    }
    $('.input-number').on("keypress keyup blur", setup_number);
});

function add_potentiallinecard(key) {
    var numb = 1;
    if ($('.PotentialLineCard').length) {
        numb = parseInt($('.PotentialLineCard:last .numb').text()) + 1;
    }
    var string = '<tr class="PotentialLineCard editing" id="PotentialLineCard' + key + '">' +
        '<td nowrap="nowrap">' +
        '<input type="hidden" class="key" value="' + key + '"/>' +
        '<input type="hidden" name="PotentialLineCard[' + key + '][id]" value=""/>' +
        '<a href="javascript:;" class="edit-samples"><i class="glyph-icon icon-edit"></i></a>&nbsp;&nbsp;' +
        '<a href="javascript:;" class="remove-samples" data-id=""><i class="glyph-icon icon-remove"></i></a>' +
        '</td>' +
        '<td nowrap="nowrap">' +
        '<span class="numb">' + numb + '</span>' +
        '</td>' +
        // '<td style="min-width: 50px; max-width: 50px;" class="center"><img src="" style="max-width: 27px;" ><input type="hidden" name="PotentialLineCard[' + key + '][Image]"></td>' +
        '<td><div class="ps-relative"><span class="form-text PartNumber"></span><input type="text" id="PotentialLineCard' + key + 'PartNumber" data-required="1"  name="PotentialLineCard[' + key + '][manufacturer_part_number]" class="form-control"><div class="errordiv PotentialLineCard' + key + 'PartNumber"><div class="arrow"></div>Not Empty!</div></div></td>' +
        '<td><div class="ps-relative"><select id="PotentialLineCard' + key + 'category" class=" select2 field-update editing" name="PotentialLineCard[' + key + '][category]" data-required="1" ><option value="">Chọn ...</option>' +tmphtml+'</select><div class="errordiv PotentialLineCard' + key + 'category"><div class="arrow"></div>Not Empty!</div></div></td>' +
    '<td><div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'Description" name="PotentialLineCard[' + key + '][Description]" class="form-control"><div class="errordiv PotentialLineCard' + key + 'Description"><div class="arrow"></div>Not Empty!</div></div></td>' +
    // '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][Manufacturer]" class="form-control"/></td>' +
    '<td style="min-width: 250px; max-width: 250px;">' +
    '    <div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'Manufacturer" name="PotentialLineCard[' + key + '][Manufacturer]" class="form-control"><div class="errordiv PotentialLineCard' + key + 'Manufacturer"><div class="arrow"></div>Not Empty!</div></div>' +
    '    <div class="input-group double-input ps-relative"">' +
    '        <input class="form-control ChooseSup" value="" autocomplete="off" placeholder="ID">' +
    '        <div class="errordiv SupplierID' + key + '"><div class="arrow"></div>Not Empty!</div>' +
    '        <select id="SupplierID' + key + '" name="PotentialLineCard[' + key + '][SupplierID]" class="select-status select-supplier">' + suppliers_options + '</select>' +
    '        <div class="result-suppliers" data-for="SupplierID' + key + '"></div>' +
    '        <div class="input-group-btn"><button type="button" class="btn btn-default empty-supplier"><i class="fa fa-times" aria-hidden="true"></i></button></div>' +
    '    </div>' +
    '</td>' +
    // '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][SPQ]" class="form-control money" style="text-align: left;"/></td>' +
    '<td><div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'AnnualQty" name="PotentialLineCard[' + key + '][AnnualQty]" class="form-control eau-qty"><div class="errordiv PotentialLineCard' + key + 'AnnualQty"><div class="arrow"></div>Not Empty!</div></div></td>' +
    '<td><div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'UnitPrice" name="PotentialLineCard[' + key + '][UnitPrice]" class="form-control unit-price"><div class="errordiv PotentialLineCard' + key + 'UnitPrice"><div class="arrow"></div>Not Empty!</div></div></td>' +
    '<td><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'AmountEAU" name="PotentialLineCard[' + key + '][AmountEAU]" class="form-control eau-amount"></td>' +
    '<td><div class="ps-relative"><span class="form-text"></span><input type="text" id="PotentialLineCard' + key + 'LeadtimeComment" name="PotentialLineCard[' + key + '][LeadtimeComment]" class="form-control"><div class="errordiv PotentialLineCard' + key + 'LeadtimeComment"><div class="arrow"></div>Not Empty!</div></div></td>' +
    '<td><div class="ps-relative"><span class="form-text"></span><select id="PotentialLineCard' + key + 'RegistrationStatus" name="PotentialLineCard[' + key + '][RegistrationStatus]" class="select-status select-approve-pi">' + registration_status_options + '</select><div class="errordiv PotentialLineCard' + key + 'RegistrationStatus"><div class="arrow"></div>Not Empty!</div></div></td>';

    if ($('.PotentialLineCard').length) {
        $('.PotentialLineCard:last').after(string);
    } else {
        $('.potentiallinecard-list').append(string);
    }

    $('#PotentialLineCard' + key + ' .date').datepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        autoclose: true,
        todayHighlight: true
    });

    $('#PotentialLineCard' + key + 'category').chosen();
    $('#PotentialLineCard' + key + ' .money').autoNumeric('init', {
        'mDec': 0
    });
}
