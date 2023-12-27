class Request_pickup{
    constructor(el){
        this.body = $("body");
        this.id = this.body.find("#id").val();
        this.root = $(el);
    }
    afterLoaded(){
        this.clockRemovePo();
        this.minimizeHeader();
        Request_pickup.removeLoading();
    }
    addEventListener(){
        var rp = this;
        $(".group-process").on("click","#removeRowPart", function(){
            rp.addRemoveListItems();
        }).on("click",".btn-info.waves-effect",function(){
            var mt = new MainTable();
            mt.insertPart(this);
        })

    }
    static async removeLoading(){
        $("#loading-animated").removeClass("yt-loader"); 
    }
    static addLoading(){
        $("#loading-animated").addClass("yt-loader");
    }
}
Request_pickup.prototype.scrollTopSmooth = function(el) {

    // off/on for test

    var top = 0;
    try {
        $(el).focus();
        var pos = $(el).offset();
        var tag = $(el).attr("tagName");
        if (tag == "INPUT") $(el).focus();
        top = pos.top - 150;
    } catch (error) {

    }

    $("html, body").animate({ scrollTop: top }, 1000);

}

Request_pickup.prototype.removePoDuplicate = function(po){
    var count_po = 0;
    $("#po-information .PONo").each(function(){
        if($(this).val()==po) count_po++;
    })
    var po_insert = $("#po-information .PONo").last();
    if(po_insert.val()==po&&count_po>1) po_insert.closest(".fg-po").remove();
}

Request_pickup.prototype.clockRemovePo = function(){
    if(this.id){
        $("#mainTable-request_pickup").find('.fg-po select.PONo').addClass("disabled");
        $("#mainTable-request_pickup").find('.fg-po input').addClass("disabled");
        // $("#mainTable-request_pickup").find(".btn-remove-po").addClass("disabled");
        $("#mainTable-request_pickup").find(".fg-po").last().find(".btn-remove-po").removeClass("disabled");
        
    }
}
Request_pickup.prototype.addChosen = function(el=null){

        var parent = (el!=null) ? $(el).closest(".collapse") : $("form");
        parent.find('.select2').chosen({
            placeholder_text_single: 'Select an option',
            no_results_text: "Oops, không tìm thấy!"
        })
        if ($('.chosen-search').length && !$('.chosen-search i').length) {
            $('.chosen-search').append('<i class="glyph-icon icon-search"></i>');
        }
        $('.chosen-single div').html('<i class="glyph-icon icon-caret-down"></i>');
    
}
Request_pickup.prototype.send = function(data,url,option={}){
    var domain = $("#back_url").val();
    return new Promise((resolve, reject) => {
        $.ajax({
            url: domain + "/" + url,
            type: "POST",
            data: data,
            beforeSend:function(){
                showProcess(1);
                Request_pickup.addLoading();
            },
            complete:function(){
                hideLoading();
                Request_pickup.removeLoading();
            },
            success: function(res) {
                if (res != null) {

                    if(option.html){
                        resolve(res);
                    }else{
                        res = JSON.parse(res);
                        resolve(res.data);
                    }
                    
                } else {
                    reject({});
                }
            },
            timeout: 20000,
            error: function(jqXHR, textStatus, errorThrown) {
                hideLoading();
                Request_pickup.removeLoading();
                reject({});
            },
        });
    })
}

Request_pickup.prototype.minimizeHeader = function(){
    if(this.id=='undifined'||this.id==null||this.id=='')
    this.body.find("a[href=#info-request]").click();
}
Request_pickup.prototype.addRemoveListItems = function(){
    var rp = this;
    var table = $('#itemList table');
        var checked = table.find('input:checked:not(".cb-all")').closest('tr');
        if (checked.length > 0) {
             $.alerts.confirm('Are you sure you want to delete?', 'Confirm',function (r) {
                if (r) {

                    $.ajax(checked.remove())
                    .then(()=>rp.refreshTableItem()).then(()=>{
                        var po = checked.data('po');
                        // trigger calculator total cost
                        table.find("[data-po="+po+"]").find("[name*=Bank_Cost]").change();
                    });

                    table.find('.cb-all').prop('checked', false);
                    
                }
            })
        }
}

