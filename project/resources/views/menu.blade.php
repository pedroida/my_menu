<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <meta name="description" content="Base Laravel Application">
    <meta name="author" content="Lucas Luan Pontarolo">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Title -->
    <title>{{ config('app.name') }}@hasSection ('title') - @yield('title')@endif</title>

    <!-- Favicon icon -->
    <link rel="icon" href="/assets/img/favicon.ico" type="image/x-icon">

    <!-- Main css -->
    <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('assets/css/menu.css') }}">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">

    <!-- Page Specific Head -->
    @yield('head')
</head>

<body>
<div id="app">

    <div class="main-wrapper main-wrapper-1">
        <!-- Main Content -->
        <div class="main-content parallax">
            @if($singletonStore->banner)
                <section class="section banner-section">
                    <img src="{{ route('store.banner') }}" alt="">
                </section>
            @endif

            <section class="section mt-5">
                <div class="section-body">
                    <div class="container">
                        @include('layouts._partials.flash-messages')

                        <h2 class="h2 text-center store-name">{{ config('app.name') }}</h2>

                        <h4 class="h4 text-center">O meu, o seu, o nosso cardápio</h4>

                    </div>
                </div>
            </section>

            <hr>

            <section class="section pt-5">
                <div class="section-body">

                    <div class="container">
                        <store-menu
                                menu-url="{{ route('store.menu.pagination') }}"
                                categories-url="{{ route('store.categories') }}">
                        </store-menu>

                    </div>

                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <div class="footer-left">
                <span>Copyright &copy; Corp {{ date('Y') }}</span>
            </div>
        </footer>

    </div>
</div>

<!-- Core JS -->
<script src="{{ mix('assets/js/manifest.js') }}"></script>
<script src="{{ mix('assets/js/vendor.js') }}"></script>
<script src="{{ mix('assets/js/app.js') }}"></script>

<!-- JS Libraies -->
@stack('page_libraries_scripts')

<!-- Page Specific JS File -->
@stack('page_specific_scripts')
</body>

@yield('scripts')

</html>
