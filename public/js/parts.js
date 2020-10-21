console.log('Parts.js Initiated');
function clearNonInventoryRepair(){
    $("input[name=device]").val("");
    $("input[name=problem_type]").val("");
    $("input[name=cost]").val("");
    $("input[name=price]").val("");
    $("input[name=password]").val("");
    $("input[name=imei]").val("");
    $("textarea[name=notes]").val("");
    $("input[name=directcart]").val("");
    $("select[name=parts_id]").val("").trigger('change');
    $("#parts_table").html("");
    $("#parts_table").parent().parent().hide();
    return false;
}

$(".rep_parts").hide();
$(".rep_repairs").hide();
$("#parts_table").parent().parent().hide();

function defineRowSR(tag){
    var sl=1;
    var total=0;
    $(tag).each(function(k,r){
        $(r).children('td:eq(0)').html(sl);
        sl++;
        total++;
    });

    if(total==0)
    {
        $("#parts_table").parent().parent().hide();
    }
    else
    {
        $("#parts_table").parent().parent().show();
    }
}

function removeParts(id){
    $("#"+id).remove();
}

$(document).ready(function(){

    $('body').on('click','.removeParts',function(){
        var dataRem=$(this).attr('data-id');
        $("#"+dataRem).remove();
        defineRowSR("#parts_table tr");
    });

    // $('body').on('click','#savenaddtoCartPosPage',function(){
    //     $("input[name=directcart]").val(1);
    //     $("#finishRepairAndListAdd").trigger("click");
    // });

    
    $('body').on('click','#saveRepairnaddtoCartpos',function(){
        $("input[name=directcart]").val(1);
        var customer_id=$("select[name=customer_id]").val();
        if(customer_id.length == 0)
        {
            swalErrorMsg("Please select a customer."); return false;
        }

        var formData=$("#repair_new_form").serializeArray();
        console.log(formData);
        Swal.showLoading();
        var data_gg = {};
        var data_gg_row = {};
        var data_ggrow = [];
        var data_ggrow_price = [];
        
        $.each(formData,function(kk,rorr){
            console.log(rorr);
            data_gg_row = {};
            if(rorr.name!="repair_parts_id")
            {
                if(rorr.name!="repair_parts_id[]")
                { 
                    if(rorr.name!="repair_parts_price[]")
                    { 
                        data_gg[rorr.name]=rorr.value; 
                    }
                }

                
                if(rorr.name=="repair_parts_id[]"){ data_ggrow.push(rorr.value); }
                if(rorr.name=="repair_parts_price[]"){ data_ggrow_price.push(rorr.value); }
            }
            
        });
        data_gg['customer_id']=customer_id;
        data_gg['repair_parts_id']=data_ggrow;
        data_gg['repair_parts_price']=data_ggrow_price;
        data_gg['_token']=csrftLarVe;
        console.log(data_gg);
        console.log(data_ggrow);
        console.log(data_ggrow_price);

        //return false;
        //return false;
        //var data_param={ 'form_data': formData, '_token': csrftLarVe }
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': product_pos_parts_repair_save_url,
            'data': data_gg,
            'success': function(data) {
                Swal.hideLoading();
                console.log(data);
                if(data.status==1 && data.directcart==1)
                {
                    
                    swalSuccessMsg(data.msg);
                    setTimeout(() => {
                        window.location.href=product_pos_parts_repair_to_send_pos_url+"/"+data.repair_id;
                    }, 2000);
                    clearNonInventoryRepair();

                    return false;
                }
                else
                {
                    swalErrorMsg(data.msg); return false;
                }
                
                //console.log("Adding New Product : "+data)
            }
        });
    });

    $('body').on('click','#finishRepairAndListAdd',function(){

        var customer_id=$("select[name=customer_id]").val();
        if(customer_id.length == 0)
        {
            swalErrorMsg("Please select a customer."); return false;
        }

        var formData=$("#repair_new_form").serializeArray();
        console.log(formData);
        Swal.showLoading();
        var data_gg = {};
        var data_gg_row = {};
        var data_ggrow = [];
        var data_ggrow_price = [];
        
        $.each(formData,function(kk,rorr){
            console.log(rorr);
            data_gg_row = {};
            if(rorr.name!="repair_parts_id")
            {
                if(rorr.name!="repair_parts_id[]")
                { 
                    if(rorr.name!="repair_parts_price[]")
                    { 
                        data_gg[rorr.name]=rorr.value; 
                    }
                }

                
                if(rorr.name=="repair_parts_id[]"){ data_ggrow.push(rorr.value); }
                if(rorr.name=="repair_parts_price[]"){ data_ggrow_price.push(rorr.value); }
            }
            
        });
        data_gg['customer_id']=customer_id;
        data_gg['repair_parts_id']=data_ggrow;
        data_gg['repair_parts_price']=data_ggrow_price;
        data_gg['_token']=csrftLarVe;
        console.log(data_gg);
        console.log(data_ggrow);
        console.log(data_ggrow_price);
        //return false;
        //var data_param={ 'form_data': formData, '_token': csrftLarVe }
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': product_pos_parts_repair_save_url,
            'data': data_gg,
            'success': function(data) {
                Swal.hideLoading();
                console.log(data);
                if(data.status==1)
                {
                    
                    swalSuccessMsg(data.msg);
                    clearNonInventoryRepair();
                    return false;
                }
                else
                {
                    swalErrorMsg(data.msg); return false;
                }
                
                //console.log("Adding New Product : "+data)
            }
        });
    });



    var productPartsConfig = (function () {
        var productPartsConfig = null;
            $.ajax({
                'async': false,
                'global': false,
                'url': product_pos_settings_parts_url,
                'dataType': "json",
                'success': function (data) {
                    productPartsConfig = data;
                }
            });
            return productPartsConfig;
    })(); 
    
    $(".add_pos_parts").click(function(){
        var parts_id=$("#parts_id").val();
        console.log(parts_id);
        var optHtml='';
        $.each(productPartsConfig,function(key,row){
            if(row.id==parts_id)
            {
                var idgne=Math.floor(Math.random() * 100) + 1;
                var puslableID="rep_parts_"+row.id+""+idgne;
                optHtml+='<tr id="'+puslableID+'">';
                    optHtml+='<td>1</td>';
                    optHtml+='<td>'+row.name+'<input type="hidden" name="repair_parts_id[]" value="'+row.id+'" /></td>';
                    optHtml+='<td><input type="text" style="width: 72px;" class="form-control" name="repair_parts_price[]" value="'+row.price+'" /></td>';
                    optHtml+='<td><button data-id="'+puslableID+'" class="btn btn-danger removeParts" type="button"><i class="icon-trash"></i></button></td>';
                optHtml+='</tr>';
            }
            
        });
        $("#parts_table").append(optHtml);
        defineRowSR("#parts_table tr");


    });

    $("#repair_option").change(function(){
        var repair_options_id=$(this).val();
        if(repair_options_id.length==0)
        {
            $(".rep_parts").hide();
            $(".rep_repairs").hide();
            alert("Please choose repair options."); return false;
        }

        $(".rep_parts").hide();
        $(".rep_repairs").hide();
        $("#parts_table").html("");
        $("#parts_table").parent().parent().hide();
        if(repair_options_id=="repair_parts")
        {
            $(".rep_repairs").show();
            $(".rep_parts").show();
        }
        else if(repair_options_id=="repair")
        {
            $(".rep_repairs").show();
        }
        else if(repair_options_id=="parts")
        {
            
            $(".rep_parts").show();
        }
    });
});