Request_pickup.prototype.refreshTableItem = async function(){
    
    var table = $('#itemList table');
    var data = [];
    // get all po on table
    table.find(".footer-group").each(function(){
       data.push($(this).data("po"));
    })
    // check exist row or sub row
    var poRemove = [];
    await data.forEach(function(v){
        var len = table.find("[data-po="+v+"].highlightNoClick").length;
        if(len==0) poRemove.push(v)
    })

    // remove group-footer don't have row
    await poRemove.forEach(function(v){
        table.find("[data-po="+v+"]").remove();
    })

    // remove po on maintable
    await poRemove.forEach(function(v){
        $(".btn-po.btn-remove-po").each(function(){
            var selected = $(this).closest(".fg-po").find("select").val()
            if(selected==v) $(this).closest(".fg-po").remove();
        })
    })

    // set number no
        // set row
        var no = 0;
        table.find(".highlightNoClick[data-po]").each(function(){
            no++;
            $(this).find("td.col-no").text(no);
         })
         no = 0;
         table.find(".highlightNoClick1[data-po]").each(function(){
            no++;
            $(this).find("input.itemKey").val(no);
         })
         
        //set group
        no = 0;
        table.find(".footer-group[data-po]").each(function(){
            no++;
            $(this).find("td").first().text(no+".");
        })

    if(no==0){
        $("#OrderType").removeClass('disabled');
    }
    // //refresh calc total and all input
    // table.find("input").each(function(){
    //     $(this).change();
    // })
}
class MainTable extends Request_pickup{
    constructor(){
        
        super("#mainTable-request_pickup")
        
    }
    static BtnCheckPart(id,did){
        return `<input type="checkbox" name="" class="cb-ele" value="" data-master="${id}" data-detail="${did}">`;
    }
    addEventListener(){
        var mt = this;
        this.root.on("click",".btn-add-po",function(){
            mt.addPo(this);
        }).on("click", ".btn-remove-po", function() {
            mt.removePo(this)
        }).on("change", "select.PONo", async function() {
            mt.changeSelectPo(this);
        }).on("change","select#VendorID",function(){
            mt.changeSelectVendor(this);
        }).on('change', 'select#CompanyID',function() {
            mt.changeSelectCompany(this);
        }).on('change', 'select#StaffNumber',function(){
            mt.changeSelectStaff(this)
        }).on('hide.bs.collapse','#info-request',function(){
            mt.toggleHeader("closed")
        }).on('show.bs.collapse','#info-request',function(){
            mt.toggleHeader("open")
        }).on("click",".btn-insert-part",function(){
            mt.insertPart(this);
        }).on("change",'select#ShippingCarrier',function(){
            mt.changeSelectCarry(this);
        }).on("change","select.ContractNo",function(){
            mt.changeSelectSC(this);
        }).on("change","#OrderType",function(){
            mt.changeOrderType(this);
        })

    }
}
MainTable.prototype.changeOrderType = function(el){
    var status = $(el).find("option:checked").val();
    console.log({status});
    if(status==0){
        $("#po-information .fg-header-po").removeClass("hidden");
        $(".btn-info.waves-effect").addClass("hidden");
    }else{
        $("#po-information .fg-header-po").addClass("hidden");
        $(".btn-info.waves-effect").removeClass("hidden");
    }

    // remove all po draft
    $("#po-information .fg-po").remove();
}
MainTable.prototype.autoSelectInfoShipping = async function(pono){

    var arraySelector = await this.send({id:pono},'getInfoShipping');

    $.each(arraySelector,function(k,v){
        $(".infor-shipping-term").find("[name="+k+"]").val(v);
        $(".infor-shipping-term").find("[name="+k+"]").closest("div").find(".chosen-single span").html(v);
    })

}
MainTable.prototype.validPoSelected = function(data,form_groups){
    var isNull = {status:false,name:'bị'};
    form_groups.find("input").each(function(){
        var name = $(this).prop("name");
        var val = $(this).val();
        data.forEach((k)=>{
            var text = new RegExp(k,'i');
            if(name.match(text)&&!isNull.status&&!val){
                isNull = {status:true,name:k};
            }       

        })
    })
    if(isNull.status||!data){
        showNoti("Dữ liệu "+isNull.name+" trống!","Vui lòng kiểm tra lại","Err")
        return false;
    }
    return true;
}
MainTable.prototype.insertPart = async function(el){
    var form_groups = $(el).closest(".fg-po");
    var value = form_groups.find("select.PONo").val();

    var data = ['PODate','ContractNo','ContractDate','CustomerPONo','CPODate','ImportMethod'];

    var had_po = $("#OrderType").find("option:checked").val();
    if(had_po==0){

        if(!this.validPoSelected(data,form_groups)) return false;

        var data  = await this.send({value},'getListPart');
        var html = await this.createInsertPartTable(data);
        this.openModelInsertPart(html);
        return true;
    }

    // insert null item
    var mlo = new ModalListOld();
    mlo.addPart();
    

}
MainTable.prototype.createPoRow = function(options,key){
    
    return `<div class="form-group group-required fg-po fg-po-${key}" data-selected="${key}">
        
                                <div class="row">
                                    <div class="col-sm-6">
                                        
                                        <div class="row">
                                            <div class="col-sm-3">
                                                ${options.po}
                                                <input type="hidden" class="POCode" name="PO[${key}][POCode]" id="POCode${key}" >
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class=" form-control input-required" name="PO[${key}][PODate]" id="PODate${key}" value="" placeholder="PO date" title="PO date" autocomplete="off"  readonly>
                                                <div class="errordiv PODate${key}">Not Empty</div>
                                            </div>
                                            <div class="col-sm-3">
                                                    ${options.sc}

                                                    <input type="hidden" id="ContractNo_${key}" name="PO[${key}][ContractNo]" class="SCCode" value="" data-required="1">
                                                    <div class="errordiv ContractNo${key}">Not Empty</div>
                                            </div>
                                            <div class="col-sm-3">
                                                <input type="text" class=" form-control input-required" name="PO[${key}][ContractDate]" id="ContractDate${key}" value="" placeholder="Contract date" title="Contract date" autocomplete="off"  readonly>
                                                <div class="errordiv ContractDate${key}">Not Empty</div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <div class="input-group"> 
                                                    <input id="CustomPoNo${key}" name="PO[${key}][CustomerPONo]" class="form-control" value="" placeholder="Custom Do No" readonly>
                                                    <div class="errordiv CustomPoNo${key}">Not Empty</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-3"> 
                                                <input type="text" class="form-control input-required" name="PO[${key}][CPODate]" id="CPODate${key}" value="" placeholder="CPO Date" title="CPO Date" autocomplete="off"  readonly>
                                                <div class="errordiv CPODate${key}">Not Empty</div>
                                            </div>
                                            <div class="col-sm-4"> 
                                                <input type="text" class="form-control input-required" name="PO[${key}][ImportMethod]" id="ImportMethod${key}" value="" placeholder="Import method" title="Import method" autocomplete="off" readonly>
                                                <div class="errordiv ImportMethod3">Not Empty</div>
                                            </div>
                                        </div>
                                        <div class="btn-part btn-insert-part" title="Click to insert Part"><a href="javascript:;"><i class="glyph-icon icon-list-alt"></i></a></div>
                                        <div class="btn-po btn-remove-po" title="Click to remove PO"><a href="javascript:;"><i class="fa fa-close"></i></a></div>
                                    </div>
                                </div>
                            </div>`;
}
MainTable.prototype.addPo = async function(el){
    var group_insert = $("#po-information").find(".fg-po[data-selected]");
        var data_selected = group_insert.length>0 ? group_insert.last().data("selected") :0;
        var key = data_selected + 1;
        var options = {};

        options['sc'] = await this.send({key},"htmlSelectSC");

        options['po'] = await this.send({key},"htmlSelectPo");

        var html = this.createPoRow(options,key);

        // insert first row when group empty
        if (group_insert.length>0) {
            // group_insert.last().find(".btn-remove-po").addClass("disabled");
            group_insert.last().after(html);
           
        } else {
            $(".fg-header-po").after(html);
        }

        await this.addChosen(el);

        await this.addDatePicker(key);

}
MainTable.prototype.addDatePicker = function(key){
    // add date picker
    $('#po-information .fg-po-' + key).find('.bootstrap-datepicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'vi',
        autoclose: true,
        todayHighlight: true
    });
}
MainTable.prototype.openModelInsertPart = function(html){
    
    $('#modal-list-old .modal-body').empty().append(html);
    $('#modal-list-old').modal('show');
}
MainTable.prototype.createInsertPartTable = function(data){
    var header = `<div class="table-responsive">
    <table class="table-modal table table-hover">
        <thead>
        <tr class="nodrop">
            <th nowrap="nowrap"><input type="checkbox" class="cb-all"></th>
            <th nowrap="nowrap">Supplier Part #</th>
            <th nowrap="nowrap">Mfr Part # des </th>
            <th nowrap="nowrap">Manufacturer</th>
            <th nowrap="nowrap">Package / Case</th>
            <th nowrap="nowrap" class="center">SPQ</th>
            <th nowrap="nowrap" class="center">Order Qty</th>
            <th nowrap="nowrap">Delivery date / Comments</th>
            <th nowrap="nowrap">Origin Of Country</th>
        </tr>
        </thead>
        <tbody>`;
    var footer = `</tbody></table></div>`;
    var body = '';
    data.forEach(function(item){

        body+=`<tr>`;
        body+='<td>'+MainTable.BtnCheckPart(item['poid'],item['did'])+'</td>';

        delete item['poid'];
        delete item['did'];

        $.each(item,function(k,v){
            switch (k) {
                case 'MfrPart':
                    body+=`<td>
                    <span class="mfr-part">${v}</span> 
                    <span class="desc" title="${item['Description']}">${item['Description']}</span>
                </td>`;
                    delete item['Description'];
                    
                    break;
                case 'Image':
                    body+=`<td><img src="${v}" style="max-width: 27px;"></td>`;
                    break;
                default:
                    body+=`<td class="${v}">${v}</td>`;
                    break;
            }
            
        })
        body+=`</tr>`;

    })

    return header + body + footer;
}
MainTable.prototype.removePo = function(el){
    var index = $(el).closest(".fg-po").find(".PONo").val();
    var po = $(el).closest(".fg-po").find(".PONo option:selected").text();
    var mt = this;
            $.alerts.confirm(`Are you sure you want to delete PO : <br />ID - ${po} ?<br />`, 'Confirm',async function(r) {

                if(r==true){
                    if(index) $('#itemList .mainTable').find("[data-po="+index+"]").remove();
                    await $("#po-information").find(".PONo").each(function(){
                        var val = $(this).val();
                        if(val == index) $(this).closest(".fg-po").remove();
                    })
                    
                    $(el).closest(".fg-po").remove();
                    
                    mt.refreshTableItem();
            
                    
                }

            })
        
        
}
MainTable.prototype.changeSelectSC = async function(el){
    var value = $(el).val();
    var form_groups = $(el).closest(".fg-po");
    form_groups.find('input.SCCode[type="hidden"]').val(value);
    var res = await this.send({id:value},'getSCDate');

    if(res) form_groups.find("[name*=ContractDate]").val(res.SCDate);

    var value_po = form_groups.find("select.PONo").val();
    data = await this.send({value:value_po},'getListPart');
    
    var html = await this.createInsertPartTable(data);
    
    this.openModelInsertPart(html);

}
MainTable.prototype.changeSelectPo = async function(el){
    var value = $(el).val();
        
    var form_groups = $(el).closest(".fg-po");
    
    form_groups.find("input[name*=PO]").each(function(){
        $(this).val("");
    })
    var data = await this.send({id:value}, 'getPoSelected');
    var validData = [];

    // set data
    if(data){
        $.each(data, function(k, v) {
            form_groups.find("input[name*=" + k + "]").val(v);
            validData.push(k);
        })
    }

    if(!this.validPoSelected(validData,form_groups)) return false;

    //set code po 
    var text = $(el).find('option:selected').text();
    text = text.replace(/\d.*\s/,"");
    
    form_groups.find('input.POCode[type="hidden"]').val(text);
    
    form_groups.find("select.ContractNo").click();

}
MainTable.prototype.changeSelectVendor = async function(el){
    var value = $(el).val();
        var form_group = $("#1st-information");
        var data = await this.send({id:value}, 'getVendorSelected');

        $.each(data, function(v, k) {
            form_group.find("input[name*=" + v + "]").val(k);
        })
}
MainTable.prototype.changeSelectCarry = async function (el){
    var value = $(el).val();
    var form_group = $("#2nd-information");
    var data = await this.send({id:value}, 'changeSelectCarry');

    $.each(data, function(v, k) {
        form_group.find("input[name*=" + v + "]").val(k);
    })
}
MainTable.prototype.changeSelectCompany = async function(el) {
    var value = $(el).val();
    var form_groups = $("#1st-information");
    var data = await this.send({id:value}, 'getCompanyIDSelected');

    $.each(data, function(v, k) {
        form_groups.find("input[name*=" + v + "]").val(k);
    })
}
MainTable.prototype.changeSelectStaff = async function(el) {
    var value = $(el).val();
    var form_groups = $("#1st-information");
    var data = await this.send({id:value}, 'getStaffIDSelected');
    $.each(data, function(v, k) {
        form_groups.find("input[name*=" + v + "]").val(k);
    })
}
MainTable.prototype.toggleHeader = function(option){
    switch (option) {
        case "open":
            $(".approved_close").css("margin","0 1.5rem")
            break;
    
        default:
            $(".approved_close").css("margin","0rem 0rem")
            break;
    }
}


