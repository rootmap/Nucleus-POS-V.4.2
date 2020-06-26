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