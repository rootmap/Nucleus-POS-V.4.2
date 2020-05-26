
<div class="modal fade text-xs-left" id="barcodeCreate" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      <h3 class="modal-title" id="myModalLabel35"><i class="icon-barcode"></i> Print Your Barcode</h3>
                  </div>
                    <form class="form" method="post" action="{{url('genarate/barcode')}}">
                    {{csrf_field()}}
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="eventRegInput1">Barcode No <span class="text-danger">*</span></label>
                            <input type="text" readonly="readonly" id="eventRegInput1" class="form-control border-primary"  autocomplete="off"  placeholder="Barcode No" name="barcode">
                        </div>
                        <div class="form-group">
                            <label for="eventRegInput1">Quantity <span class="text-danger">*</span></label>
                            <input type="text" id="eventRegInput1" class="form-control border-primary"  autocomplete="off"  placeholder="Quantity" name="quantity">
                        </div>                          
                        
                        <div class="form-actions center save-new-customer-parent">
                            <button type="submit" class="btn btn-green save-new-customer">
                                <i class="icon-barcode"></i> Genarate Barcode
                            </button>
                        </div>
                    </form>
            </div>
        </div>
        </div>