<!DOCTYPE html>
<html>
    @include('admin.includes.head')
    <style> 
@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

/* Add animation to "page content" */
.animate-bottom {
  position: relative;
  -webkit-animation-name: animatebottom;
  -webkit-animation-duration: 1s;
  animation-name: animatebottom;
  animation-duration: 1s
}

@-webkit-keyframes animatebottom {
  from { bottom:-100px; opacity:0 } 
  to { bottom:0px; opacity:1 }
}

@keyframes animatebottom { 
  from{ bottom:-100px; opacity:0 } 
  to{ bottom:0; opacity:1 }
}

#wrapper {
  display: none;
}
    </style> 
    <div id="loader"></div>
    <body class="" onload="myFunction()" style="margin:0;">
        <div id="wrapper" style="display:none;">
            @include('admin.includes.sideBar')
            <div id="page-wrapper" class="gray-bg">
                <!-- <div id="loader" class="center"></div>  -->
                @include('admin.includes.topNavigation')
                @yield('mainContent')
                @include('admin.includes.footer')
            </div>
        </div>
        @include('admin.includes.scripts')
    </body>
</html>
