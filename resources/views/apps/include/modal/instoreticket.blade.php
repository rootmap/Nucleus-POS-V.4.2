<div class="modal fade text-xs-left" id="instoreTicketModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel36" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel35"> <i class="icon-data"></i> Non-Inventory Repair <span style="display: none;" id="label_ticket_id">{{$ticket_id}}</span> </h4>
      </div>
          <div class="modal-body">

              <div class="col-md-12" id="InstoreTicketMSG"></div>

              <form action="{{url('add-to-repair/cart')}}" id="TicketForm" method="post">
                <input type="hidden" name="ticket_id" value="0">
                <div class="col-md-12 ticketstep1">
                  <div class="row">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Device Type / Subject <span style="color: #f00;">*</span></label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="Device Type" name="ticket_device_type">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">Problem type <span style="color: #f00;">*</span></label>
                        <select  name="ticket_problem_id" id="ticket_problem_id" class="select2 form-control" style="width: 100%;"> 
                          <option value="">Please Select</option>
                          <option value="TP0001">Create New Problem</option>
                          @if(isset($ticketProblem))
                            @foreach($ticketProblem as $pro)
                            <option  value="{{$pro->id}}">
                              {{$pro->name}}
                            </option>
                            @endforeach
                          @endif
                        </select>
                        <input type="text" id="projectinput2" style="display: none;" class="form-control" placeholder="Type Problem Name" name="ticket_problem_name">
                      </div>
                    </div>

                  </div>
                </div>

                <div class="col-md-12 ticketstep1">
                  <div class="row">
                    
                    

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="projectinput2">Our Cost <span style="color: #f00;">*</span></label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="Our Cost" name="ticket_our_cost">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="projectinput2">Retail Price for customer <span style="color: #f00;">*</span></label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="Retail Price" name="ticket_retail_price">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                          <label for="projectinput2">Password </label>
                          <input type="text" id="projectinput2" class="form-control" placeholder="Password" name="ticket_password">
                        </div>
                      </div>

                  </div>
                </div>

                <div class="col-md-12 ticketstep1">
                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Type and Color</label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="Type and Color" name="ticket_type_n_color">
                      </div>
                    </div>
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Carrier</label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="Carrier" name="ticket_carrier">
                      </div>
                    </div>
                    

                  </div>
                </div>

                <div class="col-md-12 ticketstep1">
                  <div class="row">
                    

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">IMEI</label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="IMEI" name="ticket_imei">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">How did you hear about us ?</label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="How did you hear about us" name="ticket_how_did_you_hear_about_us">
                      </div>
                    </div>

                  </div>
                </div>

            

                



              
              
              <div class="col-md-12 ticketstep2" style="display: none;">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Items Dropped Off ?</label><br>
                        <label class="radio-inline"><input type="radio" name="isdropoff" checked="checked" value="Yes" class="style" id="isdropoff_0"><strong> Yes</strong></label>
                        <label class="radio-inline"><input type="radio" name="isdropoff" value="No" class="style" id="isdropoff_1"><strong> No</strong></label>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Tested Before By :</label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="Tested Before By" name="ticket_tested_before_by">
                      </div>
                    </div>

                  </div>
              </div>

              <div class="col-md-12 ticketstep2" style="display: none;">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Tested After By</label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="Tested After By" name="ticket_tested_after_by">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Tech Notes :</label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="Tech Notes" name="ticket_tech_notes">
                      </div>
                    </div>
                  </div>
              </div>

              <div class="col-md-12 ticketstep2" style="display: none;">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="projectinput2">Additional Info</label>
                        <div class="form-control" style="clear: both; display: block; height: 150px; overflow-x: auto;">
                            @if(isset($ticketAsset))
                              @foreach($ticketAsset as $rep)
                                <div class="col-md-12">
                                  <input type="checkbox" id="projectinput2" name="ticket_{{strtolower(preg_replace('/[^a-zA-Z0-9]/', "",$rep->name))}}"> {{$rep->name}}
                                  <div class="clearfix"></div>
                                </div>
                              @endforeach
                            @endif
                        </div>
                      </div>
                    </div>
                  </div>
              </div>

              
              
              
              <div class="clearfix"></div>
              <div class="form-group row" style="margin-top: 10px;">
                <div class="clearfix"></div>
                <hr>
                <div class="col-md-10">
                  <button type="button" class="btn btn-green" id="ticketstep1">
                      <i class="icon-step-forward"></i> Next
                  </button>
                  
                  <button type="button" class="btn btn-green" id="ticketstep2_to_ticketstep1" style="display: none;">
                      <i class="icon-step-backward"></i> Back
                  </button>

                  <button type="button" class="btn btn-green" id="ticketstep2" style="display: none;">
                      <i class="icon-step-forward"></i> Finish To Cart
                  </button>

                  <button type="button" class="btn btn-green" id="ticketstep2_list" style="display: none;">
                      <i class="icon-step-forward"></i> Finish To Non-Inventory Repair
                  </button>

                  <button type="reset" class="btn btn-green" id="reset_ticket" style="display: none; ">
                      <i class="icon-step-forward"></i> Reset
                  </button>
                </div>
              </div>

              </form>


    </div>
  </div>
</div>
</div>