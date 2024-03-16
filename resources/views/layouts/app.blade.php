<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta charset="utf-8" />
  <title>{{ env('APP_NAME') }}</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description" content="{{ env('APP_DESC') }}">
  <meta content="IT" name="author" />
  <meta property="og:url" content="{{ env('APP_URL') }}">
  <meta property="og:description" content="{{ env('APP_DESC') }}">
  <meta property="og:title" content="{{ env('APP_NAME') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <meta property="og:type" content="website">
  <meta property="og:locale" content="en_ID">

  <!-- bootstrap & fontawesome -->

  <link rel="stylesheet" href="{{ asset('css/ace.css') }}" class="ace-main-stylesheet" id="main-ace-style" />
  <link rel="stylesheet" href="{{ asset('assets/font-awesome/4.5.0/css/font-awesome.min.css') }}" />
  @yield('page-css')

  {{--
  <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
  <link rel="stylesheet" href="assets/css/ace-rtl.min.css" /> --}}


  <!-- ace settings handler -->
  {{-- <script src="assets/js/ace-extra.min.js"></script> --}}
  <style>
    html {
      font-size: 16px;
      -webkit-tap-highlight-color: rgba(0, 0, 0, 0);
    }

    #overlay {
      position: fixed;
      top: 0;
      z-index: 10000;
      width: 100%;
      height: 100%;
      display: none;
      background: rgba(0, 0, 0, 0.6);
    }

    .cv-spinner {
      height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .spinner {
      width: 40px;
      height: 40px;
      border: 4px #ddd solid;
      border-top: 4px #2e93e6 solid;
      border-radius: 50%;
      animation: sp-anime 0.8s infinite linear;
    }

    @keyframes sp-anime {
      100% {
        transform: rotate(360deg);
      }
    }

    .dataTables_wrapper .dataTables_filter input::-webkit-search-cancel-button {
      -webkit-appearance: button !important;
    }
  </style>

</head>

<body class="no-skin">
  <div id="overlay">
    <div class="cv-spinner">
      <span class="spinner"></span>
    </div>
  </div>
  {{-- Navbar --}}
  <x-navbar></x-navbar>
  {{-- Navbar --}}

  <div class="main-container ace-save-state" id="main-container">
    <script type="text/javascript">
      try{ace.settings.loadState('main-container')}catch(e){}
    </script>

    {{-- Sidebar --}}
    <x-sidebar></x-sidebar>
    {{-- Sidebar --}}

    {{-- Main Content --}}
    @yield('page-content')
    {{-- Main Content --}}

    {{-- Footer --}}
    <x-footer></x-footer>
    {{-- Footer --}}
  </div><!-- /.main-container -->

  <script src="{{ asset('js/jquery.js') }}"></script>
  <script src="{{ asset('js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('js/ace.js') }}"></script>
  @yield('page-js')

</body>

</html>