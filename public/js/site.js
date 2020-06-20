$(document).ready(function(){
    $.getScript("https://cdn.jsdelivr.net/npm/sweetalert2@9");
});

var csrftLarVe = $('meta[name="csrf-token"]').attr("content");

function swalErrorMsg(msg) {
    Swal.fire({
        icon: 'error',
        title: '<h3 class="text-danger">Warning</h3>',
        html: '<h5>' + msg + '!!!</h5>'
    });
}

function swalSuccessMsg(msg) {
    Swal.fire({
        icon: 'success',
        title: '<h3 class="text-success">Thank You</h3>',
        html: '<h5>' + msg + '</h5>'
    });
}

function loadingOrProcessing(sms) {
    var strHtml = '';
    strHtml += '<div class="alert alert-icon-right alert-green alert-dismissible fade in mb-2" role="alert">';
    strHtml += '      <i class="icon-spinner10 spinner"></i> ' + sms;
    strHtml += '</div>';
    //strHtml += '<script>setTimeout(function(){ $(".alert-dismissible").hide(); }, 4000);</script>';

    return strHtml;

}

function warningMessage(sms) {
    var strHtml = '';
    strHtml += '<div class="alert alert-icon-left alert-danger alert-dismissible fade in mb-2" role="alert">';
    strHtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    strHtml += '<span aria-hidden="true">×</span>';
    strHtml += '</button>';
    strHtml += sms;
    strHtml += '</div>';
    strHtml += '<script>setTimeout(function(){ $(".alert-dismissible").hide(); }, 4000);</script>';
    return strHtml;
}

function successMessage(sms) {
    var strHtml = '';
    strHtml += '<div class="alert alert-icon-left alert-success alert-dismissible fade in mb-2" role="alert">';
    strHtml += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    strHtml += '<span aria-hidden="true">×</span>';
    strHtml += '</button>';
    strHtml += sms;
    strHtml += '</div>';
    strHtml += '<script>setTimeout(function(){ $(".alert-dismissible").hide(); }, 4000);</script>';
    return strHtml;
}

function searchInvoice(strSearch,strSearchParam){
    console.log('Invoice Search Init= ',strSearch);
    console.log('Invoice Search Init= ',strSearchParam);
        
        $("#search_result_loader").html(loadingOrProcessing("Loading Search Result, Please Wait..."));
        //------------------------Ajax Customer Start-------------------------//
        var AddHowMowKhaoUrl = searchnucleus;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': { 
                'search': strSearch, 
                'search_param': strSearchParam, 
                '_token': csrftLarVe, 
            },
            'success': function(data) {
                console.log("Completing Sales : " + data);
                
                if(data.status == 0)
                {
                    $('#invoice_table').dataTable().fnClearTable();
                    $('#invoice_table').dataTable().fnDestroy();
                    var new_row = "<tr><td colspan='9' class='text-xs-center'>No Invoice Record Found : Search Result </td></tr>";
                    $("#invoice_table").find("tbody").html(new_row);
                    $("#search_result_loader").html(warningMessage("No Invoice Record Found Related To Search."));
                    $("#invoice_total_record").addClass("text-danger");
                }
                else
                {

                    

                    $("#invoice_total_record").addClass("text-success");
                    $("#invoice_total_record").html(data.status)
                    var new_row = '';
                    new_row = '';
                    $.each(data.invoice, function(key,row){
                        //console.log(row);
                        new_row += '<tr>';
                        new_row += '    <td>'+row.invoice_id+'</td>';
                        new_row += '    <td>'+row.created_at+'</td>';
                        new_row += '    <td>'+row.product_name+'</td>';
                        new_row += '    <td>'+row.customer_name+'</td>';
                        new_row += '    <td>'+row.tender_name+'</td>';
                        new_row += '    <td>'+row.invoice_status+'</td>';
                        new_row += '    <td>'+row.total_amount+'</td>';
                        new_row += '    <td>'+row.paid_amount+'</td>';
                        new_row += '    <td><a target="_blank" class="btn btn-success" href="'+viewInvoiceURL+'/'+row.id+'"><i class="icon-eye"></i> View Invoice</a></td>';
                        new_row += '</tr>';
                    });
                    $("#invoice_table").find("tbody").html(new_row);
                    $("#invoice_table").DataTable();
                    $("#search_result_loader").fadeOut('slow');

                    var exTotal = $("#total_search_found").html();
                    var newTotal = (exTotal-0) + (data.status-0);
                    $("#total_search_found").html(newTotal);
                }
                
            }
        });
        //------------------------Ajax Customer End---------------------------//
}

