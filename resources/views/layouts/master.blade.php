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

    <link rel="stylesheet" type="text/css" href="{{ asset('css/validation.css') }}">

    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    @yield('title')
    <link rel="stylesheet" href="{{asset('themes/vali/css/parts-selector.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/bootstrap-datetimepicker.min.css')}}">
    
    <!-- Start DatePicker CDN-->

    <!-- #Start TimePicker -->

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.37/js/bootstrap-datetimepicker.min.js"></script>  

    <!-- #End TimePicker -->

     <!-- #region datatables files -->
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
   
    <!-- #endregion -->
   
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
    <script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
    <!-- End DatePicker CDN-->   
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <script src="{{ asset('js/notify.min.js') }}"></script>
    <script src="{{ asset('js/jquery.validate.js') }}"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
    @stack('scripts')
  </body>
</html>