class ItemList extends Request_pickup {
    constructor(el=null){
        el = (el==null) ? "#itemList .mainTable" : el;
        super(el)
    }

    addEventListener(){
        var il = this;
        this.root
        .on("change","input.buying-amount,input[name*=Total_Cost]",function(){
            il.calcCOGS(this);
        })
        .on("change","input[name*=percent]",function(){
            il.calculatorPercent(this);
        })
        .on("change","input[type=checkbox].cb-ele",function(){
            il.checkAll(this);
        })
        .on("change","input[name*=quantity],input[name*=price]",function(){
            il.calAmount(this);
        })
        .on("change","input[name*=GW]",function(){
            il.calShippingCost(this,true);
        })
        // .on("change","input.col-shipping_cost,input.col-back_cost,input.col-declare_cost",function(){ 
        //     il.calcTotalCost(this);
        // })
    }

}

ItemList.prototype.calShippingCost = function(el,isCheck=false){

    var mainRow = $(el).closest(".highlightNoClick");
    var unitCostShip = $("#attribution .attr-Unit").val();
    var amount_ship_cost = unitCostShip*$(el).val();
    amount_ship_cost = round(amount_ship_cost) == amount_ship_cost ? amount_ship_cost : amount_ship_cost.toFixed(2);
    mainRow.find("input[name*=Shipping_Cost]").val(amount_ship_cost);
    mainRow.find("input[name*=Shipping_Cost]").trigger("change");

    if(isCheck&&!unitCostShip)
        showNoti("The Unit Shipping Cost don't have data !","Update Failed", "Err")

}
ItemList.prototype.calAmount = function(el){

    var mainRow, subRow;
    // different case when target input quantity or price
    mainRow = $(el).closest(".highlightNoClick");

    if(mainRow.html()){
        // target quantity
        subRow = mainRow.next();
    }else{
        // target price
        subRow = $(el).closest(".highlightNoClick1");
        mainRow = subRow.prev();
    }

    var quantity = mainRow.find("input[name*=quantity]").val();
    var price = subRow.find("input[name*=price]").val();
    var amount = quantity*price;
    
    amount = round(amount) == amount ? amount : amount.toFixed(2); 
    subRow.find("input[name*=amount]").val(amount);
    subRow.find("input[name*=amount]").trigger("change");

}
ItemList.prototype.checkAll = function(el){
        
    // check sub row 
    var po = $(el).closest("tr").prop("id");
    var status = $(el).prop("checked");
    $("#itemList .mainTable").find("#"+po+"sub").find("input[type=checkbox].cb-ele").prop("checked",status);

}
ItemList.prototype.calcPercent = function(selector,component,target){

    var selectName = $(selector).prop("name");
    var id = selectName.replace( /([A-Z]|[a-z]|\[|\]|_){1,}/g, '');
    var mainRow = $("#PO"+id);
    var subRow = $("#PO"+id+"sub");
    var divindend = mainRow.find('[name*='+component[0]+']').val()
    divindend = divindend ? parseFloat(divindend) : 0;
    var divisor = subRow.find('[name*='+component[1]+']').val()
    divisor = (divisor||divisor==0) ? parseFloat(divisor) : 1;
    var per = (divindend/divisor)*100;

    if(per&&divisor!=1){
        per = round(per)==per ? per : per.toFixed(2); 
        subRow.find("[name*="+target+"]").val(per+"%")
    }

    if(divindend==0) subRow.find("[name*="+target+"]").val("");
    
}
ItemList.prototype.calculatorPercent = async function(el){
    // row percent change
    component = ['Total_Cost','COGS'];
    target = ['percent'];
    await this.calcPercent(el,component,target);

    // group percent change
    component = ['col-total_cost'];
    var total_cost = await this.sumTotalOnGroup(el,component,'main');
    component = ['COGS'];
    var COGS = await this.sumTotalOnGroup(el,component,'sub');
    var po = $(el).closest('tr').data("po");
    COGS['COGS'] = (COGS['COGS']||COGS['COGS']==0) ? COGS['COGS'] : 1;
    var per = (total_cost['col-total_cost']/COGS['COGS'])*100;
    per = per ? per.toFixed(2) : 0;
    $("[data-po="+po+"].footer-group").find(".percent span").text(per);

    // // add po-total-percent
    // $("[data-po="+po+"].footer-group").find("[name=po-total-percent]").val(per);
    // // add po-total-cost
    // $("[data-po="+po+"].footer-group").find("[name=po-total-cost]").val(total_cost['col-total_cost']);
    // // add po-total-cogs
    // $("[data-po="+po+"].footer-group").find("[name=po-total-cogs]").val(COGS['COGS']);

}
ItemList.prototype.sumTotalOnRow = function(selector,component,target){
    
    var sum = 0;
    var row = $(selector).closest("tr");
    component.forEach((v)=>{
        var value = row.find(v).val();
        value = value ? parseFloat(value) : 0;
        sum +=value;
    })
    sum = round(sum)==sum ? sum : sum.toFixed(2)
    row.find(target).val(sum);

}
ItemList.prototype.sumTotalOnGroup = function(selector,component,option="main"){
    var po = $(selector).closest("tr").data("po");
    var row = '';
    var sumReturn = {};
    // get main row or sub row
    if(option=="main"){
        var mainRow = $("[data-po="+po+"].highlightNoClick");
        row = mainRow;
    }else{
        var subRow = $("[data-po="+po+"].highlightNoClick1");
        row = subRow;
    }
    
    // set sum for each component
    component.forEach(function(item){
        var sum = 0;
        row.each(function(){
            var v = $(this).find("."+item).val()
            v = v? parseFloat(v) : 0;
            sum+=v;
        })
        sum = sum ? sum : 0;
        sum = round(sum) == sum ? sum : sum.toFixed(2);
        sumReturn[item] = sum;
        $("[data-po="+po+"].footer-group").find("."+item).find("span").text(sum);
    })
   
    return sumReturn;
}
ItemList.prototype.triggerChangeCalcPer = function(el){
    // trigger calc percent
    var po = $(el).closest("tr").data("po");
    $("[data-po="+po+"].highlightNoClick1").find(".percent").change();     
}