function searchInventoryRepair(strSearch,strSearchParam){
    console.log('Inventory Repair Search Init= ',strSearch);
    console.log('Inventory Repair Search Init= ',strSearchParam);
        
        $("#inventory_repair_search_result_loader").html(loadingOrProcessing("Loading Search Result, Please Wait..."));
        //------------------------Ajax Customer Start-------------------------//
        var AddHowMowKhaoUrl = searchInventoryRepairURL;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': { 
                'search': strSearch, 
                'search_param': strSearchParam, 
                '_token': csrftLarVe, 
            },
            'success': function(data) {
                console.log("Completing Sales : " + data);
                
                if(data.status == 0)
                {
                    $('#inventory_repair_table').dataTable().fnClearTable();
                    $('#inventory_repair_table').dataTable().fnDestroy();
                    var new_row = "<tr><td colspan='8' class='text-xs-center'>No Invoice Record Found : Search Result </td></tr>";
                    $("#inventory_repair_table").find("tbody").html(new_row);
                    $("#inventory_repair_search_result_loader").html(warningMessage("No Invoice Record Found Related To Search."));
                    $("#inventory_repair_total_record").addClass("text-danger");
                }
                else
                {
                    $("#inventory_repair_total_record").addClass("text-success");
                    $("#inventory_repair_total_record").html(data.status)
                    var new_row = '';
                    new_row = '';
                    $.each(data.invoice, function(key,row){
                        console.log('Repair',row);
                        new_row += '<tr>';
                        new_row += '    <td>'+row.id+'</td>';
                        new_row += '    <td>'+row.created_at+'</td>';
                        new_row += '    <td>'+row.customer_name+'</td>';
                        new_row += '    <td>'+row.product_name+'</td>';
                        new_row += '    <td>'+row.price+'</td>';
                        new_row += '    <td>'+row.payment_status+'</td>';
                        new_row += '    <td>'+row.invoice_id+'</td>';
                        new_row += '    <td><a target="_blank" class="btn btn-success" href="'+viewRepairURL+'/'+row.id+'"><i class="icon-eye"></i> View Repair</a></td>';
                        new_row += '</tr>';
                    });
                    $("#inventory_repair_table").find("tbody").html(new_row);
                    $("#inventory_repair_table").DataTable();
                    $("#inventory_repair_search_result_loader").fadeOut('slow');

                    var exTotal = $("#total_search_found").html();
                    var newTotal = (exTotal-0) + (data.status-0);
                    $("#total_search_found").html(newTotal);
                }
                
            }
        });
        //------------------------Ajax Customer End---------------------------//
}

