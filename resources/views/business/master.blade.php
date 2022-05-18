<!DOCTYPE html>
<html lang="en">
<head>

   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <meta name="description" content="au theme template">
   <meta name="author" content="Hau Nguyen">
   <meta name="keywords" content="au theme template">

   <!-- Title Page-->
   <title>Dashboard</title>

   <!-- Fontfaces CSS-->
   <link href="{{asset('business_assets/css/font-face.css')}}" rel="stylesheet" media="all">
   <link href="{{asset('business_assets/vendor/font-awesome-4.7/css/font-awesome.min.css')}}" rel="stylesheet" media="all">
   <link href="{{asset('business_assets/vendor/font-awesome-5/css/fontawesome-all.min.css')}}" rel="stylesheet" media="all">
   <link href="{{asset('business_assets/vendor/mdi-font/css/material-design-iconic-font.min.css')}}" rel="stylesheet" media="all">

   <!-- Bootstrap CSS-->
   <link href="{{asset('business_assets/vendor/bootstrap-4.1/bootstrap.min.css')}}" rel="stylesheet" media="all">

   <!-- Vendor CSS-->
   <link href="{{asset('business_assets/vendor/animsition/animsition.min.css')}}" rel="stylesheet" media="all">
   <link href="{{asset('business_assets/vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css')}}" rel="stylesheet" media="all">
   <link href="{{asset('business_assets/vendor/wow/animate.css')}}" rel="stylesheet" media="all">
   <link href="{{asset('business_assets/vendor/css-hamburgers/hamburgers.min.css')}}" rel="stylesheet" media="all">
   <link href="{{asset('business_assets/vendor/slick/slick.css')}}" rel="stylesheet" media="all">
   <link href="{{asset('business_assets/vendor/select2/select2.min.css')}}" rel="stylesheet" media="all">
   <link href="{{asset('business_assets/vendor/perfect-scrollbar/perfect-scrollbar.css')}}" rel="stylesheet" media="all">

   <!-- Main CSS-->
   <link href="{{asset('business_assets/css/theme.css')}}" rel="stylesheet" media="all">

</head>
   <body class="animsition" >
      <div class="page-wrapper" id='business_dashboard'>
         @include('business.haeder')
         @include('business.sidebar')
         <div class="page-container">
            @include('business.logout')
             @yield('content')
         </div>
       </div>
    </body>
    <script src="{{mix('js/business_side.js')}}"></script>

    <script src="{{asset('business_assets/vendor/jquery-3.2.1.min.js')}}"></script>
    <!-- Bootstrap JS-->
    <script src="{{asset('business_assets/vendor/bootstrap-4.1/popper.min.js')}}"></script>
    <script src="{{asset('business_assets/vendor/bootstrap-4.1/bootstrap.min.js')}}"></script>
    <!-- Vendor JS       -->
    <script src="{{asset('business_assets/vendor/slick/slick.min.js')}}">
    </script>
    <script src="{{asset('business_assets/vendor/wow/wow.min.js')}}"></script>
    <script src="{{asset('business_assets/vendor/animsition/animsition.min.js')}}"></script>
    <script src="{{asset('business_assets/vendor/bootstrap-progressbar/bootstrap-progressbar.min.js')}}">
    </script>
    <script src="{{asset('business_assets/vendor/counter-up/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('business_assets/vendor/counter-up/jquery.counterup.min.js')}}">
    </script>
    <script src="{{asset('business_assets/vendor/circle-progress/circle-progress.min.js')}}"></script>
    <script src="{{asset('business_assets/vendor/perfect-scrollbar/perfect-scrollbar.js')}}"></script>
    <script src="{{asset('business_assets/vendor/chartjs/Chart.bundle.min.js')}}"></script>
    <script src="{{asset('business_assets/vendor/select2/select2.min.js')}}">
    </script>

    <!-- Main JS-->
    <script src="{{asset('business_assets/js/main.js')}}"></script>
</html>
