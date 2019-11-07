<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel = "icon" href ="{{asset('images/logo_laxyo.png')}}" type = "image/x-icon" style="line-height: 40px;">
    <meta property="og:site_name" content="laxyo_mods">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/vali/css/main.css') }}">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    @yield('title')
    <link rel="stylesheet" href="{{asset('themes/vali/css/parts-selector.css')}}">
    
    <!-- Start DatePicker CDN-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/css/bootstrap-datepicker.min.css" rel="stylesheet"/>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <!-- End DatePicker CDN-->

    <!-- Start Models Popup CDN -->
    
    <!-- End Model Popup CDN -->  
     

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="{{ asset('js/notify.min.js') }}"></script>
    @stack('styles')
  </head>
  <style>
  	.active_subtab{
			background: #0d121496;
	    text-decoration: none;
	    color: #fff
  	}
  </style>
  <body class="app sidebar-mini rtl">
    
    @include('partials.header')

    @yield('content')
    
    <script src="{{asset('themes/vali/js/popper.min.js')}}"></script>
    <script src="{{asset('themes/vali/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('themes/vali/js/main.js')}}"></script>
    <script src="{{asset('themes/vali/js/plugins/parts-selector.js')}}"></script>
    @stack('scripts')
  </body>
</html>
