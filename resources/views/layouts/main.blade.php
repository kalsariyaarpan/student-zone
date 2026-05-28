<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="utf-8">
  {{-- <meta content="width=device-width, initial-scale=1.0" name="viewport"> --}}
  <title>@yield('title')</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  @include('layouts.head')
      @stack('css')


  <!-- =======================================================
  * Template Name: student study zone
  ======================================================== -->
</head>
<link rel="stylesheet" href="{{ asset('assets/css/theme.css') }}">

<body class="index-page {{ auth()->check() ? (auth()->user()->theme ?? 'light') : 'light' }}" class="scroll-smooth">
    
    @include('layouts.header')
    <main class="main">
        @yield('content')
    </main>
   @include('layouts.footer')

  @include('layouts.script')
 {{-- delete for alerts --}}
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('scripts')

</body>
</html>