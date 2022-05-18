<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>PriceLine | Login</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    {{-- <link rel="icon" href="http://dev.shopsavvy.co.zw/images/media/2021/05/8mOEN19810.png" type="image/icon type"> --}}
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <style>
      
body {
 
  font-family: "Roboto";
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
 
}
body::before {
  z-index: -1;
  content: '';
  position: fixed;
  top: 0;
  left: 0;
  background: #44c4e7;
  width: 100%;
  height: 100%;
}


.form h2 {
  margin: 0 0 20px;
  line-height: 1;
  color: #44c4e7;
  font-size: 18px;
  font-weight: 400;
}
.form input {
  outline: none;
  display: block;
  width: 100%;
  margin: 0 0 10px;
  padding: 10px 15px;
  border: 1px solid #ccc;
  color: #000;
  font-family: "Roboto";
  box-sizing: border-box;
  font-size: 16px;
  font-wieght: 400;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  transition: 0.2s linear;
}

.form select {
  outline: none;
  display: block;
  width: 100%;
  margin: 0 0 10px;
  padding: 10px 15px;
  border: 1px solid #ccc;
  color: #000;
  font-family: "Roboto";
  box-sizing: border-box;
  font-size: 16px;
  font-wieght: 400;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  transition: 0.2s linear;
}
.form input:focus {
  color: #333;
  border: 2px solid #44c4e7;
}

.form select:focus {
  color: #333;
  border: 2px solid #44c4e7;
}
.form button {
  cursor: pointer;
  background: #44c4e7;
  width: 100%;
  padding: 10px 15px;
  border: 0;
  color: #fff;
  font-family: "Roboto";
  font-size: 14px;
  font-weight: 400;
}
.form button:hover {
  background: #369cb8;
}
.error,
.valid {
  display: none;
}
.text-center{
       display: inline;
}

.container-wrapper{
    margin-top: 20px;
    text-align: center;
}
a{
    color:#44c4e7;
}
a:hover{
    color:#369cb8;
}
.forgot-password{
    float: right;
    margin-bottom:5px;
    margin-top:-10px;
}

@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 480px)
  and (-webkit-min-device-pixel-ratio: 2) {
          .form{
          top: 35%;
          background: #fff;
          width:95%;
          box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
          margin:10px;
          }
}

@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 480px)
  and (-webkit-min-device-pixel-ratio: 2)
  and (orientation: portrait) {
    .form{
          top: 35%;
          background: #fff;
          width:95%;
          box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
          margin:10px;
          }
}
/* Landscape */
@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 480px)
  and (-webkit-min-device-pixel-ratio: 2)
  and (orientation: landscape) {
    .form{
          top: 35%;
          background: #fff;
          width:95%;
          box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
          margin:10px;
          }
}

/*--------- Galaxy fold ---------------*/

@media only screen 
  and (min-device-width: 280px) 
  and (max-device-width: 653px)
  and (-webkit-min-device-pixel-ratio: 2) {
    .form{
          top: 29%;
          background: #fff;
          width:95%;
          box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
          padding:10px;
          margin:6px;
          }

      h2{
        font-size:small;
      }
}

/*--------- Surface Duo ---------------*/

@media only screen 
  and (min-device-width: 540px) 
  and (max-device-width: 720px)
  and (-webkit-min-device-pixel-ratio: 2) {
    .form{
          top: 35%;
          background: #fff;
          width:95%;
          box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
          padding:10px;
          margin:6px;
          }

}


@media only screen 
  and (min-device-width: 720px) 
  and (max-device-width: 768px)
  and (-webkit-min-device-pixel-ratio: 2) {
    .form{
          top: 35%;
          background: #fff;
          width:95%;
          box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
          padding:10px;
          margin:20px;
          }

}

@media only screen 
  and (min-device-width: 1020px) 
  and (max-device-width: 1240px)
  and (-webkit-min-device-pixel-ratio: 2) {

       .form{
            top: 35%;
            background: #fff;
            width:80%;
            box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
            padding:10px;
            margin:20px;
          }
}

/* ----------- iPhone 5, 5S, 5C and 5SE ----------- */

/* Portrait and Landscape */
@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 568px)
  and (-webkit-min-device-pixel-ratio: 2) {
    .form{
          top: 4%;
          background: #fff;
          width:95%;
          box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
          margin:10px;
          }
}

/* Portrait */
@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 568px)
  and (-webkit-min-device-pixel-ratio: 2)
  and (orientation: portrait) {
    .form{
          top: 4%;
          background: #fff;
          width:95%;
          box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
          margin:10px;
        }
}

