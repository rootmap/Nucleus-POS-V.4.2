<!DOCTYPE html>
<html lang="en" data-textdirection="LTR" class="loading">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta name="description" content="nucleuspos">
  <meta name="keywords" content="pos,nucleuspos">
  <meta name="author" content="Md Mahamudur Zaman Bhuyian - Fahad">
  <title>
    @yield('title')
     | 
    nucleuspos.com 
  </title>

  @include('login.include.headercss')
</head>
<body data-open="click" data-menu="vertical-menu" data-col="1-column" class="vertical-layout vertical-menu 1-column bg-green bg-lighten-2 fixed-navbar">

  <!-- navbar-fixed-top-->
  <nav class="header-navbar navbar navbar-with-menu navbar-fixed-top navbar-dark navbar-shadow">
    <div class="navbar-wrapper">
      <div class="navbar-header">
        <ul class="nav navbar-nav float-xs-left">
          <li class="nav-item mobile-menu hidden-md-up float-xs-left"><a class="nav-link nav-menu-main menu-toggle hidden-xs"><i class="icon-menu5 font-large-1"></i></a></li>
          <li class="nav-item"><a href="index.html" class="navbar-brand nav-link"><img alt="branding logo" src="{{url('images/nabLogoNuc.png')}}" data-expand="{{url('images/nabLogoNuc.png')}}" data-collapse="{{url('images/nabLogoNuc.png')}}" class="brand-logo"></a></li>
          <li class="nav-item hidden-md-up float-xs-right"><a data-toggle="collapse" data-target="#navbar-mobile" class="nav-link open-navbar-container"><i class="icon-ellipsis pe-2x fa-rotate-90"></i></a></li>
          
        </ul>

        
        
        

      </div>
        <a href="http://v3.nucleuspos.com" style="margin-top: 12px; float: right; margin-right: 10px;" class="btn btn-green">
             <i class="icon-open"></i> ACCESS OLD SYSTEM
        </a>
    </div>
  </nav>


  <!-- ////////////////////////////////////////////////////////////////////////////-->
  <div class="app-content content container-fluid">
    <div class="content-wrapper">
      <div class="content-header row">
      </div>
      <div class="content-body"> 
          
          @yield('content')
      </div>
    </div>
  </div>
  <!-- ////////////////////////////////////////////////////////////////////////////-->


  @include('login.include.fotter')

  <!-- BEGIN VENDOR JS-->
  <!-- build:js app-assets/js/vendors.min.js-->
  @include('login.include.fotterjs')
</body>

</html>