function searchNonInventoryRepair(strSearch,strSearchParam){
    console.log('Non-Inventory Repair Search Init= ',strSearch);
    console.log('Non-Inventory Repair Search Init= ',strSearchParam);
        
        $("#non_inventory_repair_search_result_loader").html(loadingOrProcessing("Loading Search Result, Please Wait..."));
        //------------------------Ajax Customer Start-------------------------//
        var AddHowMowKhaoUrl = searchNonInventoryRepairURL;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': { 
                'search': strSearch, 
                'search_param': strSearchParam, 
                '_token': csrftLarVe, 
            },
            'success': function(data) {
                console.log("Completing Sales : " + data);
                
                if(data.status == 0)
                {
                    $('#non_inventory_repair_table').dataTable().fnClearTable();
                    $('#non_inventory_repair_table').dataTable().fnDestroy();
                    var new_row = "<tr><td colspan='10' class='text-xs-center'>No Record Found : Search Result </td></tr>";
                    $("#non_inventory_repair_table").find("tbody").html(new_row);
                    $("#non_inventory_repair_search_result_loader").html(warningMessage("No Record Found Related To Search."));
                    $("#non_inventory_repair_total_record").addClass("text-danger");
                }
                else
                {
                    $("#non_inventory_repair_total_record").addClass("text-success");
                    $("#non_inventory_repair_total_record").html(data.status)
                    var new_row = '';
                    new_row = '';
                    $.each(data.invoice, function(key,row){
                        console.log('Repair',row);
                        new_row += '<tr>';
                        new_row += '    <td>'+row.id+'</td>';
                        new_row += '    <td>'+row.created_at+'</td>';
                        new_row += '    <td>'+row.customer_name+'</td>';
                        new_row += '    <td>'+row.product_name+'</td>';
                        new_row += '    <td>'+row.problem_name+'</td>';
                        new_row += '    <td>'+row.our_cost+'</td>';
                        new_row += '    <td>'+row.retail_price+'</td>';
                        new_row += '    <td>'+row.payment_status+'</td>';
                        new_row += '    <td>'+row.invoice_id+'</td>';
                        new_row += '    <td><a target="_blank" class="btn btn-success" href="'+viewTicketURL+'/'+row.id+'"><i class="icon-eye"></i> View Ticket</a></td>';
                        new_row += '</tr>';
                    });
                    $("#non_inventory_repair_table").find("tbody").html(new_row);
                    $("#non_inventory_repair_table").DataTable();
                    $("#non_inventory_repair_search_result_loader").fadeOut('slow');

                    var exTotal = $("#total_search_found").html();
                    var newTotal = (exTotal-0) + (data.status-0);
                    $("#total_search_found").html(newTotal);
                }
                
            }
        });
        //------------------------Ajax Customer End---------------------------//
}

function searchCustomerNuc(strSearch,strSearchParam){
    console.log('searchCustomerNuc Search Init= ',strSearch);
    console.log('searchCustomerNuc Search Init= ',strSearchParam);
        
        $("#customer_search_result_loader").html(loadingOrProcessing("Loading Search Result, Please Wait..."));
        //------------------------Ajax Customer Start-------------------------//
        var AddHowMowKhaoUrl = searchCustomerURL;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': { 
                'search': strSearch, 
                'search_param': strSearchParam, 
                '_token': csrftLarVe, 
            },
            'success': function(data) {
                console.log("Completing Sales : " + data);
                
                if(data.status == 0)
                {
                    $('#customer_table').dataTable().fnClearTable();
                    $('#customer_table').dataTable().fnDestroy();
                    var new_row = "<tr><td colspan='8' class='text-xs-center'>No Record Found : Search Result </td></tr>";
                    $("#customer_table").find("tbody").html(new_row);
                    $("#customer_search_result_loader").html(warningMessage("No Record Found Related To Search."));
                    $("#customer_total_record").addClass("text-danger");
                }
                else
                {
                    $("#customer_total_record").addClass("text-success");
                    $("#customer_total_record").html(data.status)
                    var new_row = '';
                    new_row = '';
                    $.each(data.invoice, function(key,row){
                        console.log('Repair',row);
                        new_row += '<tr>';
                        new_row += '    <td>'+row.id+'</td>';
                        new_row += '    <td>'+row.name+'</td>';
                        new_row += '    <td>'+row.address+'</td>';
                        new_row += '    <td>'+row.phone+'</td>';
                        new_row += '    <td>'+row.email+'</td>';
                        new_row += '    <td>'+row.last_invoice_no+'</td>';
                        new_row += '    <td>'+row.created_at+'</td>';
                        new_row += '    <td><a target="_blank" class="btn btn-success" href="'+viewCustomerURL+'/'+row.id+'"><i class="icon-eye"></i> View Customer</a></td>';
                        new_row += '</tr>';
                    });
                    $("#customer_table").find("tbody").html(new_row);
                    $("#customer_table").DataTable();
                    $("#customer_search_result_loader").fadeOut('slow');

                    var exTotal = $("#total_search_found").html();
                    var newTotal = (exTotal-0) + (data.status-0);
                    $("#total_search_found").html(newTotal);
                }
                
            }
        });
        //------------------------Ajax Customer End---------------------------//
}