ItemList.prototype.calcTotalCost = async function(el){
    var component = ['input.col-shipping_cost','input.col-back_cost','input.col-declare_cost'];
    var target = 'input.col-total_cost';
    await this.sumTotalOnRow(el,component,target);

    component = ['input[name*=Pickup]','input[name*=Local]','input[name*=transport]'];
    await this.sumValueOnAttr(el,component,target);

    await $(el).closest("tr").find("input.col-total_cost").trigger("change");

    component = ['col-total_cost'];
    await this.sumTotalOnGroup(el,component,'main');

    this.triggerChangeCalcPer(el);
}
ItemList.prototype.sumValueOnAttr = function(el,component,target){

    var mainRow = $(el).closest("tr");
    var sumAttr = 0;
    var attrRow = $("#attribution");
    component.forEach((v)=>{

        var value = attrRow.find(v).val();
        value = value ? parseFloat(value) : 0;
        sumAttr += value;

    })
    var total = parseFloat(mainRow.find(target).val());
    // cost each row part = (local cost + pickup cost + transport charge)/quantity row of part
    var cost_part = sumAttr/$("#itemList").find(target).length;
    total += parseFloat(cost_part);
    total = round(total) == total ? total : total.toFixed(2);

    mainRow.find(target).val(total);
 
}
ItemList.prototype.subCalcCOGS = function(el){
    var mainRow,subRow;
    
    mainRow = $(el).closest(".highlightNoClick");

    if(mainRow.html()){
        // change total cost
        subRow = mainRow.next();
    }else{
        // change buying amount
        subRow = $(el).closest(".highlightNoClick1");
        mainRow = subRow.prev();
    }

    // var component = ['input.buying-price','input.buying-amount'];
    // var target = 'input.COGS';
    // await this.sumTotalOnRow(el,component,target);
    var totalCost = mainRow.find("input[name*=Total_Cost]").val();
    var buyingAmount = subRow.find("input[name*=amount]").val();

    var COGS = parseFloat(totalCost) + parseFloat(buyingAmount);
    COGS = round(COGS) == COGS ? COGS : COGS.toFixed(2);

    subRow.find("input[name*=COGS]").val(COGS);
}
ItemList.prototype.calcCOGS = async function(el){

    await this.subCalcCOGS(el);

    component = ['buying-amount','COGS'];
    await this.sumTotalOnGroup(el,component,'sub');

    await this.triggerChangeCalcPer(el);
}

