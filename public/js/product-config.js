var productConfig = (function () {
    var productConfig = null;
        $.ajax({
            'async': false,
            'global': false,
            'url': product_pos_settings_product_url,
            'dataType': "json",
            'success': function (data) {
                productConfig = data;
            }
        });
        return productConfig;
})(); 

//console.log('Total Json',productConfig);

var productJson=productConfig.product;
var modelJson=productConfig.model;
var problemJson=productConfig.problem;
var estPriceJson=productConfig.estPrice;
var cusObjData=productConfig.customer;
$(document).ready(function(){
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

    var optHtml='<option value="">Select Repair Parts</option>';
    $.each(productPartsConfig,function(key,row){
        optHtml+='<option value="'+row.id+'">'+row.barcode+' - '+row.name+'</option>';
    });
    
    $("#parts_id").html(optHtml);
    $("#parts_id").select2();
    console.log('productPartsConfig=',productPartsConfig);
});
