<div class="modal fade text-xs-left" id="buyback" tabindex="-2" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h3 class="modal-title" id="myModalLabel35"> <i class="icon-random"></i> Create Buyback</h3>
      </div>
          <div class="modal-body">

              <div class="col-md-12" id="buybackMSG"></div>

              <div class="row"> 
                

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Customer </label>
                        <select style="width: 100%;" class="select2 form-control" name="buyback_customer_id">                    
                      </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">Model</label>
                        <input type="text"  class="form-control" placeholder="Model" name="buyback_model">
                      </div>
                    </div>
                    
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Carrier</label>
                        <input type="text"  class="form-control" placeholder="Carrier" name="buyback_carrier">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">IMEI</label>
                        <input type="text"  class="form-control" placeholder="IMEI" name="buyback_imei">
                      </div>
                    </div>
                    
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Type and Color</label>
                        <input type="text"  class="form-control" placeholder="Type and Color" name="buyback_type_and_color">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">Memory</label>
                        <input type="text"  class="form-control" placeholder="Memory" name="buyback_memory">
                      </div>
                    </div>
                    
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Keep This ON </label>
                        <select style="width: 100%;" class="select2 form-control" name="buyback_keep_this_on">
                          <option  value="">Keep this on</option>
                          <option  value="Parts">Parts</option>
                          <option  value="Sale">Sale</option>                      
                      </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">Condition</label>
                        <input type="text"  class="form-control" placeholder="Condition" name="buyback_condition">
                      </div>
                    </div>
                    
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Price  </label>
                        <input type="text"  class="form-control" placeholder="Price" name="buyback_price">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Payment Method </label>
                        <select style="width: 100%;" class="select2 form-control" name="buyback_payment_method">
                           <option  value="">Payment Method</option>
                           @if(isset($authorizeNettender))
                            <option  value="{{$authorizeNettender[0]->id}}">{{$authorizeNettender[0]->name}}</option>
                          @endif
                          @if(isset($payPaltender))
                            <option  value="{{$payPaltender[0]->id}}">{{$payPaltender[0]->name}}</option>
                          @endif
                          @if(isset($tender))
                            @foreach($tender as $ten)
                                <option  value="{{$ten->id}}">{{$ten->name}}</option>
                            @endforeach
                          @endif                      
                      </select>
                      </div>
                    </div>
                  </div>
                </div>

                


         

              </div>
              

              <div class="form-group row">
                <label class="col-md-4 label-control" for="Description">&nbsp;</label>
                <div class="col-md-8">
                  <button type="button" class="btn btn-green saveBuybackSave">
                      <i class="icon-check2"></i> Save Buyback
                  </button>
                </div>
              </div>
          </div>
    </div>
  </div>
</div>