/* Landscape */
@media only screen 
  and (min-device-width: 320px) 
  and (max-device-width: 568px)
  and (-webkit-min-device-pixel-ratio: 2)
  and (orientation: landscape) {

}

/* ----------- iPhone 6, 6S, 7 and 8 ----------- */

/* Portrait and Landscape */
@media only screen 
  and (min-device-width: 375px) 
  and (max-device-width: 667px) 
  and (-webkit-min-device-pixel-ratio: 2) { 
    .form{
          top: 8%;
          background: #fff;
          width:95%;
          box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
          margin:10px;
        }
}

/* Portrait */
@media only screen 
  and (min-device-width: 375px) 
  and (max-device-width: 667px) 
  and (-webkit-min-device-pixel-ratio: 2)
  and (orientation: portrait) { 

}

/* Landscape */
@media only screen 
  and (min-device-width: 375px) 
  and (max-device-width: 667px) 
  and (-webkit-min-device-pixel-ratio: 2)
  and (orientation: landscape) { 

}

/* ----------- iPhone 6+, 7+ and 8+ ----------- */

/* Portrait and Landscape */
@media only screen 
  and (min-device-width: 414px) 
  and (max-device-width: 736px) 
  and (-webkit-min-device-pixel-ratio: 3) { 
    .form{
          top: 15%;
          background: #fff;
          width:95%;
          box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
          margin:10px;
        }
}

/* Portrait */
@media only screen 
  and (min-device-width: 414px) 
  and (max-device-width: 736px) 
  and (-webkit-min-device-pixel-ratio: 3)
  and (orientation: portrait) { 

}

/* Landscape */
@media only screen 
  and (min-device-width: 414px) 
  and (max-device-width: 736px) 
  and (-webkit-min-device-pixel-ratio: 3)
  and (orientation: landscape) { 

}

/* ----------- iPhone X ----------- */

/* Portrait and Landscape */
@media only screen 
  and (min-device-width: 375px) 
  and (max-device-width: 812px) 
  and (-webkit-min-device-pixel-ratio: 3) { 

}

/* Portrait */
@media only screen 
  and (min-device-width: 375px) 
  and (max-device-width: 812px) 
  and (-webkit-min-device-pixel-ratio: 3)
  and (orientation: portrait) { 

}


@media only screen 
  and (min-device-width: 375px) 
  and (max-device-width: 812px) 
  and (-webkit-min-device-pixel-ratio: 3)
  and (orientation: landscape) { 

}

@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 2) {

}

/* Portrait */
@media screen 
  and (device-width: 320px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 2) 
  and (orientation: portrait) {

}

/* Landscape */
@media screen 
  and (device-width: 320px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 2) 
  and (orientation: landscape) {

}

/* ----------- Galaxy S4, S5 and Note 3 ----------- */

/* Portrait and Landscape */
@media screen 
  and (device-width: 320px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 3) {

}

/* Portrait */
@media screen 
  and (device-width: 320px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 3) 
  and (orientation: portrait) {

}

/* Landscape */
@media screen 
  and (device-width: 320px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 3) 
  and (orientation: landscape) {

}

/* ----------- Galaxy S6 ----------- */

/* Portrait and Landscape */
@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 4) {

}

/* Portrait */
@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 4) 
  and (orientation: portrait) {

}

/* Landscape */
@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 4) 
  and (orientation: landscape) {

}

@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 3) {

}

/* Portrait */
@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 3) 
  and (orientation: portrait) {

}

/* Landscape */
@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 3) 
  and (orientation: landscape) {

}

/* ----------- Google Pixel XL ----------- */

/* Portrait and Landscape */
@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 4) {

}

/* Portrait */
@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 4) 
  and (orientation: portrait) {

}

/* Landscape */
@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 4) 
  and (orientation: landscape) {

}


@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 3) {

}

/* Portrait */
@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 3) 
  and (orientation: portrait) {

}

/* Landscape */
@media screen 
  and (device-width: 360px) 
  and (device-height: 640px) 
  and (-webkit-device-pixel-ratio: 3) 
  and (orientation: landscape) {

}


@media screen 
  and (device-width: 480px) 
  and (device-height: 800px) {

}

/* Portrait */
@media screen 
  and (device-width: 480px) 
  and (device-height: 800px)  
  and (orientation: portrait) {

}

/* Landscape */
@media screen 
  and (device-width: 480px) 
  and (device-height: 800px) 
  and (orientation: landscape) {

}

