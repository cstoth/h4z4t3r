<!DOCTYPE html>
@langrtl
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
@else
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@endlangrtl
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('title', app_name())</title>
        <meta name="description" content="@yield('meta_description', 'HazaTér')">
        <meta name="author" content="@yield('meta_author', 'InnoTeq Kft.')">
        <meta name="php-version" content="{{phpversion()}}">

        @yield('meta')

        {{-- See https://laravel.com/docs/5.5/blade#stacks for usage --}}
        @stack('before-styles')

        <!-- Check if the language is set to RTL, so apply the RTL layouts -->
        <!-- Otherwise apply the normal LTR layouts -->
        {{ style(mix('css/frontend.css')) }}

        <link rel="stylesheet" type="text/css" href="//js.api.here.com/v3/3.0/mapsjs-ui.css" />
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" />
        {{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/v/bs4/dt-1.10.18/b-1.5.4/r-2.2.2/sl-1.2.6/datatables.min.css"/> --}}
        {{-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.css"> --}}
        {{ style('css/bootstrap-material-datetimepicker.css') }}
        {{ style('css/jquery-tagsinput.min.css') }}

        <!-- Custom CSS o-D-o -->
        {{ style('css/custom.css') }}
        @yield('styles')

        @stack('after-styles')
        @if(!App\Helpers\Hazater::isLocal())
            <style>
                .col-hidden { display:none; }
            </style>
        @endif
    </head>
    <body>
        @if(App\Helpers\Hazater::isLocal() || strpos(url()->current(), 'teszt') !== false)
            <div class="corner-ribbon top-left sticky red shadow"><strong>{{ "TESZT v.03.20 :-)" }}</strong></div>
        @endif

        @include('cookieConsent::index')
        <div id="app">
            @include('includes.partials.logged-in-as')
            @include('frontend.includes.nav')

            @yield('search')
            <div class="container">
                @include('includes.partials.messages')
                @yield('content')
            </div><!-- container -->
        </div><!-- #app -->

        <footer class="footer">
            @include('includes.footer')
        </footer><!-- footer -->

        <!-- Scripts -->
        @stack('before-scripts')
        {!! script(mix('js/manifest.js')) !!}
        {!! script(mix('js/vendor.js')) !!}
        {!! script(mix('js/frontend.js')) !!}
        <script src="//ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="//code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>
        <script src="//js.api.here.com/v3/3.0/mapsjs-core.js"       type="text/javascript" charset="utf-8"></script>
        <script src="//js.api.here.com/v3/3.0/mapsjs-service.js"    type="text/javascript" charset="utf-8"></script>
        <script src="//js.api.here.com/v3/3.0/mapsjs-ui.js"         type="text/javascript" charset="utf-8"></script>
        <!-- <script src="//js.api.here.com/v3/3.0/mapsjs-pano.js"       type="text/javascript" charset="utf-8"></script> -->
        <script src="//js.api.here.com/v3/3.0/mapsjs-mapevents.js"  type="text/javascript" charset="utf-8"></script>
        <!-- script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script-->
        {!! script('js/jquery.connections.js') !!}
        {!! script('js/moment-with-locales.min.js') !!}
        {!! script('js/bootstrap-material-datetimepicker.js') !!}
        {!! script('js/jquery-tagsinput.min.js') !!}
        <script>
            const HERE_APP_ID = "{{ getenv('HERE_APP_ID') ?: 'axUZ27L1dhYZQjW2W8NT' }}";
            const HERE_APP_CODE = "{{ getenv('HERE_APP_CODE') ?: '4eggOH1Vi4Zkcj0P5cMHFA' }}";
        </script>
        {!! script('js/custom.js') !!}
        @yield('scripts')
        @stack('after-scripts')
        @include('includes.partials.first-popup')
        @include('includes.partials.ga')
    </body>
</html>
