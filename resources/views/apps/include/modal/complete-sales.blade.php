     <!-- Modal for Make Payment start-->
    <div class="modal fade text-xs-left rollIn" id="completeSalesModal" tabindex="-5" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                      </button>
                      <h3 class="modal-title" align="center" id="myModalLabel35"> Execute Sales & Start New Sales <i class="fa fa-arrow-down"></i></h3>
                  </div>
                  <form>
                <div class="modal-footer">
                    
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 button button1 authorizenet btn-group">
                        <button type="button" class="btn btn-block btn1 completesaleoverlay btn-green btn-darken-4 btn-responsive btn1 spfontcartfotter" style="font-size: 15px !important; font-weight: 600;">     
                            <i class="icon-circle-check"></i>  Complete Sale
                        </button>
                    </div>
                    
                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 button button1 comprint btn-group open">
                        <button  type="button"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="true" class="btn btn-green btn-darken-3 btn-responsive btn1  dropdown-toggle spfontcartfotter" style="font-size: 15px !important; font-weight: 600;"><i class="icon-printer4"></i> Complete Sales &amp; Print Invoice &nbsp;</button>      
                        <div class="dropdown-menu">
                            <a class="dropdown-item printncompleteSale" data-id="pos" href="javascript:void(0);"><i class="icon-printer4"></i> Default Print</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item printncompleteSale"  data-id="thermal"  href="javascript:void(0);"><i class="icon-ios-printer-outline"></i> Thermal Print</a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item printncompleteSale"  data-id="barcode" href="javascript:void(0);"><i class="icon-barcode2"></i> Barcode Print</a>
                        </div>
                    </div>
                  
                </div>
            </form>
        </div>
    </div>
</div>
<!--Pay Modal End-->
