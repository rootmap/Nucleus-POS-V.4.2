<div class="modal fade text-xs-left" id="TaxManagement" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            <h3 class="modal-title" id="myModalLabel35"> Tax Management</h3>
      </div>
      <form>
        <div class="modal-body">
            <div class="form-group row">
                <label class="col-md-4 label-control" for="projectinput1">Tax Management</label>
                <div class="col-md-8">
                    <label class="col-md-4" style="text-align: center;">
                      <input 
                        @if(isset($ps))
                          @if($ps->pos_defualt_option=="Full Tax")
                            checked="checked"  
                          @endif
                        @endif  
                      value="Full Tax" type="radio" id="tax_0" class="form-control" name="tax_st"> Full Tax</label>
                    <label class="col-md-4" style="text-align: center;">
                      <input 
                        @if(isset($ps))
                          @if($ps->pos_defualt_option=="Part Tax")
                            checked="checked"  
                          @endif
                        @endif  
                      value="Part Tax" type="radio" id="tax_1" class="form-control" name="tax_st"> Part Tax</label>
                    <label class="col-md-4" style="text-align: center;">
                      <input 
                       @if(isset($ps))
                          @if($ps->pos_defualt_option=="No Tax")
                            checked="checked"  
                          @endif
                        @endif  
                      value="No Tax" type="radio" id="tax_2" class="form-control" name="tax_st"> No Tax</label>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 label-control" for="projectinput1">&nbsp;</label>
                <div class="col-md-8">
                    <button type="button" class="btn btn-green apply-tax">
                        <i class="icon-check2"></i> Apply Tax
                    </button>
                </div>
            </div>
        </div>
      </form>
    </div>
  </div>
</div>