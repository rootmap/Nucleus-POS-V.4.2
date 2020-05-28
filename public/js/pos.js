var csrftLarVe = $('meta[name="csrf-token"]').attr("content");

function loadingOrProcessing(sms) {
    var strHtml = '';
    strHtml += '<div class="alert alert-icon-right alert-green alert-dismissible fade in mb-2" role="alert">';
    strHtml += '      <i class="icon-spinner10 spinner"></i> ' + sms;
    strHtml += '</div>';
    strHtml += '<script>setTimeout(function(){ $(".alert-dismissible").hide(); }, 4000);</script>';

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

$('.dropableCartZone').droppable({
    drop: handleDropEvent
});


$('select[name=customer_id]').parent('div').children('span:eq(1)').children('span').children('span').attr('style', 'border-radius:0px !important;');

function handleDropEvent(event, ui) {
    $("#cartMessageProShow").html(loadingOrProcessing("Processing, Please Wait....!!!!"));
    var item_id = ui.draggable.attr("id");
    //console.log('ItemID=',item_id);

    var data_pro_id = $("#" + item_id).attr("data-pro-id");
    var data_pro_name = $("#" + item_id).attr("data-pro-name");
    var data_pro_name = data_pro_name.replace(/'/g, "");;
    var data_pro_price = $("#" + item_id).attr("data-pro-price");
    //console.log('string in JS = ',exTasl);
    add_pos_cart(data_pro_id, data_pro_price, data_pro_name);
    //add_pos_cart
    //$("#"+item_id).trigger( "click" )
    //alert(ui.draggable.attr("id"));
    // Here I want the id of the dropped object
}

function loadCustomerList() {
    var ff = "<option ";
    var fff = "<option ";
    ff += selectedDefCusPOSSCRvFour;
    fff += selectedDefCusPOSSCRvFour;

    ff += " value=''>SELECT CUSTOMER</option>";
    fff += " value=''>SELECT CUSTOMER</option>";
    ff += '<option value="0">CREATE NEW CUSTOMER</option>';
    var defCusID = defCusIDCusPOSSCRvFour;

    $.each(cusObjData, function(index, row) {
        //console.log(row);  

        if (defCusID == row.id) {
            ff += "<option selected='selected' value='" + row.id + "'>" + row.name + "</option>";
            fff += "<option selected='selected' value='" + row.id + "'>" + row.name + "</option>";
        } else {
            ff += "<option value='" + row.id + "'>" + row.name + "</option>";
            fff += "<option value='" + row.id + "'>" + row.name + "</option>";
        }


    });

    $("select[name=customer_id]").html(ff);
    $("select[name=sales_return_customer_id]").html(fff);
    $("select[name=buyback_customer_id]").html(fff);
    //$("select[name=partialpay_customer_id]").html(fff);

    $("select[name=sales_return_customer_id]").select2({
        dropdownParent: $("#salesReturn")
    });

    $("select[name=sales_return_sales_invoice_id]").select2({
        dropdownParent: $("#salesReturn")
    });


    ff = "";
    fff = "";
}

function liveRowCartEdit(rowID) {
    var rowData = $("#" + rowID).children("td:eq(1)").html();
    if ($("#" + rowID).children("td:eq(1)").children("input").val()) {

        //console.log(rowData);
    } else {
        var rowDataPrice = $("#" + rowID).children("td:eq(2)").find("span").html();
        var inputDataQuantity = '<input type="text" style="width:50px;" value="' + rowData + '" onkeyup="updateLiveCartQuantity(' + rowID + ')"  onchange="updateLiveCartQuantity(' + rowID + ')" />';
        var inputDataPrice = '<input type="text"  style="width:50px;"  value="' + rowDataPrice + '" onkeyup="updateLiveCartQuantity(' + rowID + ')"  onchange="updateLiveCartQuantity(' + rowID + ')" />';
        $("#" + rowID).children("td:eq(1)").html(inputDataQuantity);
        $("#" + rowID).children("td:eq(2)").find("span").html(inputDataPrice);
        $("#" + rowID).children("td:eq(4)").children("a:eq(0)").show();
    }

}

function alignProductLine() {
    $.each($(".add-pos-cart"), function(index, row) {
        var charStr = $.trim($(row).html()).length;
        if (charStr <= 15) {
            $(row).addClass('one-make-full');
        }
    });
}

function storecloseLTTheme(name, price) {
    var conPrice = parseFloat(price).toFixed(2);
    var data = '<tr><td align="left">' + name + ' Collected (+) :  </td><td align="left">$' + conPrice + '</td></tr>';
    return data;
}

function paginationPerfect() {
    $(".pagination").addClass("pagination-round");
    $.each($(".pagination").find("li"), function(index, row) {
        $(row).addClass("page-item");
        $(row).children("a").addClass("page-link");
        //$(row).children("a").addClass("page-link");
        if ($(row).attr("class") == "active page-item") {
            var getPageNumber = $.trim($(row).children("span").html());
            $(row).html('<a href="javascript:void(0);" class="page-link">' + getPageNumber + '</a>');
        }

        /*if($(row).attr("class")=="disabled page-item")
        {
            $(row).html('<a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">Next »</span><span class="sr-only">Next</span></a>');
        }*/



        if ($.trim($(row).children("span").html()).length > 0) {
            if ($.trim($(row).children("span").html()) == "«") {
                var getPageNumber = $.trim($(row).children("span").html());
                //console.log(getPageNumber);
                $(row).html('<a class="page-link" href="#" aria-label="Prev"><span aria-hidden="true">« Prev</span><span class="sr-only">Prev</span></a>');
            }

            if ($.trim($(row).children("span").html()) == "»") {
                var getPageNumber = $.trim($(row).children("span").html());
                //console.log(getPageNumber);
                $(row).html('<a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">Next »</span><span class="sr-only">Next</span></a>');
            }

        }

        if ($.trim($(row).children("a").html()).length > 0) {
            if ($.trim($(row).children("a").html()) == "«") {
                var getPageNumber = $.trim($(row).children("a").append(" Prev"));
                console.log(getPageNumber);
                //$(row).html('<a class="page-link" href="#" aria-label="Prev"><span aria-hidden="true">« Prev</span><span class="sr-only">Prev</span></a>');
            }

            if ($.trim($(row).children("a").html()) == "»") {
                var getPageNumber = $.trim($(row).children("a").html("Next »"));
                console.log(getPageNumber);
                //$(row).html('<a class="page-link" href="#" aria-label="Next"><span aria-hidden="true">Next »</span><span class="sr-only">Next</span></a>');
            }

        }



    });
}

function loadCloseDrawer() {
    $("#closeStoreMsg").html("");
    $("#close-drawer").modal('show');
    //------------------------Ajax Customer Start-------------------------//
    var AddHowMowKhaoUrl = transactionStoreAddHowMowKhaoUrlCartPOSvfour;
    $.ajax({
        'async': false,
        'type': "POST",
        'global': false,
        'dataType': 'json',
        'url': AddHowMowKhaoUrl,
        'data': { '_token': csrftLarVe },
        'success': function(data) {
            //console.log(data);
            var salesTotal = parseFloat(data.salesTotal).toFixed(2);
            var totalTax = parseFloat(data.totalTax).toFixed(2);
            var opening_amount = parseFloat(data.opening_amount).toFixed(2);
            var totalPayout = parseFloat(data.totalPayout).toFixed(2);
            var totalbuyback = parseFloat(data.buyback).toFixed(2);

            var currectStoreTotal = (salesTotal - 0) + (opening_amount - 0) + (totalPayout - 0) - totalbuyback;

            currectStoreTotal = parseFloat(currectStoreTotal).toFixed(2);

            $("#storeCloseDate").html(data.opening_time);
            $("#storeCloseTotalCollection").html(salesTotal);
            $("#storeCloseOpeningAmount").html(opening_amount);
            $("#storeCloseTaxAmount").html(totalTax);
            $("#totalPayout").html(totalPayout);
            $("#buybackStoreClosingAmount").html(totalbuyback);

            //storeCloseTableTenderList
            var salesDataTendr = data.totalSalesTender;
            var salesDataTendrLength = salesDataTendr.length;
            if (salesDataTendrLength > 0) {
                var htmlSalesString = '';
                $("#storeCloseTableTenderList").html(htmlSalesString);
                $.each(salesDataTendr, function(key, row) {
                    //console.log(row);
                    htmlSalesString += storecloseLTTheme(row.tender_name, row.tender_total);
                });
                $("#storeCloseTableTenderList").html(htmlSalesString);
            }

            $("#currectStoreTotal").html(currectStoreTotal);

            $("#openStoreMsg").html("");
        }
    });
    //------------------------Ajax Customer End---------------------------//
}




function checkerCounterST() {
    var counterStatus = 0;
    var counterString = $("#counterStatusChange").children("span").html();
    if (counterString == "Start Your Counter Display") {
        counterStatus = 1;
        $("#counterStatusChange").children("span").html("Turn-off Your Counter Display");
    } else {
        $("#counterStatusChange").children("span").html("Start Your Counter Display");
    }

    //------------------------Ajax Customer Start-------------------------//
    var AddHowMowKhaoUrl = AddHowMowKhaoUrlcounterdisplaystatuschangeCartPOSvfour;
    $.ajax({
        'async': false,
        'type': "POST",
        'global': false,
        'dataType': 'json',
        'url': AddHowMowKhaoUrl,
        'data': { 'counterStatus': counterStatus, '_token': csrftLarVe },
        'success': function(data) {
            //console.log("Counter Display Status : "+data)
        }
    });
    //------------------------Ajax Customer End---------------------------//
}

function loadCartProBar() {
    var barcode = $("input[name=barcode]").val();
    if (barcode.length == 0) {
        $("#cartMessageProShow").html(warningMessage("Please Type a Barcode No.!!!"));
        return false;
    }
    $("#cartMessageProShow").html(loadingOrProcessing("Product adding to cart, Please Wait....!!!!"));
    var productFound = 0;
    $.each(productJson, function(rindex, row) {
        if (row.barcode == barcode) {
            console.log(row);
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

    $("input[name=barcode]").val("");
    $("input[name=barcode]").focus();

    if (productFound == 0) {
        $("#cartMessageProShow").html(warningMessage("Please Type a Correct Barcode No.!!!"));
        return false;
    }
}

function cc_format(value) {
    var v = value.replace(/\s+/g, '').replace(/[^0-9]/gi, '')
    var matches = v.match(/\d{4,16}/g);
    var match = matches && matches[0] || ''
    var parts = []
    for (i = 0, len = match.length; i < len; i += 4) {
        parts.push(match.substring(i, i + 4))
    }
    if (parts.length) {
        return parts.join(' ')
    } else {
        return value
    }
}

function defineCardNumPurify(num) {
    var resultnum = num.split('^');
    var resultNumLength = resultnum.length;
    console.log(resultnum);
    console.log(resultNumLength);
    if (resultNumLength > 1) {
        var totalNumchar = resultnum[0];
        var perNumchar = totalNumchar.replace(/\D/g, '');

        var cliCardHName = resultnum[1];
        var arrcliCardHName = cliCardHName.split('/');
        var cliCardHNameLength = arrcliCardHName.length;

        var cardHolderName = "";
        if (cliCardHNameLength == 1) {
            cardHolderName = arrcliCardHName[0];
        } else {
            cardHolderName = $.trim(arrcliCardHName[1]) + " " + $.trim(arrcliCardHName[0]);
        }

        var cliCardExYear = resultnum[2];
        var yearcliCard = cliCardExYear.substr(0, 2);
        var monthcliCard = cliCardExYear.substr(2, 2);

        var cardExpiredOn = monthcliCard + " / " + yearcliCard;

        $("#card-number-prototype").val(cc_format(perNumchar));
        $("#card-number").val(cc_format(perNumchar));
        $("#card-name").val(cardHolderName);
        $("#card-expiry").val(cardExpiredOn);
    } else {
        $("#card-number").val(cc_format(num));
    }
}

function readCardInfo() {
    var cardProtype = $("#card-number-prototype").val();
    console.log('Card Info - ', cardProtype);
    defineCardNumPurify(cardProtype);
    var changeEvent = new Event('keyup')
    document.getElementById('card-number').dispatchEvent(changeEvent);
    document.getElementById('card-name').dispatchEvent(changeEvent);
    document.getElementById('card-expiry').dispatchEvent(changeEvent);
    $("#card-number-prototype").val($("#card-number").val());
    return false;
}

function edit_pos_item(id) {
    //console.log(id);

    //console.log($("#dataCart tr[id="+id+"]").html());
    //console.log($("#dataCart tr[id="+id+"]").find("td:eq(0)").html());
    //console.log($("#dataCart tr[id="+id+"]").find("td:eq(1)").html());
    //console.log($("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html());
    //console.log($("#dataCart tr[id="+id+"]").find("td:eq(2)").attr("data-price"));
    var edit_product_name = $("#dataCart tr[id=" + id + "]").find("td:eq(0)").html();
    var edit_quantity = $("#dataCart tr[id=" + id + "]").find("td:eq(1)").html();
    //var edit_unit_price=$("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html();
    $("input[name=edit_product_name]").val($.trim(edit_product_name));
    $("input[name=edit_quantity]").val($.trim(edit_quantity));
    $("input[name=edit_quantity]").attr("onkeyup", "editRowLive(" + id + ")");
    $("input[name=edit_quantity]").attr("onchange", "editRowLive(" + id + ")");
    //$("input[name=edit_unit_price]").val($.trim(edit_unit_price));
    //$("input[name=edit_unit_price]").val($.trim(edit_unit_price));
    $("input[name=edit_id]").val(id);
    $('#editProduct').modal('show');
    //$('#myModal').modal('hide');
}

function genarateSalesTotalCart() {
    if ($("#dataCart tr").length > 0) {
        var subTotalPrice = 0;
        var TotalTax = 0;
        var priceTotal = 0;
        var due = 0;
        var discount = 0;
        var discount_type = 0;

        if ($("select[name=discount_type]").length > 0) {
            discount_type = $("select[name=discount_type]").val();
        }


        var expaid = $.trim($("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html());
        if (expaid == "0") {
            var paid = 0;
        } else {
            var paid = expaid;
        }

        $.each($("#dataCart").find("tr"), function(index, row) {
            var rowPrice = $(row).find("td:eq(3)").children("span").html();
            var rowTax = $(row).find("td:eq(2)").attr("data-tax");
            subTotalPrice += (rowPrice - 0);
            TotalTax += (rowTax - 0);
        });

        var calcDisc = 0;
        if ($("#discount_amount").length > 0) {
            discount = $.trim($("#discount_amount").val());
            if (discount_type == 1) {
                calcDisc = $.trim($("#discount_amount").val());
            } else if (discount_type == 2) {
                calcDisc = ((subTotalPrice * $.trim($("#discount_amount").val())) / 100);
            } else {
                calcDisc = 0;
            }
        } else {
            discount = 0;
        }

        var sumPriceTotal = ((subTotalPrice - 0) + (TotalTax - 0));
        //var calcDisc=((sumPriceTotal*discount)/100);
        sumPriceTotal = sumPriceTotal - calcDisc;
        var sumdues = sumPriceTotal - paid;
        var newdues = parseFloat(sumdues).toFixed(2);
        var newPriceTotal = parseFloat(sumPriceTotal).toFixed(2);
        var newDiscount = parseFloat(calcDisc).toFixed(2);
        var newsubTotalPrice = parseFloat(subTotalPrice).toFixed(2);
        var newTotalTax = parseFloat(TotalTax).toFixed(2);

        if (newdues < 0) { newdues = "0.00"; } else if (newdues == "-0.00") { newdues = "0.00"; }



        $("#posCartSummary tr:eq(2)").find("th").children("span").html(discount + "%");

        $("#posCartSummary tr:eq(0)").find("td:eq(2)").children("span").html(newsubTotalPrice);
        $("#posCartSummary tr:eq(1)").find("td:eq(2)").children("span").html(newTotalTax);
        $("#posCartSummary tr:eq(2)").find("td:eq(2)").children("span").html(newDiscount);
        $("#posCartSummary tr:eq(3)").find("td:eq(2)").children("span").html(newPriceTotal);
        $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(paid);
        $("#posCartSummary tr:eq(5)").find("td:eq(2)").children("span").html(newdues);

        if (parseFloat(paid) > 0) { $("#posCartSummary tr:eq(4)").show(); } else { $("#posCartSummary tr:eq(4)").hide(); }

        if (parseFloat(newTotalTax) > 0) { $("#posCartSummary tr:eq(1)").show(); } else { $("#posCartSummary tr:eq(1)").hide(); }

        if (parseFloat(newDiscount) > 0) { $("#posCartSummary tr:eq(2)").show(); } else { $("#posCartSummary tr:eq(2)").hide(); }

        $("#cartTotalAmount").html(newPriceTotal);

        $("input[name=amount_to_pay]").val(newdues);
        console.log($("input[name=amount_to_pay]").val());
        $("#prmDue").html(newdues);
        $("#totalCartDueToPay").html(newdues);

        $(".posQL").show();

        $(".emptCRTMSG").show();
    } else {
        $("#posCartSummary tr:eq(1)").hide();
        $("#posCartSummary tr:eq(2)").hide();
        $("#posCartSummary tr:eq(4)").hide();

        $("#posCartSummary tr:eq(0)").find("td:eq(2)").children("span").html("0.00");
        $("#posCartSummary tr:eq(1)").find("td:eq(2)").children("span").html("0.00");
        $("#posCartSummary tr:eq(2)").find("td:eq(2)").children("span").html("0.00");
        $("#posCartSummary tr:eq(2)").find("th").children("span").html("0%");
        $("#posCartSummary tr:eq(3)").find("td:eq(2)").children("span").html("0.00");
        $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html("0.00");
        $("#posCartSummary tr:eq(5)").find("td:eq(2)").children("span").html("0.00");

        $("#cartTotalAmount").html("0.00");
        $("input[name=amount_to_pay]").val("0.00");
        $("#prmDue").html("0.00");
        $("#totalCartDueToPay").html("0.00");

        $(".posQL").hide();


        $("#dataCart").html('<tr class="emptCRTMSG"><td colspan="5"><h3 style="height: 50px; text-align: center; line-height: 50px;">No Item on Cart</h3></td></tr>');
        $(".emptCRTMSG").show();
    }


}

function editRowLive(id) {

    var taxRate = taxRatePOSCartInit;
    var unitPrice = $("#dataCart tr[id=" + id + "]").children("td:eq(2)").find("span").children("input").val();
    var edit_quantity = $("#dataCart tr[id=" + id + "]").children("td:eq(1)").children("input").val();
    //console.log($("#dataCart tr[id="+id+"]").find("td:eq(2)").children("span").html());
    $("#dataCart tr[id=" + id + "]").find("td:eq(2)").attr("data-price", unitPrice);
    if ($.isNumeric(edit_quantity)) {
        if (edit_quantity >= 0) {
            var totalPrice = unitPrice * edit_quantity;
        } else {
            edit_quantity = 0;

            var totalPrice = unitPrice * edit_quantity;
            $("#dataCart tr[id=" + id + "]").children("td:eq(1)").children("input").val(edit_quantity);
        }
    } else {
        edit_quantity = 0;
        //$("input[name=edit_quantity]").val(edit_quantity);
        $("#dataCart tr[id=" + id + "]").children("td:eq(1)").children("input").val(edit_quantity);
        var totalPrice = unitPrice * edit_quantity;
    }

    var taxAmount = parseFloat((totalPrice * taxRate) / 100).toFixed(2);
    $("#dataCart tr[id=" + id + "]").children("td:eq(2)").find("span").html(unitPrice);
    $("#dataCart tr[id=" + id + "]").find("td:eq(1)").html(edit_quantity);
    $("#dataCart tr[id=" + id + "]").find("td:eq(3)").children("span").html(totalPrice);
    $("#dataCart tr[id=" + id + "]").find("td:eq(2)").attr("data-tax", taxAmount);
    genarateSalesTotalCart();
    //need to incorporate witth ajax

    //------------------------Ajax POS Start-------------------------//
    var AddPOSUrl = editRowLiveAddPOSUrl + "/" + id + "/" + edit_quantity + "/" + unitPrice;
    $.ajax({
        'async': false,
        'type': "POST",
        'global': false,
        'dataType': 'json',
        'url': AddPOSUrl,
        'data': { '_token': csrftLarVe },
        'success': function(data) {
            //tmp = data;
            console.log("Live Edit Processing : " + data);
        }
    });
    //------------------------Ajax POS End---------------------------//
}

function delposSinleRow(ID) {
    var c = confirm("Are you sure to delete this item.");
    if (c) {
        $("#dataCart tr[id=" + ID + "]").remove();
        genarateSalesTotalCart();
        //------------------------Ajax POS Start-------------------------//
        var AddPOSUrl = delposSinleRowAddPOSUrl + "/" + ID;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddPOSUrl,
            'data': { '_token': csrftLarVe },
            'success': function(data) {
                //tmp = data;
                $("#cartMessageProShow").html(successMessage("Item is deleted successfully."));
            }
        });
        //------------------------Ajax POS End---------------------------//
    }

}

function loadCatProduct(cid) {
    var cid = parseInt(cid);
    if (cid > 0) {
        $("#product_place").html(loadingOrProcessing("Loading Please Wait....!!!!"));
        var proHtml = '';
        var productBgIn = 1;
        var moveavleArray = [];

        $.each(productJson, function(rindex, row) {
            if (row.category_id == cid) {

                var dt = new Date();
                var moveableID = row.id + '' + dt.getHours() + '' + dt.getMinutes() + '' + dt.getSeconds();
                moveavleArray.push(moveableID);

                if (product_image_status == 1) {
                    //image available start
                    var dataImg = row.image;
                    if (dataImg == null) {
                        var imgURL = defaultProductimgURLCartPOSvfour;

                    } else {
                        var imgURL = cartProductImgUrl + '/' + dataImg;
                    }

                    var productName = "'" + row.name + "'";
                    proHtml += '<div class="col-md-3">';
                    proHtml += '<a id="' + moveableID + '" data-pro-id="' + row.id + '" data-pro-price="' + row.price + '"  data-pro-name="' + productName + '" href="javascript:add_pos_cart(' + row.id + ',' + row.price + ',' + productName + ');" class="card mb-1" style="border-bottom-right-radius:3px; border-bottom-left-radius: 3px;">';

                    proHtml += '<div class="card-body" style="border-top-right-radius:3px; border-bottom: 2px green solid; border-top-left-radius: 3px;">';
                    proHtml += '      <img class="card-img-top img-fluid" style="height:100px; width: 100%; border-top-right-radius:3px; border-top-left-radius: 3px;" src="' + imgURL + '" alt="' + productName + '">';
                    proHtml += '</div>';

                    proHtml += '<div class="card-body collapse in">';

                    proHtml += '<div class="p-1 card-header" style="padding: 0.7rem !important;">';
                    proHtml += '      <p style="margin-bottom: 0px !important; min-height: 40px; color: #fff;" class="text-xs-left green" style="color: #fff;">' + row.name + '</p>';
                    proHtml += '</div>';
                    proHtml += '<div class="text-xs-right green" style="line-height: 30px; padding-right: 10px; font-weight: bolder; height: 30px; color: #545a63;">$' + row.price + '</div>';
                    proHtml += '</div>';
                    proHtml += '</a>';
                    proHtml += '</div>';
                    //image available end
                } else {
                    //without image start
                    var productName = "'" + row.name + "'";
                    proHtml += '<div class="col-md-3">';
                    proHtml += '<a id="' + moveableID + '" data-pro-id="' + row.id + '" data-pro-price="' + row.price + '"  data-pro-name="' + productName + '" href="javascript:add_pos_cart(' + row.id + ',' + row.price + ',' + productName + ');" class="card mb-1" style="border-bottom-right-radius:3px; border-bottom-left-radius: 3px;">';
                    proHtml += '<div class="card-body collapse in">';
                    proHtml += '<div class="p-1 card-header  bg-green" style="padding: 0.7rem !important;">';
                    proHtml += '      <p style="margin-bottom: 0px !important; min-height: 40px; color: #fff;" class="text-xs-left" style="color: #fff;">' + row.name + '</p>';
                    proHtml += '</div>';
                    proHtml += '<div class="text-xs-right green" style="line-height: 30px; padding-right: 10px; font-weight: bolder; height: 30px; color: #545a63;">$' + row.price + '</div>';
                    proHtml += '</div>';
                    proHtml += '</a>';
                    proHtml += '</div>';
                    //without image end 
                }

                //console.log(row);
            }


        });

        $("#product_place").html("<hr>" + proHtml);

        $.each(moveavleArray, function(i, r) {
            console.log(r);
            $("#" + r).draggable({ revert: true });
            $("#" + r).css('z-index', '100')
        });

    } else {
        //console.log("Invalid Category ID");
    }
}

function add_pos_cart(ProductID, ProductPrice, ProductName, repairJson = null, dataType = null) {
    $(".emptCRTMSG").remove();
    $("#cartMessageProShow").html(loadingOrProcessing("Processing, Please Wait....!!!!"));
    var ProductID = parseInt(ProductID);
    if (ProductID < 1) {
        $("#cartMessageProShow").html(warningMessage("Invalid Product, Please Try Again."));
        return false;
    }

    var rowTypeforMin = $("#dataCart tr[id=" + ProductID + "]").children('td:eq(1)').children('div').children('span:eq(0)').children('i').attr('class');

    var taxRate = taxRatePOSCartInit;

    if ($("#dataCart tr").length > 0) {

        if ($("#dataCart tr[id=" + ProductID + "]").length) {

            if ($("#dataCart tr[id=" + ProductID + "]").find("td:eq(2)").children("span").children("input").length) {
                $("#cartMessageProShow").html(warningMessage("Failed, Product in edit mode."));
                return false;
            }

            var ProductPrice = parseFloat($("#dataCart tr[id=" + ProductID + "]").find("td:eq(2)").children("span").html()).toFixed(2);

            var ExQuantity = $("#dataCart tr[id=" + ProductID + "]").find("td:eq(1)").children('div').children('input').val();

            console.log('WOrking', ExQuantity);

            if (ExQuantity == 1) {
                console.log('WOrking did', ExQuantity);
                $("#dataCart tr[id=" + ProductID + "]").children('td:eq(1)').children('div').children('span:eq(0)').children('i').attr('class', 'icon-minus');
            }

            var NewQuantity = (ExQuantity - 0) + (1 - 0);
            var NewPrice = (ProductPrice * NewQuantity).toFixed(2);
            var taxAmount = parseFloat((NewPrice * taxRate) / 100).toFixed(2);
            $("#dataCart tr[id=" + ProductID + "]").find("td:eq(1)").children('div').children('input').val(NewQuantity);
            $("#dataCart tr[id=" + ProductID + "]").find("td:eq(3)").children("span").html(parseFloat(NewPrice).toFixed(2));
            $("#dataCart tr[id=" + ProductID + "]").find("td:eq(2)").attr("data-tax", taxAmount);


        } else {



            var quantityPlaceFUnc = "javascript:add_pos_cart(" + ProductID + "," + ProductPrice + ",'" + ProductName + "');";
            var quantityPlace = "";
            quantityPlace += '<div class="input-group" style="border-spacing: 0px !important;">';
            quantityPlace += '  <span class="input-group-addon dedmoreqTv4Ex">';
            quantityPlace += '     <i class="icon-remove"></i>';
            quantityPlace += '  </span>';
            quantityPlace += '  <input style="text-align: center;" type="text" class="form-control directquantitypos" value="1">';
            quantityPlace += '  <span onlclick="' + quantityPlaceFUnc + '" class="input-group-addon addmoreqTv4">';
            quantityPlace += '     <i class="icon-plus addmoreqTv4Ex"></i>';
            quantityPlace += '  </span>';
            quantityPlace += '</div>';

            var taxAmount = parseFloat(((ProductPrice * 1) * taxRate) / 100).toFixed(2);
            var strHTML = '<tr id="' + ProductID + '"><td style="line-height: 35px;">' + ProductName + '</td>';
            strHTML += '<td >' + quantityPlace + '</td>';
            strHTML += '<td  class="priceEdit"  style="line-height: 35px;" data-tax="' + taxAmount + '"  data-price="' + ProductPrice + '">$<span>' + ProductPrice + '</span></td>';
            strHTML += '<td  class="priceEdit"  style="line-height: 35px;">$<span>' + parseFloat(ProductPrice).toFixed(2) + '</span></td>';
            strHTML += '</tr>';

            $("#dataCart").append(strHTML);
        }
    } else {
        var quantityPlaceFUnc = "javascript:add_pos_cart(" + ProductID + "," + ProductPrice + ",'" + ProductName + "');";
        var quantityPlace = '';
        quantityPlace += '<div class="input-group" style="border-spacing: 0px !important;">';
        quantityPlace += '  <span class="input-group-addon dedmoreqTv4Ex">';
        quantityPlace += '     <i class="icon-remove"></i>';
        quantityPlace += '  </span>';
        quantityPlace += '  <input style="text-align: center; " type="text" class="form-control directquantitypos" value="1">';
        quantityPlace += '  <span onlclick="' + quantityPlaceFUnc + '"  class="input-group-addon addmoreqTv4">';
        quantityPlace += '     <i class="icon-plus addmoreqTv4Ex"></i>';
        quantityPlace += '  </span>';
        quantityPlace += '</div>';

        var taxAmount = parseFloat(((ProductPrice * 1) * taxRate) / 100).toFixed(2);
        var strHTML = '<tr id="' + ProductID + '"><td style="line-height: 35px;">' + ProductName + '</td>';
        strHTML += '<td style="line-height: 35px;">' + quantityPlace + '</td>';
        strHTML += '<td  class="priceEdit"  style="line-height: 35px;" data-tax="' + taxAmount + '"  data-price="' + ProductPrice + '">$<span>' + ProductPrice + '</span></td>';
        strHTML += '<td  class="priceEdit"  style="line-height: 35px;">$<span>' + parseFloat(ProductPrice).toFixed(2) + '</span></td>';
        strHTML += '</tr>';

        $("#dataCart").append(strHTML);
    }

    genarateSalesTotalCart();
    $("#cartMessageProShow").html(loadingOrProcessing("Adding To Cart, Please Wait...!!!!"));

    var AddPOSUrl = GAddProductToCartAddPOSUrl + "/" + ProductID;

    var postDatas = { 'product_id': ProductID, 'price': ProductPrice, '_token': csrftLarVe };

    if (repairJson) {
        if (Object.keys(repairJson).length > 0) {
            if (dataType == null) {

                postDatas['repair'] = repairJson;
            } else {
                postDatas[dataType] = repairJson;
            }

        }
    }


    $.ajax({
        'async': false,
        'type': "POST",
        'global': false,
        'dataType': 'json',
        'url': AddPOSUrl,
        'data': postDatas,
        'success': function(data) {
            $("#cartMessageProShow").html(successMessage("Product Added To Cart Successfully."));
        }
    });

}

function add_pos_quantity_cart(ProductID, ProductPrice, quantity) {
    $(".emptCRTMSG").remove();
    $("#cartMessageProShow").html(loadingOrProcessing("Processing, Please Wait....!!!!"));
    var ProductID = parseInt(ProductID);
    if (ProductID < 1) {
        $("#cartMessageProShow").html(warningMessage("Invalid Product, Please Try Again."));
        return false;
    }

    var taxRate = taxRatePOSCartInit;

    if ($("#dataCart tr").length > 0) {

        if ($("#dataCart tr[id=" + ProductID + "]").length) {

            if ($("#dataCart tr[id=" + ProductID + "]").find("td:eq(2)").children("span").children("input").length) {
                $("#cartMessageProShow").html(warningMessage("Failed, Product in edit mode."));
                return false;
            }

            var ProductPrice = parseFloat($("#dataCart tr[id=" + ProductID + "]").find("td:eq(2)").children("span").html()).toFixed(2);

            if (quantity == 1) {
                $("#dataCart tr[id=" + ProductID + "]").children('td:eq(1)').children('div').children('span:eq(0)').html('<i class="icon-remove"></i>');
            } else {
                $("#dataCart tr[id=" + ProductID + "]").children('td:eq(1)').children('div').children('span:eq(0)').html('<i class="icon-minus"></i>');
            }

            //var ExQuantity=$("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").children('div').children('input').val();
            var NewQuantity = quantity;
            var NewPrice = (ProductPrice * NewQuantity).toFixed(2);
            var taxAmount = parseFloat((NewPrice * taxRate) / 100).toFixed(2);
            $("#dataCart tr[id=" + ProductID + "]").find("td:eq(1)").children('div').children('input').val(NewQuantity);
            $("#dataCart tr[id=" + ProductID + "]").find("td:eq(3)").children("span").html(parseFloat(NewPrice).toFixed(2));
            $("#dataCart tr[id=" + ProductID + "]").find("td:eq(2)").attr("data-tax", taxAmount);


        }
    }

    genarateSalesTotalCart();
    $("#cartMessageProShow").html(loadingOrProcessing("Updating cart, Please Wait...!!!!"));

    //------------------------Ajax POS Start-------------------------//
    var AddPOSUrl = editRowLiveAddPOSUrl + "/" + ProductID + "/" + quantity + "/" + ProductPrice;
    $.ajax({
        'async': false,
        'type': "POST",
        'global': false,
        'dataType': 'json',
        'url': AddPOSUrl,
        'data': { '_token': csrftLarVe },
        'success': function(data) {
            console.log("Live Edit Processing : " + data);
            $("#cartMessageProShow").html(successMessage("Cart is updated successfully"));
        }
    });
    //------------------------Ajax POS End---------------------------//

}

var typingTimer; //timer identifier
var doneTypingInterval = 1000; //time in ms, 5 second for example

$(document).ready(function() {

    $('body').on('click', '.dedmoreqTv4Ex', function() {
        var product_ex = $('.directquantitypos').val();

        if (product_ex == 1) {
            $("#cartMessageProShow").html(loadingOrProcessing("Processing, Please Wait....!!!!"));
            var product_id = $(this).parent().parent().parent().attr('id');
            delposSinleRow(product_id);
            return false;
        } else if (product_ex == 2) {
            $("#cartMessageProShow").html(loadingOrProcessing("Processing, Please Wait....!!!!"));
            $(this).parent().children('span:eq(0)').html('<i class="icon-remove"></i>');
        }

        var product_quantity = product_ex - 1;
        $('.directquantitypos').val(product_quantity);

        $("#cartMessageProShow").html(loadingOrProcessing("Processing, Please Wait....!!!!"));
        var product_id = $(this).parent().parent().parent().attr('id');
        var product_name = $(this).parent().parent().parent().children('td:eq(0)').html();
        var product_price = $(this).parent().parent().parent().children('td:eq(2)').attr('data-price');


        clearTimeout(typingTimer);
        if ($('.directquantitypos').val) {
            typingTimer = setTimeout(function() {

                console.log(product_id);
                console.log(product_quantity);
                console.log(product_name);
                console.log(product_price);

                add_pos_quantity_cart(product_id, product_price, product_quantity);

            }, doneTypingInterval);
        }


    });

    $('body').on('click', '.addmoreqTv4', function() {
        var product_ex = $('.directquantitypos').val();
        if (product_ex == 1) {
            $("#cartMessageProShow").html(loadingOrProcessing("Processing, Please Wait....!!!!"));
            $(this).parent().children('span:eq(0)').html('<i class="icon-minus"></i>');
        }


        var product_quantity = (product_ex - 0) + (1 - 0);
        $('.directquantitypos').val(product_quantity);

        $("#cartMessageProShow").html(loadingOrProcessing("Processing, Please Wait....!!!!"));
        var product_id = $(this).parent().parent().parent().attr('id');
        var product_name = $(this).parent().parent().parent().children('td:eq(0)').html();
        var product_price = $(this).parent().parent().parent().children('td:eq(2)').attr('data-price');


        clearTimeout(typingTimer);
        if ($('.directquantitypos').val) {
            typingTimer = setTimeout(function() {

                console.log(product_id);
                console.log(product_quantity);
                console.log(product_name);
                console.log(product_price);

                add_pos_quantity_cart(product_id, product_price, product_quantity);

            }, doneTypingInterval);
        }


    });

    $('body').on('keyup', '.directquantitypos', function() {
        $("#cartMessageProShow").html(loadingOrProcessing("Processing, Please Wait....!!!!"));
        var product_id = $(this).parent().parent().parent().attr('id');
        var product_name = $(this).parent().parent().parent().children('td:eq(0)').html();
        var product_price = $(this).parent().parent().parent().children('td:eq(2)').attr('data-price');
        var product_quantity = $(this).val();

        clearTimeout(typingTimer);
        if ($(this).val) {
            typingTimer = setTimeout(function() {

                console.log(product_id);
                console.log(product_quantity);
                console.log(product_name);
                console.log(product_price);

                add_pos_quantity_cart(product_id, product_price, product_quantity);

            }, doneTypingInterval);
        }



    });

    $('body').on('dblclick', '.priceEdit', function() {
        var product_id = $(this).parent().attr('id');
        var product_name = $(this).parent().children('td:eq(0)').html();
        var product_price = $(this).parent().children('td:eq(2)').attr('data-price');
        var product_quantity = $(this).parent().children('td:eq(1)').children('div').children('input').val();

        $('#loginApprovalForManagerAndAdmin').modal('show');

        $("#ma_product_id").val(product_id);

        console.log('Product ID=', product_id);
        console.log('product_name=', product_name);
        console.log('product_price=', product_price);
        console.log('product_quantity=', product_quantity);
        console.log('dblclick working');
    });




    $('body').on('click', '.verify_ma', function() {
        var ma_email_address = $('input[name=ma_email_address]').val();
        var ma_password = $('input[name=ma_password]').val();



        $('.verify_ma').html('<i class="icon-spinner12 spinner"></i> Verify Credentials');

        if (ma_email_address.length == 0) {
            $('.verify_ma').html('<i class="icon-check2"></i> Verify Credentials');
            $(".ma_verify_msg").html(warningMessage("Enter email address."));
            return false;
        }

        if (ma_password.length == 0) {
            $('.verify_ma').html('<i class="icon-check2"></i> Verify Credentials');
            $(".ma_verify_msg").html(warningMessage("Enter password."));
            return false;
        }

        console.log('ma_email_address ID=', ma_email_address);
        console.log('ma_password=', ma_password);

        $(this).html('<i class="icon-spinner12 spinner"></i> Verify Credentials');

        $(".ma_verify_msg").html(loadingOrProcessing("Verifying login info, Please wait..."));

        //------------------------Ajax POS Start-------------------------//
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': verifyManagerLogin,
            'data': { 'email': ma_email_address, 'password': ma_password, 'remember': 1, '_token': csrftLarVe },
            'success': function(data) {
                $('.verify_ma').html('<i class="icon-check2"></i> Verify Credentials');
                if (data.auth == true) {
                    var product_id = $("#ma_product_id").val();
                    $("#map_product_id").val(product_id);

                    var product_name = $("#dataCart tr[id=" + product_id + "]").find("td:eq(0)").html();
                    var product_price = $("#dataCart tr[id=" + product_id + "]").find("td:eq(2)").attr('data-price');
                    var product_quantity = $("#dataCart tr[id=" + product_id + "]").find("td:eq(1)").children('div').children('input').val();
                    //

                    $("#map_product").val(product_name);
                    $("#map_price").val(product_price);
                    $("#map_quantity").val(product_quantity);

                    $('input[name=ma_email_address]').val("");
                    $('input[name=ma_password]').val("");
                    $("#loginApprovalForManagerAndAdmin").modal('hide');
                    $('#ma_product_edit').modal('show');
                    $(".ma_verify_msg").html(successMessage("Verification done, Loading edit window."));
                } else {
                    $(".ma_verify_msg").html(warningMessage("Wrong credential, Verification Failed."));
                }
                console.log("Info : " + data);

            }
        });
        //------------------------Ajax POS End---------------------------//

    });

    $('body').on('click', '.verify_map', function() {

        $('.verify_map').html('<i class="icon-spinner12 spinner"></i> Updating, Please wait..');

        $(".map_verify_msg").html(loadingOrProcessing("Updating cart info, Please wait..."));

        var product_id = $("#map_product_id").val();
        var product_name = $("#map_product").val();
        var map_price = $("#map_price").val();
        var map_quantity = $("#map_quantity").val();

        if (map_price.length == 0) {
            $('.verify_map').html('<i class="icon-check2"></i> Update');
            $(".map_verify_msg").html(warningMessage("Enter Price."));
            return false;
        }

        if (map_quantity.length == 0) {
            $('.verify_map').html('<i class="icon-check2"></i> Update');
            $(".map_verify_msg").html(warningMessage("Enter Quantity."));
            return false;
        }

        $('.verify_map').html('<i class="icon-spinner12 spinner"></i> Updating, Please wait..');

        $(".map_verify_msg").html(loadingOrProcessing("Updating cart info, Please wait..."));

        var ProductID = parseInt(product_id);
        if (ProductID < 1) {
            $("#cartMessageProShow").html(warningMessage("Invalid Product, Please Try Again."));
            return false;
        }

        var taxRate = taxRatePOSCartInit;

        if ($("#dataCart tr").length > 0) {

            if ($("#dataCart tr[id=" + ProductID + "]").length) {

                if ($("#dataCart tr[id=" + ProductID + "]").find("td:eq(2)").children("span").children("input").length) {
                    $("#cartMessageProShow").html(warningMessage("Failed, Product in edit mode."));
                    return false;
                }

                var ProductPrice = parseFloat(map_price).toFixed(2);

                if (map_quantity == 1) {
                    $("#dataCart tr[id=" + ProductID + "]").children('td:eq(1)').children('div').children('span:eq(0)').html('<i class="icon-remove"></i>');
                } else {
                    $("#dataCart tr[id=" + ProductID + "]").children('td:eq(1)').children('div').children('span:eq(0)').html('<i class="icon-minus"></i>');
                }

                //var ExQuantity=$("#dataCart tr[id="+ProductID+"]").find("td:eq(1)").children('div').children('input').val();
                var NewQuantity = map_quantity;
                var NewPrice = (ProductPrice * NewQuantity).toFixed(2);
                var taxAmount = parseFloat((NewPrice * taxRate) / 100).toFixed(2);
                $("#dataCart tr[id=" + ProductID + "]").find("td:eq(1)").children('div').children('input').val(NewQuantity);
                $("#dataCart tr[id=" + ProductID + "]").find("td:eq(2)").children("span").html(parseFloat(ProductPrice).toFixed(2));
                $("#dataCart tr[id=" + ProductID + "]").find("td:eq(3)").children("span").html(parseFloat(NewPrice).toFixed(2));
                $("#dataCart tr[id=" + ProductID + "]").find("td:eq(2)").attr("data-tax", taxAmount);


            }
        }

        genarateSalesTotalCart();

        var AddPOSUrl = editRowLiveAddPOSUrl + "/" + product_id + "/" + map_quantity + "/" + map_price;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddPOSUrl,
            'data': { '_token': csrftLarVe },
            'success': function(data) {
                $('.verify_map').html('<i class="icon-check2"></i> Update');
                $('#ma_product_edit').modal('hide');
                $("#cartMessageProShow").html(successMessage("Cart is updated successfully"));
            }
        });


    });

    /*$('.addmoreqTv4Ex').click(function(){

        var product_id=$(this).parent().parent().parent().parent().attr('id');
        var product_name=$(this).parent().parent().parent().parent().children('td:eq(0)').html();
        var product_price=$(this).parent().parent().parent().parent().children('td:eq(2)').attr('data-price');

        add_pos_cart(product_id,product_price,product_name);
    });*/

    /*$('.addmoreqTv4').click(function(){

        var product_id=$(this).parent().parent().parent().attr('id');
        var product_name=$(this).parent().parent().parent().children('td:eq(0)').html();
        var product_price=$(this).parent().parent().parent().children('td:eq(2)').attr('data-price');

        add_pos_cart(product_id,product_price,product_name);
    });*/

    $("#card-number-prototype").keyup(function() {
        console.log($(this).val());
        var num = $(this).val();
        $("#card-number").val(num);
        var changeEvent = new Event('keyup')
        document.getElementById('card-number').dispatchEvent(changeEvent);
    });

    loadCustomerList();
    $("body").addClass("page-sidebar-minimize menu-collapsed");

    alignProductLine();
    genarateSalesTotalCart();
    paginationPerfect();

    $("#counterPay").click(function() {
        var counterPays = $("#counterPay").html();
        var counterPay = counterPays.trim();
        console.log(counterPay);
        var counterPayStatus = 0
        if (counterPay == '<i class="icon-close-circled green"></i> Allow pay from counter display') {
            counterPayStatus = 1;
            $("#counterPay").html('<i class="icon-checkmark green"></i> Allow pay from counter display');
        } else {
            $("#counterPay").html('<i class="icon-close-circled green"></i> Allow pay from counter display');
        }

        //---------------------Ajax New Product Start---------------------//
        var AddProductUrl = CounterCartPaymentStatusAddProductUrlCartPOSvfour;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddProductUrl,
            'data': { 'counterPayStatus': counterPayStatus, '_token': csrftLarVe },
            'success': function(data) {
                console.log(data);
            }
        });
        //-----------------Ajax New Product End------------------//
    });

    $("#changeSalesView").click(function() {
        var url = changeSalesViewTwoCartPOSvfour;
        window.location.href = url;
    });
    $(".save-card-customer").click(function() {
        alert('ok');
    });

    $(".savePayout").click(function() {
        var amp = $("#payout_amount").val();
        if ($.isNumeric($.trim(amp))) {
            var newAMP = amp;
        } else {
            var newAMP = 0;
            $("#payout_amount").val(newAMP);
        }
        var payout_reason = $("#payout_reason").val();
        $("#payoutMSG").html(loadingOrProcessing("Saving please wait...."));
        //---------------------Ajax New Product Start---------------------//
        var AddProductUrl = payoutFromPOSScreenCartPOSvfour;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddProductUrl,
            'data': { 'payout_amount': newAMP, 'payout_reason': payout_reason, '_token': csrftLarVe },
            'success': function(data) {
                console.log("Saving Payout : " + data);
                if (data == 1) {
                    $("#payoutMSG").html(successMessage("Payout Saved Successfully."));
                    $("#payout_amount").val("0.00");
                    $("#payout_reason").val("");
                    $("#payoutMSG").hide('slow');
                    $("#payoutModal").modal('hide');
                } else {
                    $("#payoutMSG").html(warningMessage("Failed to saved payout, Please try again."));
                }
            }
        });
        //-----------------Ajax New Product End------------------//
    });


    $(".openStore").click(function() {
        $(".openStore").fadeOut('fast');
        $("#openStoreMsg").html(loadingOrProcessing("Saving please wait...."));

        var openStoreBalance = $.trim($("input[name=openStoreBalance]").val());
        if (openStoreBalance.length == 0) {
            openStoreBalance = 0;
        }

        //------------------------Ajax Customer Start-------------------------//
        var AddHowMowKhaoUrl = OpenStoreAddHowMowKhaoUrlUrlCartPOSvfour;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': { 'openStoreBalance': openStoreBalance, '_token': csrftLarVe },
            'success': function(data) {
                console.log("Store Opening ID : " + data)
                if (data) {
                    $("#openStoreMsg").html(successMessage("Store is open successfully."));
                    $("#open-drawer").modal('hide');
                    $(".opdStore").fadeOut('fast');
                    $(".cldStore").fadeIn('slow');

                    $(".closeStore").fadeIn('fast');

                    $(".checkDrawer").fadeIn('fast');
                } else {
                    $("#openStoreMsg").html(warningMessage("Failed, please try again...."));
                    window.location.href = window.location.href;
                }
            }
        });
        //------------------------Ajax Customer End---------------------------//
        //$(".payModal-message-area").html(warningMessage("Please select a customer."));
    });



    $(".closeStore").click(function() {
        $(".closeStore").fadeOut('fast');
        $("#closeStoreMsg").html(loadingOrProcessing("Saving close drawer, please wait...."));
        var AddHowMowKhaoUrl = closeStoreAddHowMowKhaoUrlCartPOSvfour;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': { '_token': csrftLarVe },
            'success': function(data) {
                if (data) {
                    $("#closeStoreMsg").html(successMessage("Drawer close successfully."));
                    $("#close-drawer").modal('hide');

                    $(".cldStore").fadeOut('slow');
                    $(".opdStore").fadeIn('fast');
                    $(".openStore").fadeIn('fast');

                    $(".checkDrawer").fadeOut('fast');
                } else {
                    $("#closeStoreMsg").html(warningMessage("Failed, please try again...."));
                    window.location.href = window.location.href;
                }
            }
        });
    });

    $(".closePrintStore").click(function() {
        $(".closePrintStore").fadeOut('fast');
        $("#closeStoreMsg").html(loadingOrProcessing("Saving close drawer, please wait...."));
        //------------------------Ajax Customer Start-------------------------//
        var AddHowMowKhaoUrl = closeStoreAddHowMowKhaoUrlCartPOSvfour;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': { '_token': csrftLarVe },
            'success': function(data) {
                console.log("Store Close ID : " + data)
                if (data) {
                    $("#closeStoreMsg").html(successMessage("Drawer close successfully."));
                    $("#close-drawer").modal('hide');

                    $(".cldStore").fadeOut('slow');
                    $(".opdStore").fadeIn('fast');
                    $(".openStore").fadeIn('fast');

                    $(".checkDrawer").fadeOut('fast');

                    var PrintLocation = closeStorePrintLocationAddHowMowKhaoUrlCartPOSvfour + "/" + data;
                    //window.location.href=PrintLocation;

                    var win = window.open(PrintLocation);
                    if (win) {
                        //Browser has allowed it to be opened
                        win.focus();
                        window.location.href = window.location.href;
                    } else {
                        alert('Please allow popups for this website');
                    }

                } else {
                    $("#closeStoreMsg").html(warningMessage("Failed, please try again...."));
                    window.location.href = window.location.href;
                }
            }
        });
        //------------------------Ajax Customer End---------------------------//
        //$(".payModal-message-area").html(warningMessage("Please select a customer."));
    });



    $("#counterStatusChange").click(function() {
        checkerCounterST();
    });


    /*$(".bootstrap-switch-handle-on").click(function(){
        checkerCounterST();
    });
        
    $(".bootstrap-switch-handle-off").click(function(){
        checkerCounterST();
    });

    $(".bootstrap-switch-label").click(function(){
        checkerCounterST();
    });*/

    $('#description').click(function() {
        $('#show_description').toggle("slide");
    });

    $(".close-authorize-payment-modal").click(function() {
        $("#CustomerCard").modal('hide');
    });

    $(".authorize_card_payment").click(function() {
        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            //$("#payModal").modal('hide');
            $(".payModal-message-area").html(warningMessage("Please select a customer."));
            return false;
        }
        var subTotalPrice = 0;
        $.each($("#dataCart").find("tr"), function(index, row) {
            var rowPrice = $(row).find("td:eq(2)").children("span").html();
            subTotalPrice += (rowPrice - 0);
        });

        subTotalPrice = parseFloat(subTotalPrice).toFixed(2);

        if (subTotalPrice < 1) {
            //$("#payModal").modal('hide');
            // alert("Your cart is empty");
            $(".payModal-message-area").html(warningMessage("Your cart is empty"));
            return false;
        }



        var amount_to_pay = $("input[name=amount_to_pay]").val();
        if ($.trim(amount_to_pay) > 0) {
            $("#payModal").modal('hide');
            $("#CustomerCard").modal('show');


            var parseNewPayment = 0;

            var amount_to_pay = $("input[name=amount_to_pay]").val();
            var expaid = $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
            if ($.trim(expaid) == 0) {
                var parseNewPayment = parseFloat(amount_to_pay).toFixed(2);
            } else {
                var newpayment = (expaid - 0) + (amount_to_pay - 0);
                var parseNewPayment = parseFloat(newpayment).toFixed(2);
            }

            $(".card-pay-due-amount").html(parseNewPayment);


        } else {
            $(".payModal-message-area").html(warningMessage("You don't have any due."));
        }
    });

    $(".card-pay-authorizenet").click(function() {

        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            //$("#payModal").modal('hide');
            $(".payModal-message-area").html(warningMessage("Please select a customer."));
            return false;
        }

        var parseNewPayment = 0;

        var amount_to_pay = $("input[name=amount_to_pay]").val();
        var expaid = $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
        if ($.trim(expaid) == 0) {
            var parseNewPayment = parseFloat(amount_to_pay).toFixed(2);
        } else {
            var newpayment = (expaid - 0) + (amount_to_pay - 0);
            var parseNewPayment = parseFloat(newpayment).toFixed(2);
        }


        var cardNumber = $.trim($(".authorize-card-number").val());
        if (cardNumber.length == 0) {
            $(".message-place-authorizenet").html(warningMessage("Please type card number."));
            return false;
        }

        var cardHName = $.trim($(".authorize-card-holder-name").val());
        if (cardHName.length == 0) {
            $(".message-place-authorizenet").html(warningMessage("Please type card holder name."));
            return false;
        }

        var cardExpire = $.trim($(".authorize-card-expiry").val());
        if (cardExpire.length == 0) {
            $(".message-place-authorizenet").html(warningMessage("Please type card expire month/Year."));
            return false;
        }

        var cardcvc = $.trim($(".authorize-card-cvc").val());
        if (cardcvc.length == 0) {
            $(".message-place-authorizenet").html(warningMessage("Please type card cvc/cvc2 pin."));
            return false;
        }

        $(".message-place-authorizenet").html(loadingOrProcessing("Authorizing payment please wait...."));



        var addAuthrizePaymentURL = addAuthrizePaymentURLCartPOSvfour;
        $.ajax({
            'async': true,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': addAuthrizePaymentURL,
            'data': {
                'cardNumber': cardNumber,
                'cardHName': cardHName,
                'cardExpire': cardExpire,
                'cardcvc': cardcvc,
                'amountToPay': parseNewPayment,
                '_token': csrftLarVe
            },
            'success': function(data) {
                console.log("Authrizenet Print Sales ID : " + data);
                if (data == null) {
                    $(".message-place-authorizenet").html(warningMessage("Failed to authorize payment. Please try again."));
                } else {
                    console.log(data.status);
                    if (data.status == 1) {
                        var amount_to_pay = $("input[name=amount_to_pay]").val();

                        var expaid = $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                        if ($.trim(expaid) == 0) {
                            var parseNewPayment = parseFloat(amount_to_pay).toFixed(2);
                            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                        } else {
                            var newpayment = (expaid - 0) + (amount_to_pay - 0);
                            var parseNewPayment = parseFloat(newpayment).toFixed(2);
                            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                        }
                        genarateSalesTotalCart();

                        var AddPOSUrl = makePaymentInitialDefaultAddPOSUrl;
                        $.post(AddPOSUrl, { 'paymentID': 8, 'paidAmount': parseNewPayment, '_token': csrftLarVe }, function(response) {

                        });

                        $(".message-place-authorizenet").html(successMessage(data.message));

                    } else {
                        $(".message-place-authorizenet").html(warningMessage(data.message));
                    }
                }

            }
        });



    });

    $(".authorize_card_refund").click(function() {
        alert('Refund');
    });


    $(".cardpointe_bolt_payment").click(function() {



        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            //$("#payModal").modal('hide');
            $(".payModal-message-area").html(warningMessage("Please select a customer."));
            return false;
        }
        var subTotalPrice = 0;
        $.each($("#dataCart").find("tr"), function(index, row) {
            var rowPrice = $(row).find("td:eq(2)").children("span").html();
            subTotalPrice += (rowPrice - 0);
        });

        subTotalPrice = parseFloat(subTotalPrice).toFixed(2);

        if (subTotalPrice < 1) {
            //$("#payModal").modal('hide');
            // alert("Your cart is empty");
            $(".payModal-message-area").html(warningMessage("Your cart is empty"));
            return false;
        }

        $(".payModal-message-area").html("<div class='col-md-12'>" + loadingOrProcessing("Please wait, checking bolt device.") + "<div>");



        var amount_to_pay = $("input[name=amount_to_pay]").val();
        if ($.trim(amount_to_pay) > 0) {
            //$("#payModal").modal('hide');
            //$("#cardPointeCustomerCard").modal('show');

            //$(".cusStripeAm").html("$"+amount_to_pay);

            var parseNewPayment = 0;

            var amount_to_pay = $("input[name=amount_to_pay]").val();
            var expaid = $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
            if ($.trim(expaid) == 0) {
                var parseNewPayment = parseFloat(amount_to_pay).toFixed(2);
            } else {
                var newpayment = (expaid - 0) + (amount_to_pay - 0);
                var parseNewPayment = parseFloat(newpayment).toFixed(2);
            }

            //$(".card-pay-due-amount").html(parseNewPayment);

            var pingDevice = pingDeviceURLCartPOSvfour;
            $.ajax({
                'async': true,
                'type': "GET",
                'global': false,
                'dataType': 'json',
                'url': pingDevice,
                'success': function(data) {

                    console.log(data);
                    //return false;
                    if (data.connected == false) {
                        $(".payModal-message-area").html("<div class='col-md-12'>" + warningMessage("Please connect your Bolt device with internet.") + "<div>");
                    } else {
                        ///Token Start
                        $(".payModal-message-area").html("<div class='col-md-12'>" + loadingOrProcessing("Generating new session-id for transaction.") + "<div>");

                        var boltTokenCaptureURL = boltTokenCaptureURLCartPOSvfour;
                        $.ajax({
                            'async': true,
                            'type': "POST",
                            'global': false,
                            'dataType': 'json',
                            'url': boltTokenCaptureURL,
                            'data': {
                                'amountToPay': parseNewPayment,
                                '_token': csrftLarVe
                            },
                            'success': function(data) {
                                console.log(data);

                                if (data.connected == false) {
                                    $(".payModal-message-area").html("<div class='col-md-12'>" + warningMessage("Please connect your Bolt device with internet.") + "<div>");
                                } else {
                                    var tokenSession = data.token;
                                    ///Capture Card Start
                                    $(".payModal-message-area").html("<div class='col-md-12'>" + loadingOrProcessing("Please Swipe/Insert your card to device & wait for PIN.") + "<div>");
                                    var boltCaptureURL = boltCaptureURLCartPOSvfour;
                                    $.ajax({
                                        'async': true,
                                        'type': "POST",
                                        'global': false,
                                        'dataType': 'json',
                                        'url': boltCaptureURL,
                                        'data': {
                                            'amountToPay': parseNewPayment,
                                            'cardsession': tokenSession,
                                            '_token': csrftLarVe
                                        },
                                        'success': function(data) {


                                            console.log("cardPointe Bolt Print Sales ID : " + data);
                                            if (data == null) {
                                                $(".payModal-message-area").html(warningMessage("Failed to authorize payment. Please try again."));
                                            } else {
                                                console.log(data.status);
                                                if (data.status == 1) {
                                                    var amount_to_pay = $("input[name=amount_to_pay]").val();

                                                    var expaid = $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                                                    if ($.trim(expaid) == 0) {
                                                        var parseNewPayment = parseFloat(amount_to_pay).toFixed(2);
                                                        $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                                                    } else {
                                                        var newpayment = (expaid - 0) + (amount_to_pay - 0);
                                                        var parseNewPayment = parseFloat(newpayment).toFixed(2);
                                                        $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                                                    }
                                                    genarateSalesTotalCart();

                                                    var AddPOSUrl = makePaymentInitialDefaultAddPOSUrl;
                                                    $.post(AddPOSUrl, { 'paymentID': 3, 'paidAmount': parseNewPayment, '_token': csrftLarVe }, function(response) {

                                                    });

                                                    $(".payModal-message-area").html(successMessage(data.message));

                                                    setTimeout(function() {
                                                        $("#payModal").modal('hide');
                                                    }, 3000);

                                                    $("#cartMessageProShow").show();
                                                    $("#cartMessageProShow").html(successMessage("Payment completed, Please click on print/complete sale."));

                                                } else {
                                                    $(".payModal-message-area").html(warningMessage(data.message));
                                                }
                                            }

                                        }
                                    });

                                    ///Capture Card End

                                }

                            }

                        });

                        // Token End


                    }

                    //console.log("cardPointe Bolt Print Sales ID : "+data);
                }
            });



            //------------------------Ajax Customer End---------------------------//
            return false;

        } else {
            $(".payModal-message-area").html(warningMessage("You don't have any due."));
        }
    });

    //cardPointe start
    $(".cardpointe_card_payment").click(function() {

        $(".cardpointeButton").show();

        $(".cardPointe-cardnumber").val("");
        $(".cardPointe-cardholder").val("");
        $(".cardPointe-month option[value='']").prop("selected", true);
        $(".cardPointe-year option[value='']").prop("selected", true);
        $(".cardPointe-cvc").val("");

        $(".cardPointe-cardholder").focus();

        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            //$("#payModal").modal('hide');
            $(".payModal-message-area").html(warningMessage("Please select a customer."));
            return false;
        }
        var subTotalPrice = 0;
        $.each($("#dataCart").find("tr"), function(index, row) {
            var rowPrice = $(row).find("td:eq(2)").children("span").html();
            subTotalPrice += (rowPrice - 0);
        });

        subTotalPrice = parseFloat(subTotalPrice).toFixed(2);

        if (subTotalPrice < 1) {
            //$("#payModal").modal('hide');
            // alert("Your cart is empty");
            $(".payModal-message-area").html(warningMessage("Your cart is empty"));
            return false;
        }



        var amount_to_pay = $("input[name=amount_to_pay]").val();
        if ($.trim(amount_to_pay) > 0) {
            $("#payModal").modal('hide');
            $("#cardPointeCustomerCard").modal('show');

            $(".cusStripeAm").html("$" + amount_to_pay);

            var parseNewPayment = 0;

            var amount_to_pay = $("input[name=amount_to_pay]").val();
            var expaid = $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
            if ($.trim(expaid) == 0) {
                var parseNewPayment = parseFloat(amount_to_pay).toFixed(2);
            } else {
                var newpayment = (expaid - 0) + (amount_to_pay - 0);
                var parseNewPayment = parseFloat(newpayment).toFixed(2);
            }

            $(".card-pay-due-amount").html(parseNewPayment);


        } else {
            $(".payModal-message-area").html(warningMessage("You don't have any due."));
        }
    });

    $("button.payCardPointe").click(function() {

        //console.log("WOrking");
        $(".cardpointeButton").hide();

        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            $(".cardpointeButton").show();
            //$("#payModal").modal('hide');
            $(".hidestripemsg").html(warningMessage("Please select a customer."));
            return false;
        }

        var parseNewPayment = 0;

        var amount_to_pay = $("input[name=amount_to_pay]").val();
        var expaid = $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
        if ($.trim(expaid) == 0) {
            var parseNewPayment = parseFloat(amount_to_pay).toFixed(2);
        } else {
            var newpayment = (expaid - 0) + (amount_to_pay - 0);
            var parseNewPayment = parseFloat(newpayment).toFixed(2);
        }



        var cardNumber = $.trim($(".cardPointe-cardnumber").val());
        if (cardNumber.length == 0) {
            $(".cardpointeButton").show();
            $(".hidestripemsg").show();
            $(".hidestripemsg").html(warningMessage("Please type card number."));
            return false;
        }

        var cardHName = $.trim($(".cardPointe-cardholder").val());
        if (cardHName.length == 0) {
            $(".cardpointeButton").show();
            $(".hidestripemsg").show();
            $(".hidestripemsg").html(warningMessage("Please type card holder name."));
            return false;
        }

        var cardMonth = $.trim($(".cardPointe-month").val());
        if (cardMonth.length == 0) {
            $(".cardpointeButton").show();
            $(".hidestripemsg").show();
            $(".hidestripemsg").html(warningMessage("Please type card expire month."));
            return false;
        }


        var cardYear = $.trim($(".cardPointe-year").val());
        if (cardYear.length == 0) {
            $(".cardpointeButton").show();
            $(".hidestripemsg").show();
            $(".hidestripemsg").html(warningMessage("Please type card expire Year."));
            return false;
        }


        var cardcvc = $.trim($(".cardPointe-cvc").val());
        if (cardcvc.length == 0) {
            $(".cardpointeButton").show();
            $(".hidestripemsg").show();
            $(".hidestripemsg").html(warningMessage("Please type card cvc/cvc2 pin."));
            return false;
        }

        $(".hidestripemsg").show();
        $(".hidestripemsg").html(loadingOrProcessing("CardPointe payment please wait...."));



        var addCardPointePaymentURL = addCardPointePaymentURLCartPOSvfour;
        $.ajax({
            'async': true,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': addCardPointePaymentURL,
            'data': {
                'cardNumber': cardNumber,
                'cardHName': cardHName,
                'cardMonth': cardMonth,
                'cardYear': cardYear,
                'cardcvc': cardcvc,
                'amountToPay': parseNewPayment,
                '_token': csrftLarVe
            },
            'success': function(data) {
                console.log("cardPointe Print Sales ID : " + data);
                if (data == null) {
                    $(".cardpointeButton").show();
                    $(".hidestripemsg").show();
                    $(".hidestripemsg").html(warningMessage("Failed to authorize payment. Please try again."));
                } else {
                    console.log(data.status);
                    if (data.status == 1) {
                        var amount_to_pay = $("input[name=amount_to_pay]").val();

                        var expaid = $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                        if ($.trim(expaid) == 0) {
                            var parseNewPayment = parseFloat(amount_to_pay).toFixed(2);
                            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                        } else {
                            var newpayment = (expaid - 0) + (amount_to_pay - 0);
                            var parseNewPayment = parseFloat(newpayment).toFixed(2);
                            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                        }
                        genarateSalesTotalCart();
                        //------------------------Ajax POS Start-------------------------//
                        var AddPOSUrl = makePaymentInitialDefaultAddPOSUrl;
                        $.post(AddPOSUrl, { 'paymentID': 25, 'paidAmount': parseNewPayment, '_token': csrftLarVe }, function(response) {
                            // setTimeout(function(){ $("#CustomerCard").modal('show'); }, 3000);
                        });
                        //------------------------Ajax POS End---------------------------//
                        $(".hidestripemsg").show();
                        $(".hidestripemsg").html(successMessage(data.message));

                        setTimeout(function() {
                            $("#cardPointeCustomerCard").modal('hide');
                        }, 3000);

                        $("#cartMessageProShow").show();
                        $("#cartMessageProShow").html(successMessage("Payment completed, Please click on print/complete sale."));

                    } else {
                        $(".hidestripemsg").show();
                        $(".cardpointeButton").show();
                        $(".hidestripemsg").html(warningMessage(data.message));
                    }
                }
                //$(".message-place-authorizenet").html("dddd");
            }
        });
        //------------------------Ajax Customer End---------------------------//
    });
    //cardPointe end

    //stripe start
    $(".stripe_card_payment").click(function() {


        var stripepartialURL = "{{url('stripe')}}";

        $("#payment-form-stripe").attr("action", stripepartialURL);
        $("#partial_invoice_id").val(0);
        $("#partial_today_paid").val(0);


        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            //$("#payModal").modal('hide');
            $(".payModal-message-area").html(warningMessage("Please select a customer."));
            return false;
        }
        var subTotalPrice = 0;
        $.each($("#dataCart").find("tr"), function(index, row) {
            var rowPrice = $(row).find("td:eq(2)").children("span").html();
            subTotalPrice += (rowPrice - 0);
        });

        subTotalPrice = parseFloat(subTotalPrice).toFixed(2);

        if (subTotalPrice < 1) {
            //$("#payModal").modal('hide');
            // alert("Your cart is empty");
            $(".payModal-message-area").html(warningMessage("Your cart is empty"));
            return false;
        }



        var amount_to_pay = $("input[name=amount_to_pay]").val();
        if ($.trim(amount_to_pay) > 0) {
            $("#payModal").modal('hide');
            $("#stripeCustomerCard").modal('show');

            $(".cusStripeAm").html("$" + amount_to_pay);

            var parseNewPayment = 0;

            var amount_to_pay = $("input[name=amount_to_pay]").val();
            var expaid = $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
            if ($.trim(expaid) == 0) {
                var parseNewPayment = parseFloat(amount_to_pay).toFixed(2);
            } else {
                var newpayment = (expaid - 0) + (amount_to_pay - 0);
                var parseNewPayment = parseFloat(newpayment).toFixed(2);
            }

            $(".card-pay-due-amount").html(parseNewPayment);


        } else {
            $(".payModal-message-area").html(warningMessage("You don't have any due."));
        }
    });

    $(".card-pay-stripe").click(function() {

        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            //$("#payModal").modal('hide');
            $(".payModal-message-area").html(warningMessage("Please select a customer."));
            return false;
        }

        var parseNewPayment = 0;

        var amount_to_pay = $("input[name=amount_to_pay]").val();
        var expaid = $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
        if ($.trim(expaid) == 0) {
            var parseNewPayment = parseFloat(amount_to_pay).toFixed(2);
        } else {
            var newpayment = (expaid - 0) + (amount_to_pay - 0);
            var parseNewPayment = parseFloat(newpayment).toFixed(2);
        }


        var cardNumber = $.trim($(".authorize-card-number").val());
        if (cardNumber.length == 0) {
            $(".message-place-authorizenet").html(warningMessage("Please type card number."));
            return false;
        }

        var cardHName = $.trim($(".authorize-card-holder-name").val());
        if (cardHName.length == 0) {
            $(".message-place-authorizenet").html(warningMessage("Please type card holder name."));
            return false;
        }

        var cardExpire = $.trim($(".authorize-card-expiry").val());
        if (cardExpire.length == 0) {
            $(".message-place-authorizenet").html(warningMessage("Please type card expire month/Year."));
            return false;
        }

        var cardcvc = $.trim($(".authorize-card-cvc").val());
        if (cardcvc.length == 0) {
            $(".message-place-authorizenet").html(warningMessage("Please type card cvc/cvc2 pin."));
            return false;
        }

        $(".message-place-authorizenet").html(loadingOrProcessing("Authorizing payment please wait...."));



        var addAuthrizePaymentURL = addAuthrizePaymentURLauthorizenetcapturepospayment;
        $.ajax({
            'async': true,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': addAuthrizePaymentURL,
            'data': {
                'cardNumber': cardNumber,
                'cardHName': cardHName,
                'cardExpire': cardExpire,
                'cardcvc': cardcvc,
                'amountToPay': parseNewPayment,
                '_token': csrftLarVe
            },
            'success': function(data) {
                console.log("Authrizenet Print Sales ID : " + data);
                if (data == null) {
                    $(".message-place-authorizenet").html(warningMessage("Failed to authorize payment. Please try again."));
                } else {
                    console.log(data.status);
                    if (data.status == 1) {
                        var amount_to_pay = $("input[name=amount_to_pay]").val();

                        var expaid = $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
                        if ($.trim(expaid) == 0) {
                            var parseNewPayment = parseFloat(amount_to_pay).toFixed(2);
                            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                        } else {
                            var newpayment = (expaid - 0) + (amount_to_pay - 0);
                            var parseNewPayment = parseFloat(newpayment).toFixed(2);
                            $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
                        }
                        genarateSalesTotalCart();
                        //------------------------Ajax POS Start-------------------------//
                        var AddPOSUrl = makePaymentInitialDefaultAddPOSUrl;
                        $.post(AddPOSUrl, { 'paymentID': 8, 'paidAmount': parseNewPayment, '_token': csrftLarVe }, function(response) {
                            // setTimeout(function(){ $("#CustomerCard").modal('show'); }, 3000);
                        });
                        //------------------------Ajax POS End---------------------------//
                        $(".message-place-authorizenet").html(successMessage(data.message));

                    } else {
                        $(".message-place-authorizenet").html(warningMessage(data.message));
                    }
                }
                //$(".message-place-authorizenet").html("dddd");
            }
        });
        //------------------------Ajax Customer End---------------------------//
    });
    //stripe end

    $(".Paypal_Pay").click(function() {

        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            //$("#payModal").modal('hide');
            $(".payModal-message-area").html(warningMessage("Please select a customer."));
            return false;
        }

        var parseNewPayment = 0;
        var amount_to_pay = $("input[name=amount_to_pay]").val();
        var expaid = $("#posCartSummary tr:eq(4)").find("td:eq(1)").children("span").html();
        if ($.trim(expaid) == 0) {
            var parseNewPayment = parseFloat(amount_to_pay).toFixed(2);
        } else {
            var newpayment = (expaid - 0) + (amount_to_pay - 0);
            var parseNewPayment = parseFloat(newpayment).toFixed(2);
        }

        if ($.trim(parseNewPayment) > 0) {
            /* $("#payModal").modal('hide');
             $("#CustomerCard").modal('show');
             var parseNewPayment=0;         
             var parseNewPayment=parseFloat(amount_to_pay).toFixed(2);
             $(".card-pay-due-amount").html(parseNewPayment);*/
            $(".modal-footer").hide('slow');
            $(".payModal-message-area").html(loadingOrProcessing("Please wait processing your invoice..."));

            window.location.href = paPaymentypaHowMawHkhawl;

        } else {
            $(".payModal-message-area").html(warningMessage("You don't have any due."));
        }
    });

    $(".printncompleteSale").click(function() {
        var printDataType = $.trim($(this).attr("data-id"));
        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            alert("Please select a customer.");
            return false;
        }

        var expaid;
        expaid = $.trim($("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html());
        if (expaid == "0") {
            var paid = 0;
        } else {
            var paid = expaid;
        }

        if (paid < 1) {
            alert("Please add payment.");
            return false;
        }

        console.log("Printing Type - ", printDataType);

        //return false;

        //------------------------Ajax Customer Start-------------------------//
        var AddHowMowKhaoUrl = AddHowMowKhaoUrlCartPOSvfour;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': { 'printData': 1, 'print_type': printDataType, '_token': csrftLarVe },
            'success': function(data) {
                console.log("Completing Print Sales ID : " + data);
                if (data) {
                    var PrintLocation = AddHowMowKhaoUrlCartPOSvfourPrintPDFSalesRec + "/" + printDataType + "/" + data;
                    //window.location.href=PrintLocation;

                    var win = window.open(PrintLocation);
                    if (win) {
                        //Browser has allowed it to be opened
                        win.focus();
                        window.location.href = window.location.href;
                    } else {
                        alert('Please allow popups for this website');
                    }
                } else {
                    window.location.href = window.location.href;
                }
            }
        });
        //------------------------Ajax Customer End---------------------------//
    });

    $("#clearsale").click(function() {
        var c = confirm("Are you sure to clear the POS screen?");
        if (c) {
            var clposLink = clposLinkClearPOSScreen;
            window.location.href = clposLink;
        }
    });




    $("#completesale").click(function() {



        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            alert("Please select a customer.");
            return false;
        }

        var expaid;
        expaid = $.trim($("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html());
        if (expaid == "0") {
            var paid = 0;
        } else {
            var paid = expaid;
        }

        if (paid < 0.001) {
            var c = confirm("Are you sure to create invoice without payment.!!!");
            if (c == false) {
                return false;
            }
        }

        Swal.showLoading();
        //------------------------Ajax Customer Start-------------------------//
        var AddHowMowKhaoUrl = AddHowMowKhaoUrlCartPOSvfour;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddHowMowKhaoUrl,
            'data': { '_token': csrftLarVe },
            'success': function(data) {
                Swal.hideLoading();
                console.log("Completing Sales : " + data);

                if (data == 1) {
                    swalSuccessMsg("Sales Invoice Generated Successfully.");
                    setTimeout(() => {
                        window.location.href = window.location.href;
                    }, 3000);

                } else {
                    swalErrorMsg("Something went wrong, Please try again.");
                    setTimeout(() => {
                        window.location.href = window.location.href;
                    }, 3000);
                }
            }
        });
        //------------------------Ajax Customer End---------------------------//
    });

    $('.addNewCustomerPOS').click(function() {
        $("#NewCustomerDash").modal('show');
        return false;
    });

    $("select[name=customer_id]").change(function() {
        var customerID = $.trim($(this).val());
        console.log(customerID);
        if (customerID.length == 0) {
            alert("Please select a customer.");
            return false;
        } else if (customerID == 0) {
            $("#NewCustomerDash").modal('show');
            return false;
        }


        //------------------------Ajax Customer Start-------------------------//
        var AddCustomerUrl = savenewcustomerAddCustomerPOSUrl + "/" + customerID;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddCustomerUrl,
            'data': { '_token': csrftLarVe },
            'success': function(data) {
                console.log("Assigning custome to cart : " + data)
            }
        });
        //------------------------Ajax Customer End---------------------------//
    });

    $(".save-new-customer").click(function() {

        var name = $.trim($("input[name=new_customer_name]").val());
        var phone = $.trim($("input[name=new_customer_phone]").val());
        var email = $.trim($("input[name=new_customer_email]").val());
        var address = $.trim($("input[name=new_customer_address]").val());
        //console.log(name,phone,email,address);
        if (name.length == 0) {
            alert("Please select a customer Name.");
            return false;
        } else if (phone.length == 0) {
            alert("Please select a customer Phone Number.");
            return false;
        }

        $(".save-new-customer-parent").html(" Processing please wait.....");
        //------------------------Ajax Customer Start-------------------------//
        var AddNewCustomerUrl = savenewcustomerAddNewCustomerUrl;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddNewCustomerUrl,
            'data': { 'name': name, 'phone': phone, 'email': email, 'address': address, '_token': csrftLarVe },
            'success': function(data) {
                $("select[name=customer_id]").append('<option value="' + data + '">' + name + '</option>');
                $("select[name=customer_id] option[value='" + data + "']").prop("selected", true);

                console.log("Saved New Customer : " + data);
                $("#NewCustomerDash").modal('hide');

                //------------------------Ajax Customer Start-------------------------//
                var AddCustomerPOSUrl = savenewcustomerAddCustomerPOSUrl + "/" + data;
                $.ajax({
                    'async': false,
                    'type': "POST",
                    'global': false,
                    'dataType': 'json',
                    'url': AddCustomerPOSUrl,
                    'data': { '_token': csrftLarVe },
                    'success': function(datas) {
                        console.log("Assigning custome to cart : " + datas)
                    }
                });
                //------------------------Ajax Customer End---------------------------//
            }
        });
        //------------------------Ajax Customer End---------------------------//
    });


    $(".make-payment").click(function() {


        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            alert("Please select a customer to make payment.");
            return false;
        }

        var payment_id = $(this).attr("data-id");
        var payment_text = $(this).html();
        var c = confirm("Are you sure to proced with " + $.trim(payment_text) + " ?.");
        if (c) {
            var amount_to_pay = $("input[name=amount_to_pay]").val();
            console.log(amount_to_pay, payment_id, $.trim(payment_text));
            var expaid = $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html();
            if ($.trim(expaid) == 0) {
                var parseNewPayment = parseFloat(amount_to_pay).toFixed(2);
                $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
            } else {
                var newpayment = (expaid - 0) + (amount_to_pay - 0);
                var parseNewPayment = parseFloat(newpayment).toFixed(2);
                $("#posCartSummary tr:eq(4)").find("td:eq(2)").children("span").html(parseNewPayment);
            }
            genarateSalesTotalCart();
            $("#payModal").modal("hide");
            //------------------------Ajax POS Start-------------------------//
            var AddPOSUrl = makePaymentInitialDefaultAddPOSUrl;
            $.post(AddPOSUrl, { 'paymentID': payment_id, 'paidAmount': parseNewPayment, '_token': csrftLarVe }, function(response) {
                console.log(response);
            });
            //------------------------Ajax POS End---------------------------//
        }

    });

    $(".amountextract").click(function() {
        console.log($(this).parent().html());
        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            alert("Please select a customer to make payment.");
            return false;
        }
        genarateSalesTotalCart();
    });

    $("#discount_amount").keyup(function() {
        var amp = $(this).val();
        if ($.isNumeric($.trim(amp))) {
            var newAMP = amp;
        } else {
            var newAMP = 0;
        }

        $(this).val(newAMP);
    });

    $(".apply-discount").click(function() {
        var amp = $("#discount_amount").val();
        if ($.isNumeric($.trim(amp))) {
            var newAMP = amp;
        } else {
            var newAMP = 0;
        }

        var discount_type = 0;
        discount_type = $("select[name=discount_type]").val();



        genarateSalesTotalCart();
        $("#Discount").modal("hide");

        //------------------------Ajax New Product Start-------------------------//
        var AddProductUrl = ApplyDiscountInCartAddProductUrl;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddProductUrl,
            'data': { 'discount_type': discount_type, 'discount_amount': newAMP, '_token': csrftLarVe },
            'success': function(data) {
                console.log("Assigning Discount : " + data);
            }
        });
        //------------------------Ajax New Product End---------------------------//


    });

    $(".edit_pos_item").click(function() {
        console.log("WW");
    });



    $(".GAddProductToCart").click(function() {
        var taxRate = taxRatePOSCartInit;
        var ProductName = $.trim($("input[name=gName]").val());
        var ProductPrice = $.trim($("input[name=gPrice]").val());
        var ProductCPrice = $.trim($("input[name=CPrice]").val());
        var ProductDesc = $.trim($("textarea[name=gDetail]").val());

        if (ProductName.length == 0) {
            alert("Please name should not be empty..");
            return false;
        }

        if (ProductPrice.length == 0) {
            alert("Please price should not be empty..");
            return false;
        }

        if (ProductCPrice.length == 0) {
            alert("Please Cost price should not be empty..");
            return false;
        }

        if (ProductDesc.length == 0) {
            ProductDesc = "General Sales.";
        } else {
            ProductDesc = 'General Sales : ' + ProductDesc;
        }


        console.log(ProductName, ProductPrice, ProductDesc);
        $("#General_Sale").modal("hide");
        //------------------------Ajax New Product Start-------------------------//
        var ProductID;
        var AddProductUrl = GAddProductToCartAddProductUrl;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddProductUrl,
            'data': { 'name': ProductName, 'price': ProductPrice, 'cost_price': ProductCPrice, 'detail': ProductDesc, '_token': csrftLarVe },
            'success': function(data) {
                ProductID = data;
                //console.log("Adding New Product : "+data)
            }
        });
        //------------------------Ajax New Product End---------------------------//
        //console.log(ProductID);

        $(".emptCRTMSG").remove();
        $("#cartMessageProShow").html(loadingOrProcessing("Processing, Please Wait....!!!!"));
        var ProductID = parseInt(ProductID);
        if (ProductID < 1) {
            $("#cartMessageProShow").html(warningMessage("Invalid Product, Please Try Again."));
            return false;
        }

        var rowTypeforMin = $("#dataCart tr[id=" + ProductID + "]").children('td:eq(1)').children('div').children('span:eq(0)').children('i').attr('class');

        var taxRate = taxRatePOSCartInit;

        if ($("#dataCart tr").length > 0) {





            var quantityPlaceFUnc = "javascript:add_pos_cart(" + ProductID + "," + ProductPrice + ",'" + ProductName + "');";
            var quantityPlace = "";
            quantityPlace += '<div class="input-group" style="border-spacing: 0px !important;">';
            quantityPlace += '  <span class="input-group-addon dedmoreqTv4Ex">';
            quantityPlace += '     <i class="icon-remove"></i>';
            quantityPlace += '  </span>';
            quantityPlace += '  <input style="text-align: center;" type="text" class="form-control directquantitypos" value="1">';
            quantityPlace += '  <span onlclick="' + quantityPlaceFUnc + '" class="input-group-addon addmoreqTv4">';
            quantityPlace += '     <i class="icon-plus addmoreqTv4Ex"></i>';
            quantityPlace += '  </span>';
            quantityPlace += '</div>';

            var taxAmount = parseFloat(((ProductPrice * 1) * taxRate) / 100).toFixed(2);
            var strHTML = '<tr id="' + ProductID + '"><td style="line-height: 35px;">' + ProductName + '</td>';
            strHTML += '<td >' + quantityPlace + '</td>';
            strHTML += '<td  class="priceEdit"  style="line-height: 35px;" data-tax="' + taxAmount + '"  data-price="' + ProductPrice + '">$<span>' + ProductPrice + '</span></td>';
            strHTML += '<td  class="priceEdit"  style="line-height: 35px;">$<span>' + parseFloat(ProductPrice).toFixed(2) + '</span></td>';
            strHTML += '</tr>';

            $("#dataCart").append(strHTML);

        } else {
            var quantityPlaceFUnc = "javascript:add_pos_cart(" + ProductID + "," + ProductPrice + ",'" + ProductName + "');";
            var quantityPlace = '';
            quantityPlace += '<div class="input-group" style="border-spacing: 0px !important;">';
            quantityPlace += '  <span class="input-group-addon dedmoreqTv4Ex">';
            quantityPlace += '     <i class="icon-remove"></i>';
            quantityPlace += '  </span>';
            quantityPlace += '  <input style="text-align: center; " type="text" class="form-control directquantitypos" value="1">';
            quantityPlace += '  <span onlclick="' + quantityPlaceFUnc + '"  class="input-group-addon addmoreqTv4">';
            quantityPlace += '     <i class="icon-plus addmoreqTv4Ex"></i>';
            quantityPlace += '  </span>';
            quantityPlace += '</div>';

            var taxAmount = parseFloat(((ProductPrice * 1) * taxRate) / 100).toFixed(2);
            var strHTML = '<tr id="' + ProductID + '"><td style="line-height: 35px;">' + ProductName + '</td>';
            strHTML += '<td style="line-height: 35px;">' + quantityPlace + '</td>';
            strHTML += '<td  class="priceEdit"  style="line-height: 35px;" data-tax="' + taxAmount + '"  data-price="' + ProductPrice + '">$<span>' + ProductPrice + '</span></td>';
            strHTML += '<td  class="priceEdit"  style="line-height: 35px;">$<span>' + parseFloat(ProductPrice).toFixed(2) + '</span></td>';
            strHTML += '</tr>';

            $("#dataCart").append(strHTML);
        }

        genarateSalesTotalCart();
        $("#cartMessageProShow").html(loadingOrProcessing("Adding To Cart, Please Wait...!!!!"));

        var AddPOSUrl = GAddProductToCartAddPOSUrl + "/" + ProductID;

        var postDatas = { 'product_id': ProductID, 'price': ProductPrice, '_token': csrftLarVe };


        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddPOSUrl,
            'data': postDatas,
            'success': function(data) {
                $("#cartMessageProShow").html(successMessage("Product Added To Cart Successfully."));
            }
        });

    });

    $(".add-pos-cart").click(function() {
        //alert('sss');
        var ProductID = $(this).attr('data-id');
        var ProductPrice = $(this).attr('data-price');
        var ProductName = $(this).html();

        var taxRate = taxRatePOSCartInit;



        if ($("#dataCart tr").length > 0) {

            if ($("#dataCart tr[id=" + ProductID + "]").length) {
                //console.log($("#dataCart tr[id="+ProductID+"]").html());
                var ExQuantity = $("#dataCart tr[id=" + ProductID + "]").find("td:eq(1)").html();
                var NewQuantity = (ExQuantity - 0) + (1 - 0);
                var NewPrice = (ProductPrice * NewQuantity).toFixed(2);
                var taxAmount = parseFloat((NewPrice * taxRate) / 100).toFixed(2);
                $("#dataCart tr[id=" + ProductID + "]").find("td:eq(1)").html(NewQuantity);
                $("#dataCart tr[id=" + ProductID + "]").find("td:eq(3)").children("span").html(NewPrice);
                $("#dataCart tr[id=" + ProductID + "]").find("td:eq(2)").attr("data-tax", taxAmount);

                console.log(NewQuantity);
                console.log(NewPrice);

            } else {
                var taxAmount = parseFloat(((ProductPrice * 1) * taxRate) / 100).toFixed(2);
                var strHTML = '<tr id="' + ProductID + '"><td>' + ProductName + '</td><td>1</td><td data-tax="' + taxAmount + '"  data-price="' + ProductPrice + '">$<span>' + ProductPrice + '</span></td><td>$<span>' + ProductPrice + '</span></td><td style="width: 81px;"><a href="javascript:edit_pos_item(' + ProductID + ');" title="Edit" class="btn btn-sm btn-outline-green" style="margin-right:2px;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow(' + ProductID + ');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

                $("#dataCart").append(strHTML);
            }
        } else {
            var taxAmount = parseFloat(((ProductPrice * 1) * taxRate) / 100).toFixed(2);
            var strHTML = '<tr id="' + ProductID + '"><td>' + ProductName + '</td><td>1</td><td data-tax="' + taxAmount + '"  data-price="' + ProductPrice + '">$<span>' + ProductPrice + '</span></td><td style="width: 81px;"><a href="javascript:edit_pos_item(' + ProductID + ');" title="Edit" class="btn btn-sm btn-outline-green" style="margin-right:2px;"><i class="icon-pencil22"></i></a><a href="javascript:delposSinleRow(' + ProductID + ');" title="Delete" class="btn btn-sm btn-outline-danger"><i class="icon-cross"></i></a></td></tr>';

            $("#dataCart").append(strHTML);
        }

        genarateSalesTotalCart();

        //------------------------Ajax POS Start-------------------------//
        var AddPOSUrl = GAddProductToCartAddPOSUrl + "/" + ProductID;
        $.ajax({
            'async': false,
            'type': "POST",
            'global': false,
            'dataType': 'json',
            'url': AddPOSUrl,
            'data': { 'product_id': ProductID, 'price': ProductPrice, '_token': csrftLarVe },
            'success': function(data) {
                //tmp = data;
                console.log("Processing : " + data)
            }
        });
        //------------------------Ajax POS End---------------------------//

    });

    $("input[name=amount_to_pay]").keyup(function() {
        var customerID = $.trim($("select[name=customer_id]").val());
        if (customerID.length == 0) {
            alert("Please select a customer to make payment.");
            return false;
        }
        console.log($(this).val());
        var dues = $("#totalCartDueToPay").html();
        var amp = $(this).val();
        if ($.isNumeric($.trim(amp))) {
            var newAMP = amp;
        } else {
            var newAMP = 0;
        }

        $(this).val(newAMP);

        var mkdues = $.trim(dues) - $.trim(newAMP);
        var newdues = parseFloat(mkdues).toFixed(2);

        $("#prmDue").html(newdues);

    });

});