@media only screen 
  and (min-device-width: 768px) 
  and (max-device-width: 1024px) 
  and (-webkit-min-device-pixel-ratio: 1) {

}

/* Portrait */
@media only screen 
  and (min-device-width: 768px) 
  and (max-device-width: 1024px) 
  and (orientation: portrait) 
  and (-webkit-min-device-pixel-ratio: 1) {

}

/* Landscape */
@media only screen 
  and (min-device-width: 768px) 
  and (max-device-width: 1024px) 
  and (orientation: landscape) 
  and (-webkit-min-device-pixel-ratio: 1) {

}

/* ----------- iPad 3, 4 and Pro 9.7" ----------- */

/* Portrait and Landscape */
@media only screen 
  and (min-device-width: 768px) 
  and (max-device-width: 1024px) 
  and (-webkit-min-device-pixel-ratio: 2) {
    .form{
          top: 10%;
          background: #fff;
          width:80%;
          box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
          margin:80px;
          padding: 25px;
        }
}

/* Portrait */
@media only screen 
  and (min-device-width: 768px) 
  and (max-device-width: 1024px) 
  and (orientation: portrait) 
  and (-webkit-min-device-pixel-ratio: 2) {

}

/* Landscape */
@media only screen 
  and (min-device-width: 768px) 
  and (max-device-width: 1024px) 
  and (orientation: landscape) 
  and (-webkit-min-device-pixel-ratio: 2) {

}

/* ----------- iPad Pro 10.5" ----------- */

/* Portrait and Landscape */
@media only screen 
  and (min-device-width: 834px) 
  and (max-device-width: 1112px)
  and (-webkit-min-device-pixel-ratio: 2) {

}

/* Portrait */
/* Declare the same value for min- and max-width to avoid colliding with desktops */
/* Source: https://medium.com/connect-the-dots/css-media-queries-for-ipad-pro-8cad10e17106*/
@media only screen 
  and (min-device-width: 834px) 
  and (max-device-width: 834px) 
  and (orientation: portrait) 
  and (-webkit-min-device-pixel-ratio: 2) {

}

/* Landscape */
/* Declare the same value for min- and max-width to avoid colliding with desktops */
/* Source: https://medium.com/connect-the-dots/css-media-queries-for-ipad-pro-8cad10e17106*/
@media only screen 
  and (min-device-width: 1112px) 
  and (max-device-width: 1112px) 
  and (orientation: landscape) 
  and (-webkit-min-device-pixel-ratio: 2) {

}

/* ----------- iPad Pro 12.9" ----------- */

/* Portrait and Landscape */
@media only screen 
  and (min-device-width: 1024px) 
  and (max-device-width: 1366px)
  and (-webkit-min-device-pixel-ratio: 2) {
    .form{
          top: 10%;
          background: #fff;
          width:60%;
          box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
          margin:180px;
        }
}

/* Portrait */
/* Declare the same value for min- and max-width to avoid colliding with desktops */
/* Source: https://medium.com/connect-the-dots/css-media-queries-for-ipad-pro-8cad10e17106*/
@media only screen 
  and (min-device-width: 1024px) 
  and (max-device-width: 1024px) 
  and (orientation: portrait) 
  and (-webkit-min-device-pixel-ratio: 2) {

}

/* Landscape */
/* Declare the same value for min- and max-width to avoid colliding with desktops */
/* Source: https://medium.com/connect-the-dots/css-media-queries-for-ipad-pro-8cad10e17106*/
@media only screen 
  and (min-device-width: 1366px) 
  and (max-device-width: 1366px) 
  and (orientation: landscape) 
  and (-webkit-min-device-pixel-ratio: 2) {

}


@media 
  (min-device-width: 800px) 
  and (max-device-width: 1280px) {

}

/* Portrait */
@media 
  (max-device-width: 800px) 
  and (orientation: portrait) { 

}

/* Landscape */
@media 
  (max-device-width: 1280px) 
  and (orientation: landscape) { 

}

/* ----------- Galaxy Tab S ----------- */

/* Portrait and Landscape */
@media 
  (min-device-width: 800px) 
  and (max-device-width: 1280px)
  and (-webkit-min-device-pixel-ratio: 2) {

}

/* Portrait */
@media 
  (max-device-width: 800px) 
  and (orientation: portrait)
  and (-webkit-min-device-pixel-ratio: 2) { 

}

/* Landscape */
@media 
  (max-device-width: 1280px) 
  and (orientation: landscape)
  and (-webkit-min-device-pixel-ratio: 2) { 

}

