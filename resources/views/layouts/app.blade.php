<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Trip Connect') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
<div id="app">

    @include('_partials/menu')

    <div id="mydiv" style="display:none;">
        <img id="loading" class="ajax-loader" src="{!! URL::asset('ajax-loader.gif') !!}" alt="">
    </div>

    @if (Session::has('flash_message'))
        <div class="flash_message success">
            <i class="fa fa-smile-o" aria-hidden="true"></i>
            <h2>SUCCESS</h2>
            <p>{{ Session::get('flash_message') }}</p>
        </div>
    @endif

    @if (Session::has('errors'))
        <div class="flash_message error">
            <i class="fa fa-frown-o" aria-hidden="true"></i>
            <h2>ERROR</h2>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

@yield('footer')
<script>
    $('.flash_message').delay(3500).addClass("in").slideUp(3000);

    $(document).ready(function () {
        $(document).ajaxStart(function () {
            $("#mydiv").show();
        }).ajaxStop(function () {
            $("#mydiv").hide();
        });
    });
</script>

</body>
</html>