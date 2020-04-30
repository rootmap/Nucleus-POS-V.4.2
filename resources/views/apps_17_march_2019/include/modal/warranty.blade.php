<div class="modal fade text-xs-left" id="warranty" tabindex="-2" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h3 class="modal-title" id="myModalLabel35"><i class="icon-ribbon-b"></i> Create Warranty</h3>
      </div>
          <div class="modal-body">

              <div class="col-md-12" id="warrantyMSG"></div>


              <div class="form-group row">
                  <label class="col-md-4 label-control" for="projectinput1">
                      Invoice ID
                  </label>
                  <div class="col-md-8">
                      <select style="width: 100%;" class="select2 form-control" name="warranty_sales_invoice_id">
                          <option  selected="selected"  value="">Select a Invoice</option>                      
                      </select>
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-md-4 label-control" for="projectinput1">
                      Invoice Total Amount
                  </label>
                  <div class="col-md-8">
                      <input type="text" readonly="readonly" class="form-control" placeholder="Sales Amount" name="warranty_sales_amount">
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-md-4 label-control" for="projectinput1">
                      old product
                  </label>
                  <div class="col-md-8">
                      <select style="width: 100%;" class="select2 form-control" name="warranty_ex_product_id">
                          <option  selected="selected"  value="">Select a Product</option>                      
                      </select>
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-md-4 label-control" for="projectinput1">
                      New product
                  </label>
                  <div class="col-md-8">
                      <select style="width: 100%;" class="select2 form-control" name="warranty_new_product_id">
                          <option  selected="selected"  value="">Select a Product</option>                      
                      </select>
                  </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 label-control" for="Description">&nbsp;</label>
                <div class="col-md-8">
                  <button type="button" class="btn btn-green saveWarrantySave">
                      <i class="icon-check2"></i> Save Warranty
                  </button>
                </div>
              </div>
          </div>
    </div>
  </div>
</div>