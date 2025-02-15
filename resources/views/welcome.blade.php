<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        {{-- {!! seo()->render() !!} --}}
        <meta charset="utf-8">
        
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ isset($shop) ? $shop->name : config('app.name', 'Shop') }}</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

         <!-- Favicon -->
    <link rel="shortcut icon" href="{{ isset($shop) ? asset('/storage/'.$shop->logo) : asset('assets/images/favicon.png') }}" type="image/x-icon">

    <!-- CSS (Font, Vendor, Icon, Plugins & Style CSS files) -->

    <!-- Fonts CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin="">
    <link href="css22957.html?family=Dosis:wght@200;300;400;500;600;700;800&amp;family=Engagement&amp;family=Inter:wght@100;200;300;400;500;600;700;800;900&amp;display=swap" rel="stylesheet">

    <!-- Vendor CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/roadthemes-icon.css')}}">
    <!-- Plugins Css -->
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/slick.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery-ui.min.css')}}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/github-markdown-css/3.0.1/github-markdown.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.14.2/styles/github-gist.min.css">
    <!--Start of Tawk.to Script-->
{{-- <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
    var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
    s1.async=true;
    s1.src='https://embed.tawk.to/66c36b730cca4f8a7a77a470/1i5llnfis';
    s1.charset='UTF-8';
    s1.setAttribute('crossorigin','*');
    s0.parentNode.insertBefore(s1,s0);
    })();
    </script> --}}
    <script type="text/javascript">
        var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
        (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/66cbbf2fea492f34bc0a0614/1i65u5l00';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
        })();
        </script>
        
    <!--End of Tawk.to Script-->
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css')}}">
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        
    </head>
    <body>
      
        <div id="app">

        </div>
        
        <script src="{{ mix('js/app.js') }}"></script>
         <!-- Vendors JS -->
        <script src="{{ asset('assets/js/vendor/modernizr-3.11.7.min.js')}}"></script>
        <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js')}}"></script>
        <script src="{{ asset('assets/js/vendor/jquery-migrate-3.3.2.min.js')}}"></script>
        <!-- Bootstrap JS -->
        <script src="{{ asset('assets/js/vendor/bootstrap.min.js')}}"></script>
        <!-- Plugins JS -->
        <script src="{{ asset('assets/js/plugins/slick.min.js')}}"></script>
        <script src="{{ asset('assets/js/plugins/countdown.min.js')}}"></script>
        <script src="{{ asset('assets/js/plugins/jquery-ui.min.js')}}"></script>
        <script src="{{ asset('assets/js/plugins/jquery.zoom.min.js')}}"></script>
        <script src="{{ asset('assets/js/plugins/jquery.magnific-popup.min.js')}}"></script>
        <script src="{{ asset('assets/js/plugins/counterup.min.js')}}"></script>
        <script src="{{ asset('assets/js/plugins/scrollup.js')}}"></script>
        <script src="{{ asset('assets/js/plugins/ajax.mail.js')}}"></script>

    <!-- Activation JS -->
    <script src="assets/js/active.js"></script>
    </body>
</html>
