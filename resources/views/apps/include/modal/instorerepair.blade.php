<div class="modal fade text-xs-left" id="instoreRepairModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
          <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
              <p class="modal-title" id="myModalLabel35"><b><i class="icon-database"></i> Inventory Repair</b></p>
          </div>
          <div class="modal-body">
              <div class="col-md-12" id="InstoreMSG"></div>

              <form action="{{url('add-to-repair/cart')}}" id="repairForm" method="post">
              <div class="col-md-12 step1">
                <div class="form-group row">
                    <label for="userinput1" class="col-md-2 label-control" style="text-align: right; padding-top: 10px;">Device <span class="text-danger">*</span></label>
                    <div class="col-md-8">
                        <select  name="device_id" id="device_id" class="select2 form-control" style="width: 100%;"> 
                          <option value="">Please Select</option>
                          @if(isset($device))
                            @foreach($device as $pro)
                            <option  value="{{$pro->id}}">
                              {{$pro->name}}
                            </option>
                            @endforeach
                          @endif
                      </select>
                    </div>
                    
                </div>
              </div>
              <div class="col-md-12 step1">
                  <div class="form-group row">
                      <label for="userinput1" class="col-md-2 label-control" style="text-align: right; padding-top: 10px;">
                        Model <span class="text-danger">*</span>
                      </label>
                      <div class="col-md-8">
                        <select  name="model_id" class="select2 form-control" style="width: 100%;"> 
                          <option value="">Please Select</option>
                          @if(isset($productData))
                            @foreach($productData as $pro)
                            <option  value="{{$pro->id}}">
                              {{$pro->name}}
                            </option>
                            @endforeach
                          @endif
                        </select>
                        
                      </div>
                </div>
              </div>
              
              <div class="col-md-12 step1">
                  <div class="form-group row">
                      <label for="userinput1" class="col-md-2 label-control" style="text-align: right; padding-top: 10px;">Problem <span class="text-danger">*</span></label>
                      <div class="col-md-8">
                            <select name="problem_id" class="select2 form-control" style="width: 100%;"> 
                                <option value="">Please Select</option>
                                @if(isset($productData))
                                  @foreach($productData as $pro)
                                  <option  value="{{$pro->id}}">
                                    {{$pro->name}}
                                  </option>
                                  @endforeach
                                @endif
                          </select>
                      </div>
                      
                </div>
              </div>
              <div class="col-md-12 step2" style="display: none;">
                  <div class="form-group row">
                      <label for="userinput1" class="col-md-12 label-control" style="text-align: center; padding-top: 10px;">
                          <h4 class="subtitle align-left" style="padding-left:10px;">
                            <i class="icon-eye-open"></i> Repair Price : $<span id="repair_price">0.00</span> </h4>
                      </label>                      
                </div>
              </div>
              <div class="col-md-12 step2" style="display: none;">
                  <div class="form-group row">
                      <label for="userinput1" class="col-md-4 label-control" style="text-align: right; padding-top: 10px;">Override Price 
                        <span class="text-danger">*</span>
                      </label>
                      <div class="col-md-6">
                            <input type="text" class="form-control" name="override_repair_price" value="0">
                            <input type="hidden" class="form-control" name="repair_price" value="0">
                      </div>
                      
                </div>
              </div>

              <div class="row step3" style="display: none;"> 
                

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">Password</label>
                        <input type="text" id="projectinput1" class="form-control" placeholder="Password" name="repair_password">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">IMEI</label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="IMEI Number" name="repair_imei">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">Tested Before By</label>
                        <input type="text" id="projectinput1" class="form-control" placeholder="Tested Before By Name" name="repair_tested_before_by">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">Tested After By </label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="Tested After By Name" name="repair_tested_after_by">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">Tech Notes</label>
                        <input type="text" id="projectinput1" class="form-control" placeholder="Tech Notes" name="repair_tech_notes">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">How did you hear about us ? </label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="How did you hear about us" name="repair_how_did_you_hear_about_us">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1">Start Time</label>
                        <input type="text" id="projectinput1" class="form-control" placeholder="Start Time" name="repair_start_time">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput2">End Time </label>
                        <input type="text" id="projectinput2" class="form-control" placeholder="End Time" name="repair_end_time">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="col-md-12">
                  <div class="row">
                    
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="projectinput1"><input type="checkbox" id="projectinput1" name="repair_salvage_part"  /> Salvage Part </label>
                      </div>
                    </div>
                  </div>
                </div>


                <div class="col-md-12">
                  <div class="row">
                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="projectinput2">Additional Info</label>
                        <div class="form-control" style="clear: both; display: block; height: 150px; overflow-x: auto;">
                            @if(isset($repairAsset))
                              @foreach($repairAsset as $rep)
                                <div class="col-md-12">
                                  <input type="checkbox" id="projectinput2" class="repair_checkbox" name="repair_{{strtolower(preg_replace('/[^a-zA-Z0-9]/', "",$rep->name))}}" /> {{$rep->name}} 
                                  <div class="clearfix"></div>
                                </div>
                              @endforeach
                            @endif
                        </div>
                      </div>
                    </div>
                  </div>
              </div>


         

              </div>
              
              
              <div class="clearfix"></div>
              <div class="form-group row">
                <div class="clearfix"></div>
                <hr>
                <label class="col-md-1 label-control" for="Description">&nbsp;</label>
                <div class="col-md-9">
                  <button type="button" class="btn btn-green" id="step1">
                      <i class="icon-step-forward"></i> Next
                  </button>
                  <button type="button" class="btn btn-green" id="step2" style="display: none; margin-right: 10px;">
                      <i class="icon-step-forward"></i> Next as Recomended
                  </button>
                  <button type="button" class="btn btn-green" id="step2_override" style="display: none;">
                      <i class="icon-step-forward"></i> Override Price
                  </button>
                  <button type="button" class="btn btn-green btn-darken-1" id="step3" style="display: none; ">
                      <i class="icon-cart"></i> Complete to Cart
                  </button>
                  <button type="button" class="btn btn-green btn-darken-3" id="step3_list" style="display: none; ">
                      <i class="icon-database"></i> Complete to Inventory Repair
                  </button>
                  <button type="reset" class="btn btn-green" id="reset_repair" style="display: none; ">
                      <i class="icon-step-forward"></i>Reset
                  </button>
                </div>
              </div>

              </form>


    </div>
  </div>
</div>
</div>