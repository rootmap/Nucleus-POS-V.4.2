@include('apps.include.chat.chat')
<?php 
    $dataslideCheck=1;
    $dataslideCheck=StaticDataController::slideCheck();
    //dd($dataMenuAssigned);
    $userguideInit=StaticDataController::userguideInit();
    $useralreadyguideInit=StaticDataController::useralreadyguideInit();

    //dd($userguideInit);
?>
{{-- <span>{{$userguideInit}}</span> --}}
<?php
if($userguideInit==1)
{
    ?>
    <div class="modal animated zoomIn text-xs-left" id="initiateUserGuideTour" tabindex="-5" role="dialog" aria-labelledby="myModalLabel69" aria-hidden="true" style="top: 25%;">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-body">
            <p class="text-xs-center"><img style="height: 50px;" src="{{asset('images/logo/header-logo.png')}}" alt="Nucleus POS Logo"></p>
            @if($useralreadyguideInit>0)
                <h2 class="success text-xs-center">Welcome to Nucleus POS Again.<br><small style="font-size: 10px;">Version 4.0.1</small></h2>
            @else
                <h2 class="success text-xs-center">Welcome to Nucleus POS Again.<br><small style="font-size: 10px;">Version 4.0.1</small></h2>
            @endif
            <p class="text-xs-center">
                <button type="button" id="strSystemTour" class="btn btn-success btn-min-width btn-round mr-1 mb-1"><i class="icon-play"></i> Yes, Start System Tour </button>
                <button type="button" id="skpSystemTour" class="btn btn-success btn-min-width btn-round mr-1 mb-1"><i class="icon-skip-forward2"></i> Skip Now </button>
                <button type="button" id="stpSystemTour" class="btn btn-success btn-min-width btn-round mr-1 mb-1"><i class="icon-cross"></i> No, I already know </button>
            </p>
            @if($useralreadyguideInit>0)
                <p class="text-xs-center">Would you like to start system tour again? Also you can always find the menu in helpdesk.</p>
            @else
                <p class="text-xs-center">Would you like to start system tour? Also you can always find the menu in helpdesk.</p>
            @endif
          </div>
        </div>
      </div>
    </div>
    <?php
}
?>
<!-- BEGIN VENDOR JS-->
    <!-- build:js app-assets/js/vendors.min.js-->
    <script src="{{url('theme/app-assets/js/core/libraries/jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/ui/tether.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/js/core/libraries/bootstrap.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/ui/perfect-scrollbar.jquery.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/ui/unison.min.js')}}" type="text/javascript"></script>

    <script src="{{url('theme/app-assets/vendors/js/ui/blockUI.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/ui/jquery.matchHeight-min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/ui/jquery-sliding-menu.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/sliders/slick/slick.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/ui/screenfull.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/vendors/js/extensions/pace.min.js')}}" type="text/javascript"></script>
    <!-- /build-->
    <!-- BEGIN VENDOR JS-->
    <!-- BEGIN PAGE VENDOR JS-->
    <!-- END PAGE VENDOR JS-->
    <!-- BEGIN ROBUST JS-->
    <!-- build:js app-assets/js/app.min.js-->
    <script src="{{url('theme/app-assets/js/core/app-menu.min.js')}}" type="text/javascript"></script>
    <script src="{{url('theme/app-assets/js/core/app.min.js')}}" type="text/javascript"></script>
    <!-- /build-->
    <!-- START CORE PLUGINS -->
<script type="text/javascript">
        var csrftLarVe=$('meta[name="pos-token"]').attr('content');
        var chatMessSendUrl="{{url('chat/message/send')}}";
        var chatMessloUrl="{{url('chat/message/load')}}";
        var chatMessPhotoUrl="{{url('chat/conv/usr/image')}}";
        var chatInterfaceUserID="{{Auth::user()->id}}";
        var chatInterfaceUserName="{{Auth::user()->name}}";
        var searchnucleus = "{{secure_url('search-nucleus')}}";
        var siteConfig_dataslideCheck = "{{$dataslideCheck}}";
        var siteConfig_userguideInit = "{{$userguideInit}}";
        var siteConfig_check_idle_user = "{{secure_url('check/idle/user')}}";
        var siteConfig_slide_menu_slide_status="{{secure_url('slide-menu/slide/status')}}";
        var siteConfig_introjs_intro_js_file="{{secure_url('introjs/intro.js')}}";
        var siteConfig_systemtour_ajax_status="{{secure_url('systemtour/ajax/status')}}";
        var siteConfig_Request_path="{{Request::path()}}";        
        var siteConfig_fullscreenSearch="{{url('theme/app-assets/js/scripts/ui/fullscreenSearch.js')}}";  
</script>



<!-- BEGIN Custom CSS-->
<script src="{{url('theme/sidebar/assets/js/jquery.cookie.js')}}"></script>
<script src="{{url('theme/sidebar/assets/js/handlebars.js')}}"></script>
<script src="{{url('theme/sidebar/assets/js/typeahead.bundle.min.js')}}"></script>
<script src="{{url('theme/sidebar/assets/js/jquery.nicescroll.min.js')}}"></script>
<!-- END Custom CSS-->
    <!--/ END CORE PLUGINS -->
    <!-- START PAGE LEVEL SCRIPTS -->
<script src="{{url('theme/sidebar/assets/js/apps.js')}}"></script>
<script src="{{url('theme/sidebar/assets/js/demo.js')}}"></script>
    <!--/ END PAGE LEVEL SCRIPTS -->
    <!-- END ROBUST JS-->
    <!-- BEGIN PAGE LEVEL JS-->
    <!-- END PAGE LEVEL JS-->
<script>

    

</script>
<script src="{{secure_url('js/site.js')}}"></script>
<script src="{{url('chat/sc.js')}}"></script>

    