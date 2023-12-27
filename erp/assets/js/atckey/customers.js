$(document).ready(function() {
    $('body').on('click', '.add-contact', function () {
        var ContactType = $(this).data('contacttype');
        var key = 0;
        if ($('.Contacts').length) {
            key = parseInt($('.Contacts:last .key').val()) + 1;
        }
        var html = '<tr class="Contacts Contacts' + ContactType + ' editing" id="Contacts' + ContactType + key + '">' +
            '<td nowrap="nowrap">' +
            '<input type="hidden" name="Contacts[' + key + '][id]" value=""/>' +
            '<input type="hidden" name="Contacts[' + key + '][ContactType]" value="' + ContactType + '"/>' +
            '<input type="hidden" class="key" value="' + key + '"/>' +
            '<a href="javascript:;" class="edit-contact"><i class="glyph-icon icon-edit"></i></a>&nbsp;&nbsp;' +
            '<a href="javascript:;" class="remove-contact" data-table="contacts_customer" data-id=""><i class="glyph-icon icon-remove"></i></a>' +
            '</td>' +
            '<td><span class="form-text ItemName"></span><input type="text" name="Contacts[' + key + '][ContactName]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Contacts[' + key + '][Function]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Contacts[' + key + '][Email]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Contacts[' + key + '][Phone]" class="form-control"/></td>' +
            '<td class="center"><div class="checkbox checkbox-primary"><input type="checkbox" class="custom-checkbox" name="Contacts[' + key + '][Catalog]" id="Contacts' + ContactType + 'Catalog' + key + '" value="1"/></div></td>' +
            '<td class="center"><div class="checkbox checkbox-primary"><input type="checkbox" class="custom-checkbox" name="Contacts[' + key + '][Newsletter]" id="Contacts' + ContactType + 'Newsletter' + key + '" value="1"/></div></td>' +
            '<td class="center"><div class="checkbox checkbox-primary"><input type="checkbox" class="custom-checkbox" name="Contacts[' + key + '][PressReleases]" id="Contacts' + ContactType + 'ressReleases' + key + '" value="1"/></div></td>' +
            '<td class="center"><div class="checkbox checkbox-primary"><input type="checkbox" class="custom-checkbox" name="Contacts[' + key + '][ProductNotifications]" id="Contacts' + ContactType + 'ProductNotifications' + key + '" value="1"/></div></td>' +
            '<td class="center"><div class="checkbox checkbox-primary"><input type="checkbox" class="custom-checkbox" name="Contacts[' + key + '][Emailinvalid]" id="Contacts' + ContactType + 'Emailinvalid' + key + '" value="1"/></div></td>' +
            '<td class="center"><div class="checkbox checkbox-primary"><input type="checkbox" class="custom-checkbox" name="Contacts[' + key + '][LeftCompany]" id="Contacts' + ContactType + 'LeftCompany' + key + '" value="1"/></div></td>';
        if ($('.Contacts' + ContactType).length) {
            $('.Contacts' + ContactType + ':last').after(html);
        } else {
            $(this).parent().parent().after(html);
        }
    }).on('click', '.add-businesstrip', function () {
        /*var key = 0;
        if ($('.BusinessTrip').length) {
            key = parseInt($('.BusinessTrip:last .key').val()) + 1;
        }
        var html = '<tr class="BusinessTrip editing" id="BusinessTrip' + key + '">' +
            '<td nowrap="nowrap">' +
            '<input type="hidden" name="BusinessTrip[' + key + '][id]" value=""/>' +
            '<input type="hidden" class="key" value="' + key + '"/>' +
            '<a href="javascript:;" class="edit-contact"><i class="glyph-icon icon-edit"></i></a>&nbsp;&nbsp;' +
            '<a href="javascript:;" class="remove-contact" data-table="contacts_customer" data-id=""><i class="glyph-icon icon-remove"></i></a>' +
            '</td>' +
            '<td><span class="form-text"></span><input type="text" name="BusinessTrip[' + key + '][Date]" class="form-control date"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="BusinessTrip[' + key + '][Manufacturer]" class="form-control"/></td>' +
            '<td><span class="form-text ItemName"></span><input name="BusinessTrip[' + key + '][MeetingAgenda]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="BusinessTrip[' + key + '][ContactPersonNames]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="BusinessTrip[' + key + '][Function]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="BusinessTrip[' + key + '][Address]" class="form-control"/></td>';
        if ($('.BusinessTrip').length) {
            $('.BusinessTrip:last').after(html);
        } else {
            $('.business_trip-list').append(html);
        }

        $('#BusinessTrip' + key + ' .date').datepicker({
            format: 'yyyy-mm-dd',
            language: 'vi',
            autoclose: true,
            todayHighlight: true
        });*/
        var id = $(this).parent().find('input[type="hidden"]').first().val();
        if ($('#tabs-business').length) {
            $.alerts.confirm('Will you close this porject?<br/>', 'Confirm close', function (r) {
                if (r == true) {
                    $('[href="#tabs-business"]').parent().remove();
                    $('#tabs-business').remove();
                    $.ajax({
                        url: site_url + 'customers/add_business_trip',
                        type: 'POST',
                        cache: false,
                        data: {
                            action_business_trip: action_business_trip,
                            CustomerAccount: CustomerAccount,
                            AccountOwner: AccountOwner,
                        },
                        success: function (html) {
                            // var tabName = $('#myTab li').length - 1;
                            $('#myTab li, #myTabContent .tab-pane').removeClass('active');
                            $('#myTab li').first().after('<li class="active"><a href="#tabs-business" data-toggle="tab">Business trip <span class="remove-business" data-id=""><i class="glyph-icon icon-remove"></i></span></a></li>');
                            $('#myTabContent').append('<div id="tabs-business" class="tab-pane active"></div>');
                            $('#myTabContent .active').html(html);
                        }
                    });
                }
            });
        } else {
            $.ajax({
                url: site_url + 'customers/add_business_trip',
                type: 'POST',
                cache: false,
                data: {
                    action_business_trip: action_business_trip,
                    CustomerAccount: CustomerAccount,
                    AccountOwner: AccountOwner,
                },
                success: function (html) {
                    // var tabName = $('#myTab li').length - 1;
                    $('#myTab li, #myTabContent .tab-pane').removeClass('active');
                    $('#myTab li').first().after('<li class="active"><a href="#tabs-business" data-toggle="tab">Business trip <span class="remove-business" data-id=""><i class="glyph-icon icon-remove"></i></span></a></li>');
                    $('#myTabContent').append('<div id="tabs-business" class="tab-pane active"></div>');
                    $('#myTabContent .active').html(html);
                }
            });
        }
    }).on('click', '.remove-contact, .remove-quotation, .remove-order_histories, .remove-web_order_histories, .remove-businesstrip', function () {
        var id = $(this).data('id');
        var table = $(this).data('table');
        var tr = $(this).parent().parent();
        $.alerts.confirm('Will you delete this item?<br/><b>' + tr.find('.ItemName').text() + '</b>', 'Confirm delete', function (r) {
            if (r == true) {
                $.ajax({
                    url: site_url + 'ajax/change_status',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id,
                        table: table,
                        field: 'deleted',
                        status: 1
                    }
                });
                tr.remove();
            }
        });
    }).on('click', '.remove-project', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var tab = $('.remove-project[data-id="' + id + '"]').parent().parent();
        $.alerts.confirm('Will you delete this project?<br/><b>' + tab.find('.project-name').text() + '</b>', 'Confirm delete', function (r) {
            if (r == true) {
                $.ajax({
                    url: site_url + 'ajax/change_status',
                    type: 'POST',
                    cache: false,
                    data: {
                        id: id,
                        table: 'projects_customer',
                        field: 'deleted',
                        status: 1
                    }
                });
                $(tab.find('a').attr('href')).remove();
                $('.tabId').val(0);
                $('#tabs-0').addClass('active');
                $('[href="#tabs-0"]').parent().addClass('active');
                $.cookie('mytab-' + $('#act').val() + '-' + $('#do').val(), 0, {
                    path: '/'
                });
                tab.remove();
            }
        });
        return false;
    }).on('click', '.remove-business', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var tab = $(this).parent().parent();
        $.alerts.confirm('Will you close this business trip?<br/><b>' + tab.find('.project-name').text() + '</b>', 'Confirm close', function (r) {
            if (r == true) {
                $(tab.find('a').attr('href')).remove();
                $('.tabId').val(0);
                $('#tabs-0').addClass('active');
                $('[href="#tabs-0"]').parent().addClass('active');
                $.cookie('mytab-' + $('#act').val() + '-' + $('#do').val(), 0, {
                    path: '/'
                });
                tab.remove();
            }
        });
        return false;
    }).on('click', '.remove-customer-component', function (e) {
        e.preventDefault();
        var id = $(this).data('id');
        var tab = $(this).parent().parent();
        var title = $(this).prev('.title-pane').html();
        $.alerts.confirm('Will you close this ' + title + '?<br/><b>' + tab.find('.project-name').text() + '</b>', 'Confirm close', function (r) {
            if (r == true) {
                $(tab.find('a').attr('href')).remove();
                $('.tabId').val(0);
                $('#tabs-0').addClass('active');
                $('[href="#tabs-0"]').parent().addClass('active');
                $.cookie('mytab-' + $('#act').val() + '-' + $('#do').val(), 0, {
                    path: '/'
                });
                tab.remove();
            }
        });
        return false;
    }).on('click', '.edit-contact', function () {
        $(this).parent().parent().addClass('editing');
    }).on('click', '.edit-businesstrip', function () {
        var id = $(this).parent().find('input[type="hidden"]').first().val();
        if ($('#tabs-business').length) {
            $.alerts.confirm('Will you close this business trip?<br/>', 'Confirm close', function (r) {
                if (r == true) {
                    $('[href="#tabs-business"]').parent().remove();
                    $('#tabs-business').remove();
                    $.ajax({
                        url: site_url + $('#act').val() + '/add_business_trip',
                        type: 'POST',
                        cache: false,
                        data: {
                            id: id,
                            action_business_trip: action_business_trip,
                            CustomerAccount: CustomerAccount,
                            AccountOwner: AccountOwner,
                        },
                        success: function (html) {
                            // var tabName = $('#myTab li').length - 1;
                            $('#myTab li, #myTabContent .tab-pane').removeClass('active');
                            $('#myTab li').first().after('<li class="active"><a href="#tabs-business" data-toggle="tab">Business trip <span class="remove-business" data-id=""><i class="glyph-icon icon-remove"></i></span></a></li>');
                            $('#myTabContent').append('<div id="tabs-business" class="tab-pane active"></div>');
                            $('#myTabContent .active').html(html);
                        }
                    });
                }
            });
        } else {
            $.ajax({
                url: site_url + $('#act').val() + '/add_business_trip',
                type: 'POST',
                cache: false,
                data: {
                    id: id,
                    action_business_trip: action_business_trip,
                    CustomerAccount: CustomerAccount,
                    AccountOwner: AccountOwner
                },
                success: function (html) {
                    // var tabName = $('#myTab li').length - 1;
                    $('#myTab li, #myTabContent .tab-pane').removeClass('active');
                    $('#myTab li').first().after('<li class="active"><a href="#tabs-business" data-toggle="tab">Business trip <span class="remove-business" data-id=""><i class="glyph-icon icon-remove"></i></span></a></li>');
                    $('#myTabContent').append('<div id="tabs-business" class="tab-pane active"></div>');
                    $('#myTabContent .active').html(html);
                }
            });
        }
    }).on('click', '.customer-component', function () {
        var mode = $(this).data('view');
        var title = '';
        if (mode == 'business_trip') {
            title = '<i class="fa fa-list"></i> Business Trip';
        }
        if (mode == 'web_order_history') {
            title = '<i class="fa fa-list"></i> Web Order History';
        }
        if (mode == 'order_history') {
            title = '<i class="fa fa-list"></i> Order History';
        }
        if (mode == 'quotation_history') {
            title = '<i class="fa fa-list"></i> Quotation History';
        }
        if (mode == 'projects') {
            title = '<i class="fa fa-list"></i> Projects';
        }
        $.ajax({
            url: site_url + $('#act').val() + '/customer_component',
            type: 'POST',
            cache: false,
            data: {
                mode: mode,
                CustomerAccount: CustomerAccount,
            },
            success: function (html) {
                $('#myTab li, #myTabContent .tab-pane').removeClass('active');
                $('#myTab li').last().after('<li class="active"><a href="#' + mode + '" data-toggle="tab"><span class="title-pane">' + title + '</span> <span class="remove-customer-component" data-id=""><i class="glyph-icon icon-remove"></i></span></a></li>');
                $('#myTabContent').append('<div id="' + mode + '" class="tab-pane active"></div>');
                $('#myTabContent .active').html(html);
            }
        });
    }).on('click', '#addTab', function () {
        $.ajax({
            url: site_url + $('#act').val() + '/add_project',
            type: 'POST',
            cache: false,
            data: {
                action_project: action_project,
                CustomerAccount: CustomerAccount
            },
            success: function (html) {
                var tabName = $('#myTab li').length - 1;
                $('#myTab li, #myTabContent .tab-pane').removeClass('active');
                $('#addTab').parent().before('<li class="active" onclick="set_mytab($(this))"><a href="#tabs-' + tabName + '" data-toggle="tab">Project <span class="project-name">' + tabName + '</span> <span class="remove-project" data-id=""><i class="glyph-icon icon-remove"></i></span></a></li>');
                $('#myTabContent').append('<div id="tabs-' + tabName + '" class="tab-pane active"></div>');
                $('#myTabContent .active').html(html);
            }
        });
    });

    $('body').on('click', '.add-samples', function () {
        var key = 0;
        if ($('.tab-pane.active .Samples').length) {
            key = parseInt($('.Samples:last .key').val()) + 1;
        }
        var html = '<tr class="Samples editing" id="Samples' + key + '">' +
            '<td nowrap="nowrap">' +
            '<input type="hidden" class="key" value="' + key + '"/>' +
            '<a href="javascript:;" class="edit-samples"><i class="glyph-icon icon-edit"></i></a>&nbsp;&nbsp;' +
            '<a href="javascript:;" class="remove-samples" data-id=""><i class="glyph-icon icon-remove"></i></a>' +
            '</td>' +
            '<td><span class="form-text PartNumber"></span><input type="text" name="Samples[' + key + '][PartNumber]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][Manufacturer]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][Quantity]" class="form-control money" style="text-align: left;"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][DateOfTesting]" class="form-control date"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][Result]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="Samples[' + key + '][LastModifiedDate]" class="form-control date"/></td>';
        if ($('.tab-pane.active .Samples').length) {
            $('.tab-pane.active .Samples:last').after(html);
        } else {
            $('.tab-pane.active .samples-list').append(html);
        }

        $('.tab-pane.active #Samples' + key + ' .date').datepicker({
            format: 'yyyy-mm-dd',
            language: 'vi',
            autoclose: true,
            todayHighlight: true
        });

        $('.tab-pane.active #Samples' + key + ' .money').autoNumeric('init', {
            'mDec': 0
        });
    }).on('click', '.add-potentiallinecard', function () {
        var key = 0;
        if ($('.tab-pane.active .PotentialLineCard').length) {
            key = parseInt($('.tab-pane.active .PotentialLineCard:last .key').val()) + 1;
        }
        var html = '<tr class="PotentialLineCard editing" id="PotentialLineCard' + key + '">' +
            '<td nowrap="nowrap">' +
            '<input type="hidden" class="key" value="' + key + '"/>' +
            '<a href="javascript:;" class="edit-samples"><i class="glyph-icon icon-edit"></i></a>&nbsp;&nbsp;' +
            '<a href="javascript:;" class="remove-samples" data-id=""><i class="glyph-icon icon-remove"></i></a>' +
            '</td>' +
            '<td><span class="form-text PartNumber"></span><input type="text" name="PotentialLineCard[' + key + '][PartNumber]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][Manufacturer]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][AnnualQuantity]" class="form-control money" style="text-align: left;"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][CrossToPartNumber]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][CrossToManufacturer]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][Probability]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="PotentialLineCard[' + key + '][LastModifiedDate]" class="form-control date"/></td>';
        if ($('.tab-pane.active .PotentialLineCard').length) {
            $('.tab-pane.active .PotentialLineCard:last').after(html);
        } else {
            $('.tab-pane.active .potentiallinecard-list').append(html);
        }

        $('.tab-pane.active #PotentialLineCard' + key + ' .date').datepicker({
            format: 'yyyy-mm-dd',
            language: 'vi',
            autoclose: true,
            todayHighlight: true
        });

        $('.tab-pane.active #PotentialLineCard' + key + ' .money').autoNumeric('init', {
            'mDec': 0
        });
    }).on('click', '.add-specialpricerequests', function () {
        var key = 0;
        if ($('.tab-pane.active .SpecialPriceRequests').length) {
            key = parseInt($('.tab-pane.active .SpecialPriceRequests:last .key').val()) + 1;
        }
        var html = '<tr class="SpecialPriceRequests editing" id="SpecialPriceRequests' + key + '">' +
            '<td nowrap="nowrap">' +
            '<input type="hidden" class="key" value="' + key + '"/>' +
            '<a href="javascript:;" class="edit-samples"><i class="glyph-icon icon-edit"></i></a>&nbsp;&nbsp;' +
            '<a href="javascript:;" class="remove-samples" data-id=""><i class="glyph-icon icon-remove"></i></a>' +
            '</td>' +
            '<td><span class="form-text PartNumber"></span><input type="text" name="SpecialPriceRequests[' + key + '][PartNumber]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][Manufacturer]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][AnnualQuantity]" class="form-control money" style="text-align: left;"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][CurrentPrice]" class="form-control money2" style="text-align: left;"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][SpecialPrice]" class="form-control money2" style="text-align: left;"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][Probability]" class="form-control"/></td>' +
            '<td><span class="form-text"></span><input type="text" name="SpecialPriceRequests[' + key + '][LastModifiedDate]" class="form-control date"/></td>';
        if ($('.tab-pane.active .SpecialPriceRequests').length) {
            $('.tab-pane.active .SpecialPriceRequests:last').after(html);
        } else {
            $('.tab-pane.active .specialpricerequests-list').append(html);
        }

        $('.tab-pane.active #SpecialPriceRequests' + key + ' .date').datepicker({
            format: 'yyyy-mm-dd',
            language: 'vi',
            autoclose: true,
            todayHighlight: true
        });

        $('.tab-pane.active #SpecialPriceRequests' + key + ' .money').autoNumeric('init', {
            'mDec': 0
        });

        $('.tab-pane.active #SpecialPriceRequests' + key + ' .money2').autoNumeric('init', {
            'mDec': 2
        });
    }).on('click', '.remove-samples, .remove-potentiallinecard, .remove-specialpricerequests', function () {
        var id = $(this).data('id');
        var tr = $(this).parent().parent();
        $.alerts.confirm('Will you delete this item?<br/><b>' + tr.find('.PartNumber').text() + '</b>', 'Confirm delete', function (r) {
            if (r == true) {
                tr.remove();
            }
        });
    }).on('click', '.edit-samples, .edit-potentiallinecard, .edit-specialpricerequests', function () {
        $(this).parent().parent().addClass('editing');
    });

    $('.money-usd').autoNumeric('init', {
        'mDec': 2,
        'aSign': '$'
    });
});