@media screen 
  and (device-width: 601px) 
  and (device-height: 906px) 
  and (-webkit-min-device-pixel-ratio: 1.331) 
  and (-webkit-max-device-pixel-ratio: 1.332) {

}

/* Portrait */
@media screen 
  and (device-width: 601px) 
  and (device-height: 906px) 
  and (-webkit-min-device-pixel-ratio: 1.331) 
  and (-webkit-max-device-pixel-ratio: 1.332) 
  and (orientation: portrait) {

}

/* Landscape */
@media screen 
  and (device-width: 601px) 
  and (device-height: 906px) 
  and (-webkit-min-device-pixel-ratio: 1.331) 
  and (-webkit-max-device-pixel-ratio: 1.332) 
  and (orientation: landscape) {

}

/* ----------- Nexus 9 ----------- */

/* Portrait and Landscape */
@media screen 
  and (device-width: 1536px) 
  and (device-height: 2048px) 
  and (-webkit-min-device-pixel-ratio: 1.331) 
  and (-webkit-max-device-pixel-ratio: 1.332) {

}

/* Portrait */
@media screen 
  and (device-width: 1536px) 
  and (device-height: 2048px) 
  and (-webkit-min-device-pixel-ratio: 1.331) 
  and (-webkit-max-device-pixel-ratio: 1.332) 
  and (orientation: portrait) {

}
/* Landscape */
@media screen 
  and (device-width: 1536px) 
  and (device-height: 2048px) 
  and (-webkit-min-device-pixel-ratio: 1.331) 
  and (-webkit-max-device-pixel-ratio: 1.332) 
  and (orientation: landscape) {

}

@media only screen 
  and (min-device-width: 800px) 
  and (max-device-width: 1280px) 
  and (-webkit-min-device-pixel-ratio: 1.5) {

}

/* Portrait */
@media only screen 
  and (min-device-width: 800px) 
  and (max-device-width: 1280px) 
  and (-webkit-min-device-pixel-ratio: 1.5) 
  and (orientation: portrait) {
}

/* Landscape */
@media only screen 
  and (min-device-width: 800px) 
  and (max-device-width: 1280px) 
  and (-webkit-min-device-pixel-ratio: 1.5) 
  and (orientation: landscape) {

}

/*---------Laptop---------- */
@media only screen 
  and (min-device-width: 1440px) 
  and (max-device-width: 5000px) {
    .form{
       left: 50%;
        margin: -140px 0 0 -182px; 
        padding: 40px;
        width: 400px; 
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
        background: #fff;
        top: 35%;
        position: absolute;
          }
}
@media screen 
  and (min-device-width: 1240px) 
  and (max-device-width: 1440px) {
     .form{
       left: 50%;
        margin: -140px 0 0 -182px; 
        padding: 40px;
        width: 400px; 
        box-shadow: 0 0 3px rgba(0, 0, 0, 0.3);
        background: #fff;
        top: 35%;
        position: absolute;
          }
}




/* ----------- Kindle Fire HD 8.9" ----------- */

/* Portrait and Landscape */
@media only screen 
  and (min-device-width: 1200px) 
  and (max-device-width: 1600px) 
  and (-webkit-min-device-pixel-ratio: 1.5) {

}

/* Portrait */
@media only screen 
  and (min-device-width: 1200px) 
  and (max-device-width: 1600px) 
  and (-webkit-min-device-pixel-ratio: 1.5) 
  and (orientation: portrait) {
}

/* Landscape */
@media only screen 
  and (min-device-width: 1200px) 
  and (max-device-width: 1600px) 
  and (-webkit-min-device-pixel-ratio: 1.5) 
  and (orientation: landscape) {

}
@media screen 
  and (min-device-width: 1200px) 
  and (max-device-width: 1600px) 
  and (-webkit-min-device-pixel-ratio: 1) { 
}

/* ----------- Retina Screens ----------- */
@media screen 
  and (min-device-width: 1200px) 
  and (max-device-width: 1600px) 
  and (-webkit-min-device-pixel-ratio: 2)
  and (min-resolution: 192dpi) { 
}

    </style>
   <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
</head>
<body>
    <div>
    <div>
       @include('flash::message')
    </div>
       
        @yield('content')
    </div>
    <script src="{{asset('js/jquery.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script>

<script>
    $('#flash-overlay-modal').modal();
    $('div.alert').not('.alert-important').delay(3000).fadeOut(350);
</script>
</body>
</html>