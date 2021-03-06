<!DOCTYPE html>
<html>

<head>
    <!--  
       _               _     _                                   _____           _           _   
      | |             | |   | |                                 |  __ \         (_)         | |  
      | |     __ _ ___| |_  | |     ___  _ __   __ _  ___ _ __  | |__) _ __ ___  _  ___  ___| |_ 
      | |    / _` / __| __| | |    / _ \| '_ \ / _` |/ _ | '__| |  ___| '__/ _ \| |/ _ \/ __| __|
      | |___| (_| \__ | |_  | |___| (_) | | | | (_| |  __| |    | |   | | | (_) | |  __| (__| |_ 
      |______\__,_|___/\__| |______\___/|_| |_|\__, |\___|_|    |_|   |_|  \___/| |\___|\___|\__|
                                               __/ |                          _/ |              
                                               |___/                          |__/               
      -->
    <title>好 盒 器 | @yield('title')</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="Content-Language" content="zh-TW">
    <meta name="distribution" content="global" />
    <meta name="author" content="好盒器" />
    <meta name="publisher" content="好盒器" />
    <meta name="reply-to" content="lastlongerproject@gmail.com" />
    <meta name="rating" content="general" />
    <meta name="copyright" content="© 2017 Last Longer Project. All rights reserved." />
    <meta name="abstract" content="好盒器推動用玻璃杯取代免洗杯！透過店家與民眾一同參與，從源頭落實垃圾減量，讓地球變得更美麗。" />
    <meta name="robots" content="noindex" />
    <meta name="spiders" content="noindex" />
    <meta name="webcrawlers" content="noindex" />
    <meta name="googlebot" content="noindex" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="content-type" content="text/html;charset=utf-8" />
    <meta http-equiv="cache-control" content="public, max-age=3600" />
    <meta http-qeuiv="Pragma" content="cache" />

<!--     <meta name="url" content="http://goodtogo.com.tw"> -->
    <meta name="keywords" content="好盒器,環保,免洗餐具,免洗杯,愛地球,台灣,地球,人嶼物,台南,正興街,外帶玻璃杯,人嶼物,容器" />
    <meta name="description" content="好盒器推動用玻璃杯取代免洗杯！透過店家與民眾一同參與，從源頭落實垃圾減量，讓地球變得更美麗。" />
    <meta name="subject" content="好 盒 器 | 用玻璃杯取代免洗杯" />

    <meta property="og:type" content="website" />
    <meta property="og:title" content="好 盒 器 | @yield('title')" />
{{--     <meta property="og:image" content="http://goodtogo.com.tw/assets/img/og_img.jpg" /> --}}
    <meta property="og:site_name" content="好 盒 器 | @yield('title')" />
<!--     <meta property="og:url" content="http://goodtogo.com.tw" /> -->
    <meta property="og:description" content="好盒器推動用玻璃杯取代免洗杯！透過店家與民眾一同參與，從源頭落實垃圾減量，讓地球變得更美麗。" />

    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('/img/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('/img/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('/img/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('/img/favicon/manifest.json') }}">
    <link rel="mask-icon" href="{{ asset('/img/favicon/safari-pinned-tab.svg') }}" color="#8cd4e0">
    <link rel="shortcut icon" href="{{ asset('/img/favicon/favicon.ico') }}">
    <meta name="apple-mobile-web-app-title" content="好盒器 | @yield('title')">
    <meta name="application-name" content="好盒器 | @yield('title')">
    <meta name="msapplication-config" content="{{ asset('/img/favicon/browserconfig.xml') }}">
    <meta name="theme-color" content="#ffffff">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">

    <link href="img/750x1334.png" media="(device-width: 375px) and (device-height: 667px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 2)" rel="apple-touch-startup-image">
    <link href="img/1080x1920.png" media="(device-width: 414px) and (device-height: 736px) and (orientation: portrait) and (-webkit-device-pixel-ratio: 3)" rel="apple-touch-startup-image">


    <script type="text/javascript" src="{{ asset('/js/pace.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
    <style>
        @font-face {
          font-family: 'Glyphicons Halflings';
          src: url('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/fonts/glyphicons-halflings-regular.eot');
          src: url('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/fonts/glyphicons-halflings-regular.eot?#iefix') format('embedded-opentype'),
               url('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/fonts/glyphicons-halflings-regular.woff2') format('woff2'),
               url('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/fonts/glyphicons-halflings-regular.woff') format('woff'),
               url('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/fonts/glyphicons-halflings-regular.ttf') format('truetype'),
               url('//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/fonts/glyphicons-halflings-regular.svg#glyphicons_halflingsregular') format('svg');
        }
        .glyphicon {
          position: relative;
          top: 1px;
          display: inline-block;
          font: normal normal 16px/1 'Glyphicons Halflings';
          -moz-osx-font-smoothing: grayscale;
          -webkit-font-smoothing: antialiased;
          margin-right: 4px;
        }
        /* Add icons you will be using below */
        .glyphicon-fire:before {
          content: '\e104';
        }
        .glyphicon-eye-open:before {
          content: '\e105';
        }
    </style>

</head>
<body id="main" class="disable-select">
    @include('layouts/navbar')
    @yield('content')

    <script src="{{ asset('/js/app.js') }}" type="text/javascript"></script>
    <script>document.addEventListener("touchmove", function(event){event.preventDefault();}, false);</script>
    @yield('js')
</body>
</html>