class AttributeFooter extends ItemList{
    constructor(){
        super('#attribution')
    }
    addEventListener(){
        var af = this;

        this.root.on("focusout","input.attr-Pickup,input.attr-Local,input.attr-trans,input.attr-Unit",function(){
            var component = ['input.attr-Amount','input.attr-Pickup','input.attr-Local','input.attr-trans'];
            var target = 'input.attr-Total';
            af.sumTotalRow(this,component,target);
        }).on("change","input.attr-Weight.shipping,input.attr-Unit",async function(){
            var component = ['input.attr-Weight.shipping','input.attr-Unit'];
            var target = 'input.attr-Amount';
            await af.multiOnRow(this,component,target);
        }).on("change","input.attr-Weight.bank,input.attr-bank,input.attr-declare",async function(){
            var component = ['input.attr-Weight.bank','input.attr-bank','input.attr-declare'];
            var target = 'input.attr-Total';
            af.sumTotalRow(this,component,target);
        }).on("change","input.attr-Custom[name*=Custom]",function(){
            // $(this).closest("tr").find("input.attr-Total").val($(this).val());
            var component = ['input.attr-Custom[name*=Custom]']
            var target = 'input.attr-Total';
            af.sumTotalRow(this,component,target);
        }).on("click",".btn-execute-cost",function(){
            af.excuteCost();
        })

    }
}
AttributeFooter.prototype.addBankCostToRow = function(){
    var rows = $("#itemList input[name*=Bank_Cost]");

    var attr_cost = $("#attribution").find("[name*=2].attr-Total").val();
    var bank_cost = attr_cost/rows.length;
    bank_cost = round(bank_cost) == bank_cost ? bank_cost : bank_cost.toFixed(2);
    rows.each(function(){
        $(this).val(bank_cost);
    })
}
AttributeFooter.prototype.addDeclareCostToRow = function(){
    var rows = $("#itemList input[name*=Declare_Cost]");

    var attr_cost = $("#attribution").find("[name*=3].attr-Total").val();
    var declare_cost = attr_cost/rows.length;
    declare_cost = round(declare_cost) == declare_cost ? declare_cost : declare_cost.toFixed(2);
    rows.each(function(){
        $(this).val(declare_cost);
    })
}
AttributeFooter.prototype.excuteCost = async function(msg='Data'){

    var af = this;
    showProcess(1);
    // shipping cost
    await $("#itemList input[name*=GW]").each(function(){
        
        af.calShippingCost(this);
    })
    // add attr-bank and attr-declare
    await this.addBankCostToRow();
    await this.addDeclareCostToRow();

    // update total cost
    await $("#itemList input[name*=Declare_Cost]").each(function(){
        af.calcTotalCost(this);
    })

    hideLoading();
    
    showNoti(msg+" have been changed in sheet!","Update "+msg, "War")
}
AttributeFooter.prototype.multiOnRow = function(selector,component,target){

    var multi = 1;
    var row = $(selector).closest("tr");
    component.forEach((v)=>{
        var value = row.find(v).val();
        value = value ? parseFloat(value) : 1;
        multi *=value;
    })
    multi = round(multi)==multi ? multi : multi.toFixed(2)
    row.find(target).val(multi);

}
AttributeFooter.prototype.sumTotalRow = async function(el,component,target){

    await this.sumTotalOnRow(el,component,target);

    // sum final total
    var sum = 0;
    $("#attribution").find("input.attr-Total").each(function(){
        var value = parseFloat($(this).val());
        value = value ? value : 0;
        sum+=value;
    })
    sum = round(sum) == sum ? sum : sum.toFixed(2);
    $("#cost_total").text(sum);
}
class ModalListOld extends Request_pickup {
    constructor(){
        super("#modal-list-old")
    }
    addEventListener(){
        var mlo = this;
        this.root.on('click','.btn-add-part',function(){
            mlo.addPart(this);
        }).on("click","input",function(){
            setTimeout(()=>mlo.changeTxtAdd(),100);
        })
    }
}
ModalListOld.prototype.changeTxtAdd = function(){

    var value = $("#modal-list-old").find("tbody").find("input.cb-ele:checked").length;
    var text = value==0? "Add":"Add("+value+")";
    $("#modal-list-old").find(".modal-footer").find(".btn-success").text(text);
}
ModalListOld.prototype.addPart = async function(el=null){

    var data = {row:[],key:1};
    if(el!=null){
        var tbody = $(el).closest(".modal").find(".modal-body").find("tbody");
        tbody.find("input.cb-ele:checked").each(function(){
                var item = $(this).data();
                data['row'].push(item);
        })
    }
    

    var row = $('#itemList .mainTable .highlightNoClick').length;
    var group = $('#itemList .mainTable .footer-group.bg-primary').length;
    var key = $('#itemList .mainTable .highlightNoClick').last().data("key");
    var pono = el!=null ? data['row'][0]['master'] :'';
    data.index = row + 1;
    data.key = key +1;
    data.group = group + 1;
    var html = await this.send(data,'insertPartPO',{'html':true});

    // refresh txt btn add
    $("#modal-list-old").find(".modal-footer").find(".btn-success").text("Add");

    await this.addRow(html,pono);

    // trigger calculator total cost in row part
    $("[data-po].highlightNoClick").find("input[name*=Bank_Cost]").change();

    // disable switch type
    $("#OrderType").addClass('disabled');
    // disable select when cliend add part
    if(data.row.length>0) this.disablePoChosse(); 
    
    var newItem = $("[data-po].highlightNoClick.new-item");
    await this.scrollTopSmooth(newItem);

    this.refreshTableItem();

    // auto select shipping information
    // isFirstChose
    // get data
    if($(".infor-shipping-term").data("empty")){
        var mt = new MainTable();
        mt.autoSelectInfoShipping(pono);
        $(".infor-shipping-term").data("empty",false);
    }


}

