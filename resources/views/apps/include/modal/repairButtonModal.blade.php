<div class="modal fade text-xs-left" id="ChooseRepairButton" tabindex="-3" role="dialog" aria-labelledby="myModalLabel35" aria-hidden="true">
    <div class="modal-dialog modal-xs" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                <p class="modal-title" id="myModalLabel35"><b><i class="icon-ellipsis"></i> Choose Repair Service</b></p>
            </div>
                <style type="text/css">
                .blackout:hover{
                    opacity: 0.6;
                    cursor: pointer;
                }
                </style>
                <div class="modal-body">
                        @if(in_array('Inventory Repair',$repandticket))
                        <div class="col-md-12">
                            <div class="card mb-1">
                                <div class="card-body blackout collapse in" data-toggle="modal" data-target="#instoreRepairModal" >
                                    <div class="bg-green bg-lighten-2 height-10"></div>
                                    <div class="p-1">
                                        <p class="text-xs-left mb-0">
                                            <a href="javascript:void(0);" style="text-decoration: none;">
                                                <i class="icon-database"></i> Inventory Repair
                                            </a>
                                        </p>         
                                    </div>
                                </div>    
                            </div>
                        </div>
                        @endif

                        @if(in_array('Non-Inventory Repair',$repandticket))
                            <div class="col-md-12">
                                <div class="card mb-1">
                                    <div class="card-body blackout collapse in" data-toggle="modal" data-target="#instoreTicketModal" >
                                        <div class="bg-green bg-lighten-2 height-10"></div>
                                        <div class="p-1">
                                            <p class="text-xs-left mb-0">
                                                <a href="javascript:void(0);" style="text-decoration: none;">
                                                    <i class="icon-data"></i> Non-Inventory Repair
                                                </a>
                                            </p>         
                                        </div>
                                    </div>    
                                </div>
                            </div>
                        @endif

                        <div class="clearfix"></div>
                </div>
        </div>
    </div>
</div>