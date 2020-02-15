<div class="modal fade text-xs-left" id="salesReturn" tabindex="-2" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h3 class="modal-title" id="myModalLabel35"> Sales Return Form</h3>
      </div>
          <div class="modal-body">

              <div class="col-md-12" id="salesReturnMSG"></div>
              
              <div class="form-group row">
                  <label class="col-md-4 label-control" for="projectinput1">
                      Customer Name
                  </label>
                  <div class="col-md-8">
                      <select style="width: 100%;" class="select2 form-control" name="sales_return_customer_id">
                                 
                      </select>
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-md-4 label-control" for="projectinput1">
                      Sales Invoice ID
                  </label>
                  <div class="col-md-8">
                      <select style="width: 100%;" class="select2 form-control" name="sales_return_sales_invoice_id">
                          <option  selected="selected"  value="">Select a Invoice</option>                      
                      </select>
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-md-4 label-control" for="projectinput1">
                      Sales Amount
                  </label>
                  <div class="col-md-8">
                      <input type="text" readonly="readonly" class="form-control" placeholder="Sales Amount" name="sales_return_sales_amount">
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-md-4 label-control" for="projectinput1">
                      Return Amount
                  </label>
                  <div class="col-md-8">
                      <input type="text"  class="form-control" placeholder="Return Amount" name="sales_return_return_amount">
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-md-4 label-control" for="projectinput1">
                      Sales Return Note
                  </label>
                  <div class="col-md-8">
                      <input type="text"  class="form-control" placeholder="Sales Return Note" name="sales_return_note">
                  </div>
              </div>

              <div class="form-group row">
                <label class="col-md-4 label-control" for="Description">&nbsp;</label>
                <div class="col-md-8">
                  <button type="button" class="btn btn-green saveSalesReturnSave">
                      <i class="icon-check2"></i> Save Sales Return
                  </button>
                </div>
              </div>
          </div>
    </div>
  </div>
</div>