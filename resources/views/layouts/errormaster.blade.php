<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta name="robots" content="noindex, nofollow">
        <title>@lang('messages.siteName') - @yield('title')</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        
        <!--begin::Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">
        <!--end::Fonts -->
        
        <!--begin::Page Custom Styles(used by this page) -->
        <link href="{{ url('assets/css/pages/error/error-5.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Page Custom Styles -->

        <!--begin::Global Theme Styles(used by all pages) -->
        <link href="{{ url('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ url('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
        <!--end::Global Theme Styles -->   
       
        @yield('css')
        <link rel="shortcut icon" href="{{url('assets/media/logos/favicon.png')}}" /> 
    </head>
    <!-- END HEAD -->

    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
       
             @yield('content')
            
    </body>
    <script>
                        var KTAppOptions = {
                                "colors": {
                                        "state": {
                                                "brand": "#2c77f4",
                                                "light": "#ffffff",
                                                "dark": "#282a3c",
                                                "primary": "#5867dd",
                                                "success": "#34bfa3",
                                                "info": "#36a3f7",
                                                "warning": "#ffb822",
                                                "danger": "#fd3995"
                                        },
                                        "base": {
                                                "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                                                "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                                        }
                                }
                        };
    </script>
    <!-- end::Global Config -->

    <!--begin::Global Theme Bundle(used by all pages) -->
    <script src="{{ url('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
    <script src="{{ url('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>
    <!--end::Global Theme Bundle -->
    
    <script src="{{url('assets/developer/developer.js')}}" type="text/javascript"></script>
    <script type="text/javascript">window.baseUrl = "@php echo URL::to('/'); @endphp"</script>
    <script>window.siteName="@php echo trans('messages.siteName'); @endphp"</script>
    @yield('script')
     @yield('script')
</html>