function searchProductNuc(strSearch,strSearchParam){
    console.log('searchProductNuc Search Init= ',strSearch);
    console.log('searchProductNuc Search Init= ',strSearchParam);
        
        $("#product_search_result_loader").html(loadingOrProcessing("Loading Search Result, Please Wait..."));
        //------------------------Ajax Customer Start-------------------------//
        var AddHowMowKhaoUrl = searchProductURL;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': { 
                'search': strSearch, 
                'search_param': strSearchParam, 
                '_token': csrftLarVe, 
            },
            'success': function(data) {
                console.log("Completing Sales : " + data);
                
                if(data.status == 0)
                {
                    $('#product_table').dataTable().fnClearTable();
                    $('#product_table').dataTable().fnDestroy();
                    var new_row = "<tr><td colspan='9' class='text-xs-center'>No Record Found : Search Result </td></tr>";
                    $("#product_table").find("tbody").html(new_row);
                    $("#product_search_result_loader").html(warningMessage("No Record Found Related To Search."));
                    $("#product_total_record").addClass("text-danger");
                }
                else
                {
                    $("#product_total_record").addClass("text-success");
                    $("#product_total_record").html(data.status)
                    var new_row = '';
                    new_row = '';
                    $.each(data.invoice, function(key,row){
                        console.log('Repair',row);
                        new_row += '<tr>';
                        new_row += '    <td>'+row.id+'</td>';
                        new_row += '    <td>'+row.category_name+'</td>';
                        new_row += '    <td>'+row.barcode+'</td>';
                        new_row += '    <td>'+row.name+'</td>';
                        new_row += '    <td>'+row.quantity+'</td>';
                        new_row += '    <td>'+row.price+'</td>';
                        new_row += '    <td>'+row.cost+'</td>';
                        new_row += '    <td>'+row.created_at+'</td>';
                        new_row += '</tr>';
                    });
                    $("#product_table").find("tbody").html(new_row);
                    $("#product_table").DataTable();
                    $("#product_search_result_loader").fadeOut('slow');

                    var exTotal = $("#total_search_found").html();
                    var newTotal = (exTotal-0) + (data.status-0);
                    $("#total_search_found").html(newTotal);
                }
                
            }
        });
        //------------------------Ajax Customer End---------------------------//
}

function searchNucleus(strSearch,strSearchParam){
    searchInvoice(strSearch,strSearchParam);
    setTimeout(() => {
        searchInventoryRepair(strSearch,strSearchParam);
    }, 1000);
    setTimeout(() => {
        searchNonInventoryRepair(strSearch,strSearchParam);
    }, 2000);
    
}

$('.fullscreen-search-input').on('keypress',function(e) {
    if(e.which == 13) {
        findnCOnvertParam();
        $('form.fullscreen-search-form').submit();
    }
});

$('.fullscreen-search-submit').on('click',function(e) {
    findnCOnvertParam();
    $('form.fullscreen-search-form').submit();
});

function findnCOnvertParam(){
    var  nuc_search_all = 0;
       if($('#nuc-search-all').is(":checked")){ nuc_search_all = 1; }

       var  nuc_search_customer = 0;
       if($('#nuc-search-customer').is(":checked")){ nuc_search_customer = 1; }

       var  nuc_search_invoice = 0;
       if($('#nuc-search-invoice').is(":checked")){ nuc_search_invoice = 1; }

       var  nuc_search_repair = 0;
       if($('#nuc-search-repair').is(":checked")){ nuc_search_repair = 1; }

       var  nuc_search_ticket = 0;
       if($('#nuc-search-ticket').is(":checked")){ nuc_search_ticket = 1; }

       var  nuc_search_product = 0;
       if($('#nuc-search-product').is(":checked")){ nuc_search_product = 1; }

       var search_param  = {};
       search_param['nuc_search_all']=nuc_search_all;
       search_param['nuc_search_customer']=nuc_search_customer;
       search_param['nuc_search_invoice']=nuc_search_invoice;
       search_param['nuc_search_repair']=nuc_search_repair;
       search_param['nuc_search_ticket']=nuc_search_ticket;
       search_param['nuc_search_product']=nuc_search_product;
     
       var encode_param = JSON.stringify(search_param);

       console.log(search_param);
       console.log(encode_param);

       $("input[name=search_param]").val(encode_param);
}
    
    //$(".fullscreen-search-close").trigger('click');
//});