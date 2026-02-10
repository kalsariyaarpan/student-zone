
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title', 'Choose Your Field')</title>


    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">


    {{-- one line of CSS is fine, but a real project should live in field.css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/field.css') }}">

    {{-- Global head (fonts, icons, meta, etc.) --}}
    @include('layouts.head')
</head>
<body>
   
     {{-- NAVBAR --}}
    @include('layouts.header')

{{--         
        <div style="max-width: 900px; margin: 20px auto 0 auto;">
            <a class="home-link" href="{{ url('/') }}">Home</a>
        </div> --}}


        {{-- MAIN CONTENT --}}
    <main>
        @yield('content')
    </main>
    

     {{-- FOOTER (optional but recommended) --}}
    @includeIf('layouts.footer')

     {{-- GLOBAL SCRIPTS --}}
    @includeIf('layouts.script')

     {{-- PAGE SPECIFIC SCRIPTS --}}
    @stack('scripts')


        {{-- script --}}
    {{-- @stack('scripts')
    @stack('script')
    @stack('script') --}}
    
   

</body>
</html>