$(document).ready(function(){
    $(".add_pos_parts_bk").click(function(){
        var product_id = $('#parts_id').val();    
        if(product_id.length == 0)
        {
            swalErrorMsg("Invalid product Info, Please choose product parts.");
        } 
        else
        {
            var productFound = 0;
            $.each(productJson, function(rindex, row) {
                if (row.id == product_id) {
                    //console.log(row);
                    $("#qty").val(1);
                    $("#stoke").val(row.quantity);
                    $("#price").val(row.price);
                    $("#product_name").val(row.name);
                    $("#imei").val(row.imei);
                    $("#brand").val(row.brand_name);
                    $("#model").val(row.model_name);
                    $("#pro_id").val(row.id);
                    productFound = 1;
                    add_pos_cart(row.id, row.price, row.name);
                }
            });
            //swalSuccessMsg("Sales Invoice Generated Successfully.");
        }
        
    });

    $(".add_pos_non_inventory").click(function(){
        var device = $("input[name=non_inventory_device]").val();
        var problem_type = $("input[name=non_inventory_problem_type]").val();
        var cost = $("input[name=non_inventory_cost]").val();
        var price = $("input[name=non_inventory_price]").val();
        var password = $("input[name=non_inventory_password]").val();
        var imei = $("input[name=non_inventory_imei]").val();
        var notes = $("textarea[name=non_inventory_notes]").val();
//non_inventory_repair_pos
        if(device.length == 0){ swalErrorMsg("Please enter non-inventory device name.");  return false; }
        if(problem_type.length == 0){ swalErrorMsg("Please enter non-inventory problem type."); return false; }
        if(cost.length == 0){ swalErrorMsg("Please enter non-inventory repair cost."); return false; }
        if(price.length == 0){ swalErrorMsg("Please enter non-inventory repair price."); return false; }
        var product_name = device+' - '+problem_type;
        var product_detail = notes;
        var data_param={ 'device': device, 'problem_type': problem_type, 'cost': cost, 'price': price, 'password': password, 'imei': imei, 'notes': notes, '_token': csrftLarVe }
        var ProductID;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': non_inventory_repair_pos,
            'data': data_param,
            'success': function(data) {
                if(data.status==1)
                {

                    ProductID = data.pid;
                    add_pos_cart(ProductID, price, product_name,data_param);
                    swalSuccessMsg("Non-Inventory Repair Added Successfully.");
                    clearNonInventoryRepair();
                }
                else
                {
                    swalErrorMsg("Please enter non-inventory repair notes."); return false;
                }
                
                //console.log("Adding New Product : "+data)
            }
        });

    });

    

});