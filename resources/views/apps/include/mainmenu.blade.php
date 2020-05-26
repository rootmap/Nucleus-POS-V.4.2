<?php 
    $dataMenuAssigned=array();
    $dataMenuAssigned=StaticDataController::dataMenuAssigned();
    //dd($dataMenuAssigned);
    if(empty($dataMenuAssigned))
    {
        ?>
        <script type="text/javascript">
            logoutFRM();
        </script>
        <?php
    }


    $datauserGuideSet=StaticDataController::userGuideSet();
    $userGuidefile="adminUserGuide.pdf";
    if(!empty($datauserGuideSet))
    {
        if($datauserGuideSet==4)
        {
            $userGuidefile="cashierUserGuide.pdf";
        }
    }

    $userGuideLink=url($userGuidefile);

    //echo $userGuideLink; die();

    //print_r($dataMenuAssigned); die();
?>

<aside id="sidebar-left" class="sidebar-circle">
        <style type="text/css">
            .avatarside img {
                width: 100%;
                max-width: 100%;
                height: auto;
                border: 0;
                border-radius: 1000px;
            }

            .sidebar-content img {
                width: 49px !important;
                height: 49px !important;
                margin-right: 3px;
                padding: 5px;
            }
        </style>
        <!-- Start left navigation - profile shortcut -->
        <div id="tour-8" class="sidebar-content" style="padding-top: 20px;">
            <div class="media">
                <a class="pull-left avatarside" href="{{url('pos')}}">
                    <img src="{{asset('images/logo/header-logo.png')}}" alt="admin">
                </a>
                <div class="media-body">
                    <h4 class="media-heading"> Nucleus-V4</h4>
                    <small>Total POS &amp; Sales Solutions</small>
                </div>
            </div>
        </div><!-- /.sidebar-content -->
        <!--/ End left navigation -  profile shortcut -->

        <!-- Start left navigation - menu -->
        <ul id="tour-9" class="sidebar-menu">
            <li class="sidebar-category">
                <span>System Quick Links</span>
                <span class="pull-right"><i class="fa fa-link"></i></span>
            </li>
            <!-- Start navigation - dashboard -->
            @if(in_array('dashboard', $dataMenuAssigned))
            <li class="">
                <a href="{{url('dashboard')}}">
                    <span class="icon"><i class="fa fa-dashboard"></i></span>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            @endif
            @if(in_array('pos', $dataMenuAssigned))
            <!--/ End navigation - dashboard -->
            <li class="{{ Request::path() == 'pos' ? 'active' : '' }}">
                <a href="{{url('pos')}}">
                    <span class="icon"><i class="fa fa-shopping-basket"></i></span>
                    <span class="text">Cash Register</span>
                </a>
            </li>
            @endif
            @if(in_array('customermain', $dataMenuAssigned))
            <!-- Start navigation - frontend themes -->
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-user"></i></span>
                    <span class="text">Customer</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    @if(in_array('customer', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'customer' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('customer')}}" class="menu-item">Add New Customer</a></li>
                    @endif
                    @if(in_array('customer/list', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'customer/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('customer/list')}}" class="menu-item">Customer List</a></li>
                    @endif
                    
                    @if(in_array('customer/lead/new', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'customer/lead/new' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('customer/lead/new')}}" class="menu-item">Add New Lead</a></li>
                    @endif
                    @if(in_array('customer/lead/list', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'customer/lead/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('customer/lead/list')}}" class="menu-item">Lead List</a></li>
                    @endif 

                    @if(in_array('customer/import', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'customer/import' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('customer/import')}}" class="menu-item">Import Customer</a></li>
                    @endif 
                </ul>
            </li>
            @endif

            @if(in_array('special/feature', $dataMenuAssigned))
            <!--/ End navigation - dashboard -->
            <li class="{{ Request::path() == 'special/feature' ? 'active' : '' }}">
                <a href="{{url('special/feature')}}">
                    <span class="icon"><i class="fa fa-shopping-basket"></i></span>
                    <span class="text">Special Feature</span>
                </a>
            </li>
            @endif
            
            {{-- @if(in_array('customermain', $dataMenuAssigned))
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-shopping-bag"></i></span>
                    <span class="text">Special Order Parts</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    <li class="{{ Request::path() == 'special/parts/create' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('special/parts/create')}}" class="menu-item">Add New Special Order</a></li>
                    <li class="{{ Request::path() == 'special/parts/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('special/parts/list')}}" class="menu-item">Special Order List</a></li>
                </ul>
            </li>
            @endif --}}

            {{-- @if(in_array('customermain', $dataMenuAssigned))
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-random"></i></span>
                    <span class="text">Buyback</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    <li class="{{ Request::path() == 'buyback/create' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('buyback/create')}}" class="menu-item">Add New Buyback</a></li>
                    <li class="{{ Request::path() == 'buyback/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('buyback/list')}}" class="menu-item">Buyback List</a></li>
                </ul>
            </li>
            @endif  --}}

            @if(in_array('sprepairnticket', $dataMenuAssigned))
            <!-- Start navigation - frontend themes -->
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon">
                        <i style="font-size: 20px; color: #fff;" class="fa icon-rtmat">
                <span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span>
                        </i>
                    </span>
                    <span class="text">Repair</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    @if(in_array('repair/create', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'repair/create' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('repair/create')}}" class="menu-item">New Inventory Repair</a></li>
                    @endif
                    @if(in_array('repair/list', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'repair/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('repair/list')}}" class="menu-item">Inventory Repair Data</a></li>
                    @endif
                    @if(in_array('ticket/create', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'ticket/create' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('ticket/create')}}" class="menu-item">New Non-Inventory Repair</a></li>
                    @endif
                    @if(in_array('ticket/list', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'ticket/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('ticket/list')}}" class="menu-item">Non-Inventory Repair Data</a></li>
                    @endif
                </ul>
            </li>
            @endif 

            @if(in_array('inventory', $dataMenuAssigned))
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-database"></i></span>
                    <span class="text">Inventory</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    @if(in_array('category', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'category' ? 'active' : '' }} border-bottom-purple"><a href="{{url('category')}}" class="menu-item">Product Category</a></li>
                    @endif 
                    @if(in_array('product', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'product' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('product')}}" class="menu-item">Add New Product</a></li>
                    @endif
                    @if(in_array('product/list', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'product/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('product/list')}}" class="menu-item">Product List</a></li>
                    @endif
                    @if(in_array('product/stock/in', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'product/stock/in' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/product/stock/in')}}" class="menu-item">Add New Stock</a></li>
                    @endif
                    @if(in_array('product/stock/in/list', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'product/stock/in/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/product/stock/in/list')}}" class="menu-item">Stock Order List</a></li>
                    @endif
                    @if(in_array('vendor/create', $dataMenuAssigned))
                    <li  class="{{ Request::path() == 'vendor/create' ? 'active' : '' }} border-bottom-purple">
                        <a href="{{url('/vendor/create')}}" class="menu-item">
                            Add New Vendor
                        </a>
                    </li>
                    @endif
                    @if(in_array('vendor/list', $dataMenuAssigned))
                    <li  class="{{ Request::path() == 'vendor/list' ? 'active' : '' }} border-bottom-purple">
                        <a href="{{url('/vendor/list')}}" class="menu-item">
                            Vendor List
                        </a>
                    </li>
                    @endif
                    
                    @if(in_array('variance/create', $dataMenuAssigned))
                    <li  class="{{ Request::path() == 'variance/create' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/variance/create')}}" class="menu-item">Add New Variance</a></li>
                    @endif 
                    @if(in_array('variance/report', $dataMenuAssigned))
                    <li  class="{{ Request::path() == 'variance/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/variance/report')}}" class="menu-item">Variance Report</a></li>
                    @endif 
                    @if(in_array('product/import', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'product/import' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('product/import')}}" class="menu-item">Import Product</a></li>
                    @endif 
                </ul>
            </li>
            @endif
           {{--  @if(in_array('warranty', $dataMenuAssigned))
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-times-circle"></i></span>
                    <span class="text">Warranty</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    @if(in_array('warranty', $dataMenuAssigned))
                    <li  class="{{ Request::path() == 'warranty' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/warranty')}}" class="menu-item">Create New Warranty</a></li>
                    @endif
                    @if(in_array('warranty/batch-out', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'warranty/batch-out' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/warranty/batch-out')}}" class="menu-item">Warranty Inventory</a></li>
                    @endif
                    @if(in_array('warranty/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'warranty/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/warranty/report')}}" class="menu-item">Warranty Batch Out Report</a></li>
                    @endif                    
                </ul>
            </li>
            @endif --}}
            
            {{-- @if(in_array('sales-return', $dataMenuAssigned))
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-shopping-cart"></i></span>
                    <span class="text">Sales Return</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    @if(in_array('sales/return/create', $dataMenuAssigned))
                    <li  class="{{ Request::path() == 'sales/return/create' ? 'active' : '' }} border-bottom-purple">
                        <a href="{{url('/sales/return/create')}}" class="menu-item">
                            Add New Sales Return
                        </a>
                    </li>
                    @endif 
                    @if(in_array('sales/return/list', $dataMenuAssigned))
                    <li  class="{{ Request::path() == 'sales/return/list' ? 'active' : '' }} border-bottom-purple">
                        <a href="{{url('/sales/return/list')}}" class="menu-item">
                            Sales Return List
                        </a>
                    </li>
                    @endif 
                </ul>
            </li>
            @endif 
             --}}
            {{-- @if(in_array('expense/voucher', $dataMenuAssigned))
            <li class="{{ Request::path() == 'expense/voucher' ? 'active' : '' }}">
                <a href="{{url('expense/voucher')}}">
                    <span class="icon"><i class="fa fa-shopping-basket"></i></span>
                    <span class="text">Expense Voucher</span>
                </a>
            </li>
            @endif  --}}
     
            <!--/ End navigation - frontend themes -->
            @if(in_array('reports', $dataMenuAssigned) || in_array('system-setting', $dataMenuAssigned))
            <!-- Start category apps -->
            <li class="sidebar-category">
                <span> Reports & Settings</span>
                <span class="pull-right"><i class="fa fa-pie-chart"></i> <i class="fa fa-cog"></i></span>
            </li>
             @endif 
            <!--/ End category apps -->
            @if(in_array('reports', $dataMenuAssigned))
            <!-- Start navigation - blog -->
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-area-chart"></i></span>
                    <span class="text">Reports</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    @if(in_array('attendance/punch/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'attendance/punch/report' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('attendance/punch/report')}}" class="menu-item">Attendance Punch Report</a></li>
                    @endif 

                    @if(in_array('authorize/net/payment/history', $dataMenuAssigned))
                    <li class="{{ Request::path() == '/authorize/net/payment/history' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/authorize/net/payment/history')}}" class="menu-item">Authorize Payment History</a></li>
                    @endif 

                    @if(in_array('authorize/net/payment/history', $dataMenuAssigned))
                    <li class="{{ Request::path() == '/cardpointe/payment/history' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/cardpointe/payment/history')}}" class="menu-item">CardPointe Payment History</a></li>
                    @endif 



                    @if(in_array('stripe/payment/history', $dataMenuAssigned))
                    <li class="{{ Request::path() == '/stripe/payment/history' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/stripe/payment/history')}}" class="menu-item">Stripe Payment History</a></li>
                    @endif 

                    @if(in_array('square/payment/history', $dataMenuAssigned))
                    <li class="{{ Request::path() == '/square/payment/history' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/square/payment/history')}}" class="menu-item">Square Payment History</a></li>
                    @endif 

                    @if(in_array('paypal/payment/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == '/report/buyback' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/report/buyback')}}" class="menu-item">Buyback Report</a></li>
                    @endif 
                    @if(in_array('expense/voucher/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'expense/voucher/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/expense/voucher/report')}}" class="menu-item">Expense Voucher Report</a></li>
                    @endif 
                    @if(in_array('report/highestseller', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'report/highestseller' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/report/highestseller')}}" class="menu-item">Highest Seller Datewise Report</a></li>
                    @endif 
                    @if(in_array('report/highestseller/Summary', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'report/highestseller/Summary' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/report/highestseller/Summary')}}" class="menu-item">Highest Seller Summary Report</a></li>
                    @endif 
                    @if(in_array('profit/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'profit/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/profit/report')}}" class="menu-item">Profit Report</a></li>
                    @endif 
                    @if(in_array('product/profit/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'product/profit/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/product/profit/report')}}" class="menu-item">Product Wise Profit Report</a></li>
                    @endif 
                    @if(in_array('payment/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'payment/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/payment/report')}}" class="menu-item">Payment Report</a></li>
                    @endif 
                    @if(in_array('product/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'product/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/product/report')}}" class="menu-item">Product Status Report</a></li>
                    @endif 
                    @if(in_array('paypal/payment/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == '/paypal/payment/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/paypal/payment/report')}}" class="menu-item">Paypal Payment History Report</a></li>
                    @endif 
                    @if(in_array('report/payout', $dataMenuAssigned))
                    <li class="{{ Request::path() == '/report/payout' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/report/payout')}}" class="menu-item">Payout Report</a></li>
                    @endif 
                    @if(in_array('paypal/payment/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == '/repair/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/repair/report')}}" class="menu-item">Repair Report</a></li>
                    @endif 
                    @if(in_array('lcd/status/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == '/lcd/status/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/lcd/status/report')}}" class="menu-item">Repair LCD Report</a></li>
                    @endif 
                    @if(in_array('salvage/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == '/salvage/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/salvage/report')}}" class="menu-item">Salvage Part Report</a></li>
                    @endif 

                    @if(in_array('sales/return/list', $dataMenuAssigned))
                        <li  class="{{ Request::path() == 'sales/return/list' ? 'active' : '' }} border-bottom-purple">
                            <a href="{{url('/sales/return/list')}}" class="menu-item">Sales Return Report
                            </a>
                        </li>
                    @endif 
                    
                    @if(in_array('paypal/payment/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == '/store/close/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/store/close/report')}}" class="menu-item">Store Close Report</a></li>
                    @endif 
                    @if(in_array('product/stock/in/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'product/stock/in/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('product/stock/in/report')}}" class="menu-item">Stock Received Report</a></li>
                    @endif 
                    @if(in_array('sales/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'sales/report' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('sales/report')}}" class="menu-item">Sales Report</a></li>
                    @endif 
                    @if(in_array('paypal/payment/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == '/report/tender' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/report/tender')}}" class="menu-item">Tender Report</a></li>
                    @endif 
                    @if(in_array('paypal/payment/report', $dataMenuAssigned))
                    <li class="{{ Request::path() == '/ticket/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/ticket/report')}}" class="menu-item">Ticket Report</a></li>
                    @endif 
                    

                    
                    
                    
                </ul>
            </li>
            @endif 
            @if(in_array('system-setting', $dataMenuAssigned))
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-connectdevelop"></i></span>
                    <span class="text">System Setting</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    @if(in_array('tender', $dataMenuAssigned))
                    <li class="{{ Request::path() == 'tender' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/tender')}}" class="menu-item">Add New Tender</a></li>
                    @endif 

                    @if(in_array('authorize/net/payment/setting', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'authorize/net/payment/setting' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/authorize/net/payment/setting')}}" class="menu-item">AuthorizeNet Account </a></li>
                    @endif 

                    @if(in_array('cardpointe/payment/setting', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'cardpointe/payment/setting' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/cardpointe/payment/setting')}}" class="menu-item">CardPointe Account </a></li>
                    @endif 

                    @if(in_array('paypal/account/setting', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'paypal/account/setting' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/paypal/account/setting')}}" class="menu-item">Paypal Account Setting</a></li>
                    @endif 
                    
                    
                    @if(in_array('stripe/account/setting', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'stripe/account/setting' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/stripe/account/setting')}}" class="menu-item">Stripe Account Setting</a></li>
                    @endif 
                    
                    @if(in_array('square/account/setting', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'square/account/setting' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/square/account/setting')}}" class="menu-item">Square Account Setting</a></li>
                    @endif 
                    
                    @if(in_array('stripe/account/setting', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'cardpointe/account/setting' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/cardpointe/account/setting')}}" class="menu-item">Cardpointe Account Setting</a></li>
                    @endif 
                    

                    @if(in_array('settings/barcode', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'settings/barcode' ? 'active' : '' }} border-bottom-purple"><a href="{{url('settings/barcode')}}" class="menu-item">Barcode Print</a></li>
                    @endif 
                    
         
                    @if(in_array('counter/display/add', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'counter/display/add' ? 'active' : '' }} border-bottom-purple"><a href="{{url('counter/display/add')}}" class="menu-item">Counter Display Add/Remove</a></li>
                    @endif 
                    @if(in_array('settings/invoice/email', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == '/settings/invoice/email' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/settings/invoice/email')}}" class="menu-item">Invoice email template</a></li>
                    @endif  

                    @if(in_array('spInstoreRepairSettings', $dataMenuAssigned))
                    <li class="submenu">
                        <a href="javascript:void(0);" class="menu-item">
                        Inventory Repair Settings
                        </a>
                        <ul>
                            @if(in_array('settings/instorerepair', $dataMenuAssigned))
                            <li  class="{{ Request::path() == 'settings/instorerepair' ? 'active' : '' }}">
                                <a href="{{url('settings/instorerepair')}}" class="menu-item">
                                    New Inventory Repair
                                </a>
                            </li>
                            @endif 
                            @if(in_array('settings/instore/merge/repair/data', $dataMenuAssigned))
                            <li  class="{{ Request::path() == 'settings/instore/merge/repair/data' ? 'active' : '' }}">
                                <a href="{{url('settings/instore/merge/repair/data')}}" class="menu-item">
                                    Inventory Repair Data Merge
                                </a>
                            </li>
                            @endif
                            @if(in_array('settings/instore/asset/repair/create', $dataMenuAssigned))
                            <li  class="{{ Request::path() == 'settings/instore/asset/repair/create' ? 'active' : '' }}">
                                <a href="{{url('settings/instore/asset/repair/create')}}" class="menu-item">
                                    Inventory Repair Asset 
                                </a>
                            </li>
                            @endif 
                            
                        </ul>
                    </li>
                    @endif 
                    
                    @if(in_array('settingsInStoreRepairInfo', $dataMenuAssigned)) 
                    <li class="submenu">
                        <a href="javascript:void(0);" class="menu-item">
                        Inventory Repair Data List
                        </a>
                        <ul>
                            @if(in_array('settings/instore/device/list', $dataMenuAssigned))
                            <li  class="{{ Request::path() == 'settings/instore/device/list' ? 'active' : '' }}">
                                <a href="{{url('settings/instore/device/list')}}" class="menu-item">
                                    Device Data List
                                </a>
                            </li>
                            @endif 
                            @if(in_array('settings/instore/model/list', $dataMenuAssigned))
                            <li  class="{{ Request::path() == 'settings/instore/model/list' ? 'active' : '' }}">
                                <a href="{{url('settings/instore/model/list')}}" class="menu-item">
                                    Model Data List
                                </a>
                            </li>
                            @endif
                            @if(in_array('settings/instore/problem/list', $dataMenuAssigned))
                            <li  class="{{ Request::path() == 'settings/instore/problem/list' ? 'active' : '' }}">
                                <a href="{{url('settings/instore/problem/list')}}" class="menu-item">
                                    Problem Data List
                                </a>
                            </li>
                            @endif 
                            @if(in_array('settings/instore/price/list', $dataMenuAssigned))
                            <li  class="{{ Request::path() == 'settings/instore/price/list' ? 'active' : '' }}">
                                <a href="{{url('settings/instore/price/list')}}" class="menu-item">
                                    Price Data List
                                </a>
                            </li>
                            @endif 
                        </ul>
                    </li>
                    @endif
                    
                    @if(in_array('site/navigation', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'site/navigation' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/site/navigation')}}" class="menu-item">Navigation Setting</a></li>
                    @endif 

                    @if(in_array('settings/instore/asset/ticket/create', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'settings/instore/asset/repair/create' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/settings/instore/asset/repair/create')}}" class="menu-item">Inventory Repair Asset </a></li>
                    @endif 
                    
                    @if(in_array('settings/instore/asset/ticket/create', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'settings/instore/asset/ticket/create' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/settings/instore/asset/ticket/create')}}" class="menu-item">Non-Inventory Repair Asset </a></li>
                    @endif 
                    
                    @if(in_array('settings/ticket/problem', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'settings/ticket/problem' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/settings/ticket/problem')}}" class="menu-item">
                    Non-Inventory Repair Problem
                    </a></li>
                    @endif 
                    
                    @if(in_array('pos/settings', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == '/pos/settings' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/pos/settings')}}" class="menu-item">POS Setting</a></li>
                    @endif 
                    @if(in_array('setting/printer/print-paper/size', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == '/setting/printer/print-paper/size' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/setting/printer/print-paper/size')}}" class="menu-item">Printer Paper Size</a></li>
                    @endif 

                    @if(in_array('tax/settings', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == '/tax/settings' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/tax/settings')}}" class="menu-item">Tax Settings</a></li>
                    @endif 
                    
                    {{-- <li class="{{ Request::path() == 'site/color' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/site/color')}}" class="menu-item">Color Plate</a></li> --}} 
                    @if(in_array('TutorialVideo', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == '/TutorialVideo' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/TutorialVideo')}}" class="menu-item">Manage Tutorial Video</a></li>
                    @endif 
                    
                </ul>
            </li>
            @endif 
            
            @if(in_array('storesettings', $dataMenuAssigned)) 
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa icon-home22"></i></span>
                    <span class="text">Store Setting</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    @if(in_array('store-shop', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'store-shop' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/store-shop')}}" class="menu-item">Add New Store</a></li>
                    @endif 
                    @if(in_array('store-shop/list', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'store-shop/list' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/store-shop/list')}}" class="menu-item">Store List </a></li>
                    @endif 
                    @if(in_array('user', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'user' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/user')}}" class="menu-item">Add New User</a></li>
                    @endif 
                    @if(in_array('user/list', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'user/list' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/user/list')}}" class="menu-item">User List </a></li>
                    @endif 
                    @if(in_array('attendance/punch/manual', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == 'attendance/punch/manual' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/attendance/punch/manual')}}" class="menu-item">Add Manual Attendance </a></li>
                    @endif 
                    @if(in_array('role', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == '/role' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/role')}}" class="menu-item">Role Setting</a></li>
                    @endif 
                    @if(in_array('menu-item', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == '/menu-item' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/menu-item')}}" class="menu-item">Menu-Item Setting</a></li>
                    @endif 
                    @if(in_array('RoleWiseMenu', $dataMenuAssigned)) 
                    <li class="{{ Request::path() == '/RoleWiseMenu' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/RoleWiseMenu')}}" class="menu-item">Role Wise Menu Setting</a></li>
                    @endif 
                </ul>
            </li>
            @endif 
            <!--/ End navigation - blog -->
            @if(in_array('help-desk', $dataMenuAssigned))
            <li class="sidebar-category">
                <span> Help Desk</span>
                <span class="pull-right"><i class="fa fa-desktop"></i></span>
            </li>

            @if(in_array('admin/chat', $dataMenuAssigned)) 
            <li>
                <a href="{{url('admin/chat')}}">
                    <span class="icon"><i class="fa fa-comments"></i></span>
                    <span class="text">Admin Chat Window</span>
                </a>
            </li>
            @endif

            <!-- Start navigation - mail -->
            @if(in_array('helpdesk', $dataMenuAssigned)) 
            <li>
                <a href="{{url('helpdesk')}}">
                    <span class="icon"><i class="fa fa-video-camera"></i></span>
                    <span class="text">Tutorial Videos</span>
                </a>
            </li>
            @endif 
            @if(in_array('event/calendar', $dataMenuAssigned)) 
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-calendar"></i></span>
                    <span class="text">Event Calendar</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    <li><a href="{{url('event/calendar')}}" title="">Event/Schedule Calendar</a></li>
                    @if(in_array('event/calendar/create', $dataMenuAssigned)) 
                        <li><a href="{{url('event/calendar/create')}}" title="">Create Event/Schedule</a></li>
                    @endif
                    @if(in_array('event/calendar/list', $dataMenuAssigned)) 
                        <li><a href="{{url('event/calendar/list')}}" title="">Events & Schedule List</a></li> 
                    @endif
                </ul>
            </li>
            @endif 
            @if(in_array('SupportTicket', $dataMenuAssigned)) 
            <li class="submenu">
                <a href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-support"></i></span>
                    <span class="text">Support Ticket</span>
                    <span class="arrow"></span>
                </a>
                <ul>
                    @if(in_array('Department', $dataMenuAssigned)) 
                        <li><a href="{{url('Department')}}" title="">Department</a></li>
                    @endif 
                    @if(in_array('SupportTicket', $dataMenuAssigned)) 
                        <li><a href="{{url('SupportTicket')}}" title="">Add New Ticket</a></li> 
                    @endif 
                    @if(in_array('SupportTicket/list', $dataMenuAssigned)) 
                        <li><a href="{{url('SupportTicket/list')}}" title="">Manage Support Ticket</a></li>
                    @endif
                </ul>
                
            </li>
            @endif 
          


            <li>
                <a target="_blank" href="{{$userGuideLink}}">
                    <span class="icon"><i class="fa fa-video-camera"></i></span>
                    <span class="text">User Guide</span>
                </a>
            </li>
            @endif
            <li>
                <a target="_blank" class="copyButton" href="javascript:void(0);">
                    <span class="icon"><i class="fa fa-desktop"></i></span>
                    <span class="text">Counter Display Link</span>
                    <div style="opacity: 0; height: 0px !important;" id="cdlDt">http://counter-display.simpleretailpos.com</div>
                </a>
            </li>
            <!--/ End documentation - api documentation -->

        </ul><!-- /.sidebar-menu -->
        <!--/ End left navigation - menu -->

        <div id="tour-10" class="sidebar-footer hidden-xs hidden-sm hidden-md">
        </div>
    </aside><!-- /#sidebar-left -->


<?php /*
{{-- 
<div data-scroll-to-active="true" class="main-menu menu-flipped menu-fixed menu-dark menu-bordereded menu-accordion menu-shadow">
      <!-- main menu header-->
      <!-- / main menu header-->
      <!-- main menu content-->
      <div class="main-menu-content">
        <ul id="main-menu-navigation" data-menu="menu-navigation" class="navigation navigation-main">
          <li class="nav-item {{ Request::path() == 'dashboard' ? 'active' : '' }} border-bottom-purple"><a href="{{url('dashboard')}}"><i class="icon-dashboard"></i><span data-i18n="nav.dash.main" class="menu-title">Dashboard</span>
          </a>
          </li>

          <li class=" nav-item border-bottom-purple">
            <a href="#">
              <i class="icon-cart"></i>
              <span class="menu-title">Sales</span>
            </a>
            <ul class="menu-content">
              <li class="{{ Request::path() == 'pos' ? 'active' : '' }} border-bottom-purple"><a href="{{url('pos')}}" class="menu-item">Point of Sales (POS)</a></li>
              <li class="{{ Request::path() == 'counter-display' ? 'active' : '' }} border-bottom-purple"><a href="{{url('counter-display')}}" class="menu-item">Counter Display</a></li>
              <li class="{{ Request::path() == 'sales' ? 'active' : '' }} border-bottom-purple"><a href="{{url('sales')}}" class="menu-item">Add New Sales</a></li>
              <li class="{{ Request::path() == 'sales/report' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('sales/report')}}" class="menu-item">Sales Report</a></li>

            </ul>
          </li>
          <li class=" nav-item border-bottom-purple">
            <a href="#">
              <i class="icon-user"></i>
              <span class="menu-title">Customer</span>
            </a>
            <ul class="menu-content">
              <li class="{{ Request::path() == 'customer' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('customer')}}" class="menu-item">Add New Customer</a></li>
              <li class="{{ Request::path() == 'customer/report' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('customer/report')}}" class="menu-item">Customer Report</a></li>
            </ul>
          </li>
          <li class=" nav-item  border-bottom-purple">
            <a href="#">
              <i class="icon-mobile"></i>
              <span class="menu-title">Product</span>
            </a>
              <ul class="menu-content">
                <li class="{{ Request::path() == 'product' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('product')}}" class="menu-item">Add New Product</a></li>
                <li class="{{ Request::path() == 'product/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('product/list')}}" class="menu-item">Product List</a></li>
              </ul>
          </li>
          <li class=" nav-item  border-bottom-purple">
            <a href="#">
              <i class="icon-stack"></i>
              <span class="menu-title">Product Stock In</span>
            </a>
              <ul class="menu-content">
                <li class="{{ Request::path() == 'product/stock/in' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/product/stock/in')}}" class="menu-item">New Stock In</a></li>
                <li class="{{ Request::path() == 'product/stock/in/list' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/product/stock/in/list')}}" class="menu-item">Stock In Order List</a></li>
              </ul>
          </li>
           <li class=" nav-item  border-bottom-purple">
            <a href="#">
              <i class="icon-credit-card"></i>
              <span class="menu-title">Tender</span>
            </a>
              <ul class="menu-content">
                <li class="{{ Request::path() == 'tender' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/tender')}}" class="menu-item">Add New Tender</a></li>
                <li class="{{ Request::path() == 'tender/report' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/tender/report')}}" class="menu-item">Tender Report</a></li>
              </ul>
          </li>
          <li class=" nav-item  border-bottom-purple">
            <a href="#">
              <i class="icon-archive2"></i>
              <span class="menu-title">Warranty</span>
            </a>
              <ul class="menu-content">
                <li  class="{{ Request::path() == 'warranty' ? 'active' : '' }}  border-bottom-purple"><a href="{{url('/warranty')}}" class="menu-item">Create Warranty</a></li>
                <li class="{{ Request::path() == 'warranty/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/warranty/report')}}" class="menu-item">Warranty Report</a></li>
                <li class="{{ Request::path() == 'warranty/batch-out' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/warranty/batch-out')}}" class="menu-item">Warranty Batch Out</a></li>
              </ul>
          </li>

          <li class=" nav-item  border-bottom-purple">
            <a href="#">
              <i class="icon-gg"></i>
              <span class="menu-title">Variance</span>
            </a>
              <ul class="menu-content">
                <li  class="{{ Request::path() == 'variance/create' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/variance/create')}}" class="menu-item">Create Variance</a></li>
                <li  class="{{ Request::path() == 'variance/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/variance/report')}}" class="menu-item">Variance Report</a></li>
              </ul>
          </li>
          <li class=" nav-item border-bottom-purple">
            <a href="#">
              <i class="icon-television"></i>
              <span class="menu-title">Report</span>
            </a>
              <ul class="menu-content">
                <li class="{{ Request::path() == 'profit/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/profit/report')}}" class="menu-item">Profit Report</a></li>
                <li class="{{ Request::path() == 'payment/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/payment/report')}}" class="menu-item">Payment Report</a></li>
                <li class="{{ Request::path() == 'product/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/product/report')}}" class="menu-item">product Status Report</a></li>
                <li class="{{ Request::path() == 'product/stock/in/report' ? 'active' : '' }} border-bottom-purple"><a href="{{url('product/stock/in/report')}}" class="menu-item">product Stockin  Report</a></li>
              </ul>
          </li>
          <li class=" nav-item border-bottom-purple">
            <a href="#">
              <i class="icon-stack-2"></i>
              <span class="menu-title">Setting</span>
            </a>
              <ul class="menu-content">
                <li class="{{ Request::path() == '/pos/settings' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/pos/settings')}}" class="menu-item">POS Setting</a></li>
                {{-- <li class="{{ Request::path() == '/setting' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/setting')}}" class="menu-item">Setting</a></li> --}}
                <li class="{{ Request::path() == 'site/navigation' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/site/navigation')}}" class="menu-item">Navigation Setting</a></li>
                <li class="{{ Request::path() == 'counter/display/add' ? 'active' : '' }} border-bottom-purple"><a href="{{url('counter/display/add')}}" class="menu-item">Counter Display Add/Remove</a></li>
                <li class="{{ Request::path() == 'site/color' ? 'active' : '' }} border-bottom-purple"><a href="{{url('/site/color')}}" class="menu-item">Color Plate</a></li>
              </ul>
          </li>
          <li class="nav-item border-bottom-purple"><a href="javascript:void(0);"><i class="icon-android-globe"></i><span data-i18n="nav.dash.main" class="menu-title">{{$_SERVER['REMOTE_ADDR']}}</span>
          </a>
          </li>
        </ul>
      </div>

 --}} */ ?>
 @section('js')
 <script type="text/javascript">
     $(document).ready(function(){
            $("#copyButton").click(function(){
                copyToClipboard(document.getElementById("copyTarget"));
            });
     });
     /*document.getElementById("copyButton").addEventListener("click", function() {
    copyToClipboard(document.getElementById("copyTarget"));
});*/

function copyToClipboard(elem) {
      // create hidden text element, if it doesn't already exist
    var targetId = "_hiddenCopyText_";
    var isInput = elem.tagName === "INPUT" || elem.tagName === "TEXTAREA";
    var origSelectionStart, origSelectionEnd;
    if (isInput) {
        // can just use the original source element for the selection and copy
        target = elem;
        origSelectionStart = elem.selectionStart;
        origSelectionEnd = elem.selectionEnd;
    } else {
        // must use a temporary form element for the selection and copy
        target = document.getElementById(targetId);
        if (!target) {
            var target = document.createElement("textarea");
            target.style.position = "absolute";
            target.style.left = "-9999px";
            target.style.top = "0";
            target.id = targetId;
            document.body.appendChild(target);
        }
        target.textContent = elem.textContent;
    }
    // select the content
    var currentFocus = document.activeElement;
    target.focus();
    target.setSelectionRange(0, target.value.length);
    
    // copy the selection
    var succeed;
    try {
          succeed = document.execCommand("copy");
    } catch(e) {
        succeed = false;
    }
    // restore original focus
    if (currentFocus && typeof currentFocus.focus === "function") {
        currentFocus.focus();
    }
    
    if (isInput) {
        // restore prior selection
        elem.setSelectionRange(origSelectionStart, origSelectionEnd);
    } else {
        // clear temporary content
        target.textContent = "";
    }
    return succeed;
}
 </script>
 @endsection