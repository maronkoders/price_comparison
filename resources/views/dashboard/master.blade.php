<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="utf-8" />
     <link rel="icon"  href="{{asset('images/logo.png')}}" type="image/icon type">
     <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
     <title> Priceline | Dashboard</title>
     <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
     <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
     <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet" />
     <link href="{{asset('css/light-bootstrap-dashboard.css?v=2.0.0')}} " rel="stylesheet" />
     <link href="{{asset('css/demo.css')}}" rel="stylesheet" />
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.0.0-rc.1/dist/html2canvas.min.js"></script>
 </head>

 <body>
     <div class="wrapper" id="contents">
         <router-view></router-view>
     </div>
 </body>
 
 <script src="{{mix('js/app.js')}}"></script>
 <script src="{{asset('js/core/jquery.3.2.1.min.js')}}" type="text/javascript"></script>
 <script src="{{asset('js/core/popper.min.js')}}" type="text/javascript"></script>
 <script src="{{asset('js/core/bootstrap.min.js')}}" type="text/javascript"></script>
 <script src="{{asset('js/plugins/bootstrap-switch.js')}}"></script>
 <script src="{{asset('js/plugins/chartist.min.js')}}"></script>
 <script src="{{asset('js/plugins/bootstrap-notify.js')}}"></script>
 <script src="{{asset('js/light-bootstrap-dashboard.js?v=2.0.0')}} " type="text/javascript"></script>
 <script src="{{asset('js/demo.js')}}"></script>
 </html>
 