ModalListOld.prototype.disablePoChosse = function(){
    $('.fg-po').last().find("select.PONo").addClass("disabled");
    $('.fg-po').last().find("input:not(:hidden)").each(function(){
        $(this).addClass("disabled");
    })
}
ModalListOld.prototype.addRow = async function(string,pono=null){
    // remove all class new-item
    $("#itemList table tr").each(function(){
        $(this).removeClass("new-item");
    })
    
    // exist po -> insert on group else append
    var index = 0;
    var poExist = false;
    $("#itemList .footer-group").each(function(){
        var value = $(this).data("po");
        if(value == pono){
            poExist = true;
            index = $(this).index();
        } 
    })

    if(!poExist)
        $('#itemList table tbody').append(string);

    if(poExist){
        var oldGroup = $("#itemList tr").eq(index+2);
        oldGroup.remove();

        $("#itemList tr").eq(index+1).after(string);
        // this.removePoDuplicate(pono);
    }

}


$(document).ready(function(){
    var rp = new Request_pickup();
    rp.addEventListener();
    rp.afterLoaded();
    var mt = new MainTable();
    mt.addEventListener();
    var il = new ItemList();
    il.addEventListener();
    var af = new AttributeFooter();
    af.addEventListener();
    var mlo = new ModalListOld();
    mlo.addEventListener();
})