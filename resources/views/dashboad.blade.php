<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="UTDQHUMnQs9GC9VYhC9EaF5Db5U3oNpH3LpUisuu">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Tailwise admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Tailwise Admin Template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="LEFT4CODE">
    <title>{{ $shop ? $shop->name : config('app.name', 'Shop') }}</title>
      <!-- Fonts -->
      <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
      <!-- BEGIN: CSS Assets-->
      <link rel="stylesheet" href="{{ asset('dist/css/vendors/litepicker.css')}}">
      <link rel="stylesheet" href="{{ asset('dist/css/vendors/tiny-slider.css')}}">
      <link rel="stylesheet" href="{{ asset('dist/css/vendors/tippy.css')}}">
      <link rel="stylesheet" href="{{ asset('dist/css/vendors/simplebar.css')}}">
      <link rel="stylesheet" href="{{ asset('dist/css/themes/echo.css')}}">
      <link rel="stylesheet" href="{{ asset('dist/css/app.css')}}">
      {{-- <link rel="stylesheet" href="dist/css/themes/hurricane.css"> --}}

      <!-- END: CSS Assets-->
      <script src="https://cdn.tailwindcss.com"></script>
      <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body>
    <div id="app">

    </div>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
        <script type="text/javascript" charset="utf8" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

        <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
        <script src="https://cdn.datatables.net/2.0.4/js/dataTables.js"></script>
        <script src="https://cdn.datatables.net/2.0.4/js/dataTables.tailwindcss.js"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        <script src="{{ asset('dist/js/vendors/dom.js')}}"></script>
        <script src="{{ asset('dist/js/vendors/tailwind-merge.js')}}"></script>
        <script src="{{ asset('dist/js/vendors/lucide.js')}}"></script>
        <script src="{{ asset('dist/js/vendors/dayjs.js')}}"></script>
        <script src="{{ asset('dist/js/vendors/litepicker.js')}}"></script>
        <script src="{{ asset('dist/js/vendors/tiny-slider.js')}}"></script>
        <script src="{{ asset('dist/js/vendors/popper.js')}}"></script>
        <script src="{{ asset('dist/js/vendors/dropdown.js')}}"></script>
        <script src="{{ asset('dist/js/vendors/tippy.js')}}"></script>
        <script src="{{ asset('dist/js/vendors/simplebar.js')}}"></script>
        <script src="{{ asset('dist/js/vendors/transition.js')}}"></script>
        <script src="{{ asset('dist/js/vendors/chartjs.js')}}"></script>
        <script src="{{ asset('dist/js/vendors/modal.js')}}"></script>
        <script src="{{ asset('dist/js/components/base/theme-color.js')}}"></script>
        <script src="{{ asset('dist/js/components/base/lucide.js')}}"></script>
        <script src="{{ asset('dist/js/components/base/litepicker.js')}}"></script>
        <script src="{{ asset('dist/js/components/base/tiny-slider.js')}}"></script>
        <script src="{{ asset('dist/js/utils/colors.js')}}"></script>
        <script src="{{ asset('dist/js/utils/helper.js')}}"></script>
        <script src="{{ asset('dist/js/components/report-line-chart.js')}}"></script>
        <script src="{{ asset('dist/js/components/report-donut-chart-3.js')}}"></script>
        <script src="{{ asset('dist/js/components/base/tippy.js')}}"></script>
        <script src="{{ asset('dist/js/themes/echo.js')}}"></script>
        <script src="{{ asset('dist/js/components/quick-search.js')}}"></script> 
        <!-- END: Vendor JS Assets-->
</body>
</html>